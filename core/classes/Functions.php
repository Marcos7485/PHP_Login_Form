<?php

namespace core\classes;

use Exception;

class Functions
{

    public static function Layout($estruturas, $dados = null)
    {

        if (!is_array($estruturas)) {
            throw new Exception("Invalid structure information");
        }
        // variáveis
        if (!empty($dados) && is_array($dados)) {
            extract($dados);
        }
        foreach ($estruturas as $estrutura) {
            include("core/views/$estrutura.php");
        }
    }

    public static function Userloged()
    {
        //verifica se existe um cliente com sessao
        return isset($_SESSION['cliente']);
    }

    //======================================
    public static function redirect($rota = '', $admin = false)
    {

        // faz o redirecionamento para a URL desejada (rota)
        if (!$admin) {
            header("Location: " . BASE_URL . "?a=$rota");
        } else {
            header("Location: " . BASE_URL . "/admin?a=$rota");
        }
    }

    //======================================
    public static function aesEncriptar($valor)
    {
        return bin2hex(openssl_encrypt($valor, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
    }

    //======================================
    public static function aesDesencriptar($valor)
    {
        return openssl_decrypt(hex2bin($valor), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
    }


    public static function criarHash($num_caracteres = 12)
    {

        //criar bases
        $chars = '01234567890123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($chars), 0,  $num_caracteres);
    }
}
