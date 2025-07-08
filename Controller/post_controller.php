<?php

require_once ROOT_PATH . '/Config/Conexao.php';
require_once ROOT_PATH . '/Services/PostService.php';
$conexao = new Conexao();

$postService = new PostService($conexao);
$posts = $postService->getData();
$likesAll=0;
$dislikesAll=0;
foreach($posts as $post){
    if($post['likes_up'] == null){
        $likesAll+=0;
    }else{
        $likesAll +=$post['likes_up'];
    }
}

foreach ($posts as $post) {
    if ($post['likes_down'] == null) {
        $dislikesAll += 0;
    } else {
        $dislikesAll += $post['likes_down'];
    }
}