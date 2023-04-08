<?php

namespace core\classes;

use Exception;

class Users
{
  public function verifyExist_Email($email)
  {


    // verifica se ja existe outra conta com o mesmo email
    // verifica na base de dados se existe cliente com mesmo email
    $bd = new Database();
    $parametros = [
      ':email' => strtolower(trim($email))
    ];
    $resultados = $bd->select("SELECT email FROM users WHERE email = :email", $parametros);


    // se o cliente já existe...
    if (count($resultados) != 0) {
      return true;
    } else {
      return false;
    }
  }

  public function register_user()
  {


    // registra o novo cliente na base de dados
    $bd = new Database();

    // cria um hash para o registro do cliente
    $purl = Functions::criarHash();

    // parametros
    $parametros = [
      ':name' => (trim($_POST['text_nome_completo'])),
      ':email' => strtolower(trim($_POST['text_email'])),
      ':password' => password_hash(trim($_POST['text_senha_1']), PASSWORD_DEFAULT),
      ':purl' => $purl,
      ':active' => 0
    ];
    $bd->insert("
        INSERT INTO users VALUES(
            0,
            :name,
            :email,
            :password,
            :purl,
            :active,
            NOW(),
            NULL,
            NULL
        )
    ", $parametros);
    // retorna o purl criado
    return $purl;
  }

  public function validar_email($purl)
  {

    // validar o email do cliente

    $bd = new Database();
    $parametros = [
      ':purl' => $purl
    ];
    $resultados = $bd->select("
        SELECT * FROM users 
        WHERE purl = :purl
      ", $parametros);

    // verifica se foi encontrado o clientes
    if (count($resultados) != 1) {
      return false;
    }
    // foi encontrado este cliente com o purl indicado
    $id_user = $resultados[0]->id;

    // atualizar os dados do cliente
    $parametros = [
      ':id' => $id_user,
    ];
    $bd->update("
        UPDATE users SET
        purl = NULL,
        active = 1,
        updated_at = NOW() 
        WHERE id = :id
      ", $parametros);

    return true;
  }

  public function verify_login($user, $password)
  {

    // verificar se o login é valido
    $parametros = [
      ':user' => $user,

    ];
    $bd = new Database();
    $resultados = $bd->select("
        SELECT * FROM users 
        WHERE email = :user 
        AND deleted_at IS NULL
      ", $parametros);


    if (count($resultados) != 1) {
      //não existe usuario
      return false;
    } elseif ($resultados[0]->active == 1) {

      // temos usuario. vamos ver a sua password
      $user = $resultados[0];

      // verificar a password
      if (!password_verify($password, $user->password)) {
        // password inválida
        return false;
      } else {
        //login valido
        return $user;
      }
    } else {
      // temos usuario. vamos ver a sua password
      $user = $resultados[0];

      if (!password_verify($password, $user->password)) {
        // password inválida

        return false;
      } else {
        return 'validar';
      }
    }
  }
  public function created_at($id){

    $bd = new Database();

    return $bd->select("SELECT created_at FROM users WHERE id = $id");
  }
}
