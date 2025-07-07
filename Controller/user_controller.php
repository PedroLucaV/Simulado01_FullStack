<?php

require_once ROOT_PATH . '/Config/Conexao.php';
require_once ROOT_PATH . '/Services/UsuarioService.php';
require_once ROOT_PATH . '/Class/Usuario.php';

$conexao = new Conexao();

$usuario = new Usuario();

$usuarioService = new UsuarioService($conexao, $usuario);
if(isset($_SESSION['nickname'])){
    $usuario->__set('id', $_SESSION['nickname']);
    $usuario = $usuarioService->getData();
}