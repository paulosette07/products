<?php
require_once 'autoload.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Products</title>
        <meta charset="utf-8">
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
        if (isset($_GET['loginError'])) {
            if ($_GET['loginError'] == 1) {
                Library\System::msg("Você não está logado!", 'error');
            }
            if ($_GET['loginError'] == 2) {
                Library\System::msg("Email ou senha inválidos!", 'error');
            }
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
                            <a href="index.php" title="Login">Login</a>
                        </nav>
                    </div>
                </section>
            </header>
            <main>
                <div class="boxLogin">
                    <h1>Efetue login para continuar</h1>
                    <form action="login.php" method="post">
                        <div style="margin-top: 20px;">
                            <input type="email" name="email" id="email" placeholder="E-Mail" class="iTxt" />
                        </div>
                        <div>
                            <input type="password" name="password" id="password" placeholder="Senha" class="iTxt" />
                        </div>
                        <div>
                            <input type="submit" value="Entrar" class="iBtn" />
                        </div>
                    </form>
                    <h3>Email: admin@admin.com<br />Password: admin</h3>
                </div>
            </main>
            <footer>
                <section>
                    Desenvolvido por Paulo Sette
                </section>
            </footer>
        </div>
    </body>
</html>