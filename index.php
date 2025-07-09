<?php
define('ROOT_PATH', dirname(__FILE__));
session_start();
// unset($_SESSION['erro']);
// print_r($_SESSION);
require_once './Controller/empresa_controller.php';
require_once './Controller/post_controller.php';
require_once './Controller/user_controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Sabor do Brasil</title>
</head>
<script>
    const loginShow = () => {
        event?.preventDefault();
        const modalLogin = document.querySelector('.modal_login');
        const modalOverlay = document.querySelector('.modal_overlay');

        modalLogin.classList.toggle('active');
        modalOverlay.classList.toggle('active');
    }
</script>
<?php if (isset($_SESSION['erro'])) {
    $erromsg = '';
    ?>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            loginShow();
        });
    </script>
    <?php unset($_SESSION['erro']);
} ?>

<body>
    <?php if (!isset($_SESSION['nickname'])) ?>
    <div class="modal_overlay"></div>
    <div class="modal_login">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <input type="text" placeholder="Digite seu nome" name="nickname">
            <input type="password" placeholder="Digite sua senha" name="senha">
            <div>
                <button onclick="loginShow()">Cancelar</button>
                <button type="submit">Entrar</button>
            </div>
            <?php if (isset($erromsg)) { ?>
                <p>Erro: Usuário ou senha incorretos</p>
            <?php } ?>
        </form>
    </div>
    <?php ?>
    <main>
        <section class="enterprise_data">
            <?php if (!isset($_SESSION['nickname'])) { ?>
                <img src="./Assets/logo/<?= $empresa[0]['logo'] ?>" class="logo" alt="">
                <p class="name"><?= $empresa[0]['nome'] ?></p>
                <span class="line"></span>
                <div class="like_deslike">
                    <div>
                        <h3><?= $likesAll ?></h3>
                        <p>Quantidade Likes</p>
                    </div>
                    <div>
                        <h3><?= $dislikesAll ?></h3>
                        <p>Quantidade Deslikes</p>
                    </div>
                </div>
            <?php } else { ?>
                <img src="./Assets/foto_usuario/<?= $usuario[0]['foto'] ?>" class="logo" alt="">
                <p class="name"><?= $usuario[0]['nome'] ?></p>
                <span class="line"></span>
                <div class="like_deslike">
                    <div>
                        <h3><?= $usuario[0]['likes_up'] ? $usuario[0]['likes_up'] : 0 ?></h3>
                        <p>Quantidade Likes</p>
                    </div>
                    <div>
                        <h3><?= $usuario[0]['likes_down'] ? $usuario[0]['likes_down'] : 0 ?></h3>
                        <p>Quantidade Deslikes</p>
                    </div>
                </div>
            <?php } ?>
        </section>
        <?php if(isset($_GET['post'])){ $post = $postService->getById($_GET['post'])?>
            <section class="posts">
            <h1>Publicações</h1>
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
                            <img src="./Assets/icones/<?= isset($_SESSION['nickname']) ? validaLike($post['id_publicacao'], $usuario[0]['id'], 'up') ? 'flecha_cima_cheia.svg' : 'flecha_cima_vazia.svg' : 'flecha_cima_vazia.svg' ?>" alt="" <?php
                                        if (isset($_SESSION['nickname'])) {
                                            $url = "post_controller.php?curtir=up&idp={$post['id_publicacao']}&idu={$usuario[0]['id']}&post=". $_GET['post'];
                                            echo "onclick=\"window.location.href='$url'\"";
                                        }
                                        ?>>
                            <p><?= $post['likes_up'] ? $post['likes_up'] : 0 ?></p>
                        </span>
                        <span>
                            <img src="./Assets/icones/<?= isset($_SESSION['nickname']) ? validaLike($post['id_publicacao'], $usuario[0]['id'], 'down') ? 'flecha_baixo_cheia.svg' : 'flecha_baixo_vazia.svg' : 'flecha_baixo_vazia.svg' ?>" alt="" <?php
                                        if (isset($_SESSION['nickname'])) {
                                            $url = "post_controller.php?curtir=down&idp={$post['id_publicacao']}&idu={$usuario[0]['id']}&post=" . $_GET['post'];
                                            echo "onclick=\"window.location.href='$url'\"";
                                        }
                                        ?>>
                            <p><?= $post['likes_down'] ? $post['likes_down'] : 0 ?></p>
                        </span>
                    </div>
                    <span>
                        <img src="./Assets/icones/chat.svg" alt="" >
                        <p><?= $post['comentarios'] ?></p>
                    </span>
                </div>
            </div>
            </section>
        <?php }else{?>
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
                                <img src="./Assets/icones/<?= isset($_SESSION['nickname']) ? validaLike($post['id_publicacao'], $usuario[0]['id'], 'up') ? 'flecha_cima_cheia.svg' : 'flecha_cima_vazia.svg' : 'flecha_cima_vazia.svg' ?>" alt="" <?php
                                            if (isset($_SESSION['nickname'])) {
                                                $url = "post_controller.php?curtir=up&idp={$post['id_publicacao']}&idu={$usuario[0]['id']}";
                                                echo "onclick=\"window.location.href='$url'\"";
                                            }
                                            ?>>
                                <p><?= $post['likes_up'] ? $post['likes_up'] : 0 ?></p>
                            </span>
                            <span>
                                <img src="./Assets/icones/<?= isset($_SESSION['nickname']) ? validaLike($post['id_publicacao'], $usuario[0]['id'], 'down') ? 'flecha_baixo_cheia.svg' : 'flecha_baixo_vazia.svg' : 'flecha_baixo_vazia.svg' ?>" alt="" <?php
                                            if (isset($_SESSION['nickname'])) {
                                                $url = "post_controller.php?curtir=down&idp={$post['id_publicacao']}&idu={$usuario[0]['id']}";
                                                echo "onclick=\"window.location.href='$url'\"";
                                            }
                                            ?>>
                                <p><?= $post['likes_down'] ? $post['likes_down'] : 0 ?></p>
                            </span>
                        </div>
                        <span onclick="window.location.href = `index.php?post=<?= $post['id_publicacao'] ?>`">
                            <img src="./Assets/icones/chat.svg" alt="">
                            <p><?= $post['comentarios'] ?></p>
                        </span>
                    </div>
                </div>
            <?php } ?>
        </section>
        <?php }?> 
        <section class="user_data">
            <?php if (!isset($_SESSION['nickname'])) { ?>
                <button onclick="loginShow()" class="login">Login</button>
            <?php } else { ?>
                <button onclick="window.location.href='logout.php'" class="login">Sair</button>
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