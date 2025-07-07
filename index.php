<?php
define('ROOT_PATH', dirname(__FILE__));
require_once './Config/Conexao.php';
require_once './Controller/empresa_controller.php';
$conexao = new Conexao();
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
            <?php print_r($empresa[0]['nome']) ?>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>