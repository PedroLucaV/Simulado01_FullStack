<?php

require_once ROOT_PATH . '/Config/Conexao.php';
require_once ROOT_PATH . '/Services/ComentarioService.php';
require_once ROOT_PATH . '/Class/Comentario.php';

$conexao = new Conexao();
$comentarioService = new ComentarioService($conexao);
function comentar($comentario, $postId){
    $conexao = new Conexao();
    $comentario = new Comentario($_SESSION['id_user'], $postId, $comentario);
    $comentarioService = new ComentarioService($conexao, $comentario);
    $comentarioService->inserir();
}

$comments = $comentarioService ->getAll();
