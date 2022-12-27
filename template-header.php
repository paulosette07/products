<?php
require_once 'autoload.php';

$security = Library\Security::getInstance();
$security->validateLogin();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Products</title>
        <meta charset="utf-8">
        <link href="public/css/all.min.css" rel="stylesheet"> <!--load all styles -->
        <link rel="stylesheet" href="public/css/layout.css" />
        <script src="public/js/jquery.min.js"></script>
        <script src="public/js/jquery.mask.js"></script>
        <script src="public/js/func.js"></script>
    </head>
    <body>
        <?php
        if (isset($_GET['actionError'])) {
            if ($_GET['actionError'] == 1) {
                Library\System::msg("Ação não localizada!", 'error');
            }
        }
        if (isset($_GET['tpmsg']) && isset($_GET['msg'])) {
                Library\System::msg($_GET['msg'], $_GET['tpmsg']);
        }
        ?>
        <div id="wrapper">
            <header>
                <section>
                    <div class="header-logo">
                        <img src="public/images/logo.png" />
                    </div>
                    <div class="header-menu">
                        <nav>
                            <a href="client-list.php" title="Clientes"><i class="fas fa-user"></i> Clientes</a>
                            <a href="product-list.php" title="Produtos"><i class="fas fa-box-open"></i> Produtos</a>
                            <a href="product-type-list.php" title="Tipos de Produtos"><i class="fas fa-boxes"></i> Tipos de Produtos</a>
                            <a href="sale-list.php" title="Vendas"><i class="fas fa-shopping-cart"></i> Vendas</a>
                            <a href="logout.php" title="Sair"><i class="fas fa-sign-out-alt"></i> Sair</a>
                        </nav>
                    </div>
                </section>
            </header>