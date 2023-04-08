<?php

// coleção de rotas
$rotas=[
    'inicio' => 'main@index',
    'system_start' => 'main@system_start',
    'new_user' => 'main@new_user',
    'add_user' => 'main@add_user',
    'email_confirm' => 'main@email_confirm',
    'login' => 'main@login',
    'login_submit' => 'main@login_submit',
    'user_panel' => 'main@user_panel',
    'logout' => 'main@logout'
];

// define ação por defeito

$acao = 'inicio';

// verifica se existe a ação na query string
if(isset($_GET['a'])){

    // verifica se a ação existe nas rotas
    if(!key_exists($_GET['a'], $rotas)){
        $acao = 'inicio';
    } else{
        $acao = $_GET['a'];
    }
}

// trata a definição da rota
$partes = explode('@',$rotas[$acao]);

$controlador = 'core\\controllers\\'.ucfirst($partes[0]);
$metodo = $partes[1];
$ctr = new $controlador();
$ctr->$metodo();

