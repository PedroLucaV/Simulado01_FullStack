<?php

use function PHPSTORM_META\type;

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

function validaLike($idPost, $idUser, $type) {
    $conexao = new Conexao();
    $postService = new PostService($conexao);
    $postsLiked = $postService->verifyLike($idPost, $type);
    foreach($postsLiked as $likes){
        if($likes['id_usuario'] == $idUser){
            return true;
        }else{
            return false;
        }
    }
}

function curtir($idPost, $idUser, $type, $post = null)
{
    $conexao = new Conexao();
    $postService = new PostService($conexao);

    $likeAtual = $postService->getLike($idPost, $idUser);

    if ($likeAtual) {
        if ($likeAtual === $type) {
            $postService->unlike($idPost, $idUser, $type);
        } else {
            $postService->unlike($idPost, $idUser, $likeAtual);
            $postService->like($idPost, $type, $idUser);
        }
    } else {
        $postService->like($idPost, $type, $idUser);
    }

    if($post != null){
        header('Location:index.php?post='. $post);
    }else{
        header('Location:index.php');
    }
    exit;
}

if(isset($_GET['curtir'])){
    curtir($_GET['idp'], $_GET['idu'], $_GET['curtir'], $_GET['post']);
}