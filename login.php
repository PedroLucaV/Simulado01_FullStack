<?php
require_once './Config/Conexao.php';
$conexao = new Conexao();
$conexao = $conexao->conectar();

session_start();
// print_r($_POST);
$user_pass = $_POST;

$query = 'SELECT nickname, senha FROM usuarios';
$stmt = $conexao->prepare($query);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['erro'] = '';

foreach($res as $user){
    if($user['nickname'] == $user_pass['nickname'] && $user['senha'] == $user_pass['senha']){
        $_SESSION['nickname'] = $_POST['nickname'];
        unset($_SESSION['erro']);
        header('Location:index.php');
        exit;
    }
}
header('Location:index.php');