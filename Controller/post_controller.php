<?php

require_once ROOT_PATH . '/Config/Conexao.php';
require_once ROOT_PATH . '/Services/PostService.php';
$conexao = new Conexao();

$postService = new PostService($conexao);
$posts = $postService->getData();