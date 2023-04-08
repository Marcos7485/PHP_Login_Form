# Php-Back-End

# Desenvolvimento de cadastro e login con HTML5, CSS, PHP.

# Paso 1

-composer init
ingresar em composer, colocar :

{
    "name": "acer/php-back-end",
    "description": "Register Login",
    "type": "project",
    "autoload": {
        "psr-4": {
            "Acer\\PhpBackEnd\\": "src/",
            "core\\" : "core/"
            
        }
    },
    "authors": [
        {
            "name": "MGonzalez"
        }
    ],
    "require": {}
}


autoload manualmente, o espaço "("core\\" : "core/")" para incluir as clases dentro da pasta core.

# paso 2

na pagina index = colocar um require com:

<?php

use core\classes\Database;

session_start();

require_once('config.php');
require_once('vendor/autoload.php');
require_once('core/rotas.php');

$a = new Database();


e a instanciação do database para testar sua integração no codigo.

# Conexão conta email hostinger -> google:
https://support.hostinger.com/en/articles/6987367-how-to-add-profile-picture-for-gmail-recipients

# Modals boostrap:

incluir 
boostrap css (en el cabezal del html)
boostrap js (en el pie del html despues del body)



# Desenvolvimento de conexão com base de dados com PHP.

# Desenvolvimento de utilização de Api geolocalização para calcular precio de entrega mediante CEP (CODIGO DE ENDEREÇO POSTAL BRASILEIRO) com PHP.

# Desenvolvimento de desarrollo e conexão para envio de E-mails com PHP.

# Desenvolvimento de sistema de rotas com PHP.

