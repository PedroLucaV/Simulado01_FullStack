<?php
require_once './config.php';

require_once './Controller/comment_controller.php';

if(isset($_POST['comentario']) && isset($_SESSION['id_user'])){
    comentar($_POST['comentario'], $_GET['post']);
    header('Location:index.php?post=' . $_GET['post']);
}
