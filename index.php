<?php
define('ROOT_PATH', dirname(__FILE__));
require_once './Controller/empresa_controller.php';
require_once './Controller/post_controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Sabor do Brasil</title>
</head>

<body>
    <main>
        <section class="enterprise_data">
            <?php if (!isset($_SESSION['nickname'])) { ?>
                <img src="./Assets/logo/<?= $empresa[0]['logo'] ?>" class="logo" alt="">
                <p class="name"><?= $empresa[0]['nome'] ?></p>
                <span class="line"></span>
                <div class="like_deslike">

                </div>
            <?php } else { ?>
                <button class="login">Sair</button>
            <?php } ?>
        </section>
        <section class="posts">
            <h1>Publicações</h1>
            <?php foreach ($posts as $post) { ?>
                <div class="post">
                    <h2><?= $post['titulo_prato'] ?></h2>
                    <img src="./Assets/publicacao/<?= $post['foto'] ?>" alt="">
                    <div class="local">
                        <p><?= $post['local'] ?></p>
                        <p><?= $post['cidade'] ?></p>
                    </div>
                    <div class="like_com">
                        <div>
                            <span>
                                <img src="./Assets/icones/flecha_baixo_vazia.svg" alt="">
                                <p><?= $post['likes_up'] ? $post['likes_up'] : 0 ?></p>
                            </span>
                            <span>
                                <img src="./Assets/icones/flecha_baixo_vazia.svg" alt="">
                                <p><?= $post['likes_down'] ? $post['likes_down'] : 0 ?></p>
                            </span>
                        </div>
                        <span>
                            <img src="./Assets/icones/chat.svg" alt="">
                            <p><?= $post['comentarios'] ?></p>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </section>
        <section class="user_data">
            <?php if (!isset($_SESSION['nickname'])) { ?>
                <button class="login">Login</button>
            <?php } else { ?>
                <button class="login">Sair</button>
            <?php } ?>
        </section>
    </main>
    <footer>
        <p class="name"><?= $empresa[0]['nome'] ?></p>
        <div class="social">
            <a href=""><img src="./Assets/icones/Instagram.svg" alt=""></a>
            <a href=""><img src="./Assets/icones/Twitter.svg" alt=""></a>
            <a href=""><img src="./Assets/icones/Whatsapp.svg" alt=""></a>
            <a href=""><img src="./Assets/icones/Globe.svg" alt=""></a>
        </div>
        <p>Copyright - 2024</p>
    </footer>
</body>

</html>