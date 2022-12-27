<?php
require_once 'autoload.php';

$security = Library\Security::getInstance();
$security->validateLogin();

$key = (isset($_GET['key'])) ? Library\System::_var($_GET['key']) : false;
$saleController = new \Application\Controller\SaleController();
$data = $saleController->view($key);

$sale = $data['sale'];
$products = $data['products'];

$nome = $sale->getClient()->getName();
$cpf = $sale->getClient()->getCpf(true);
$phone = $sale->getClient()->getPhone(true);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>SoftExpert</title>
        <meta charset="utf-8">
        <link href="public/css/all.min.css" rel="stylesheet"> <!--load all styles -->
        <link rel="stylesheet" href="public/css/layout.css" />
        <script src="public/js/jquery.min.js"></script>
        <script src="public/js/jquery.mask.js"></script>
        <script src="public/js/func.js"></script>
    </head>
    <body>
        <div id="wrapper" style="width: 800px; border: 1px solid #000;">
            <header>
                <section>
                    <div class="header-logo">
                        <img src="public/images/logo-softexpert.png" />
                    </div>
                    <div style="text-align: right; float: right; width: 480px">
                        <input type="button" onclick="history.go(-1);" class="iBtnGreen" value="Voltar" />
                    </div>
                </section>
            </header>
            <main>
                <section style="width: 780px;">
                    <h1 style="text-align: center;">Recibo de Venda</h1>
                    <hr />
                    <br />
                    <table width="780">
                        <tr>
                            <td width="120"><b>Cód da Venda:<b /></td>
                            <td width="440"><?php echo $sale->getId(); ?></td>
                            <td width="50"><b>Data:</b></td>
                            <td><?php echo $sale->getDate(true); ?></td>
                        </tr>
                    </table>
                    <hr />
                    <br />
                    <table width="780">
                        <tr>
                            <td width="60"><b>Cliente:<b /></td>
                            <td width="500"><?php echo $nome; ?></td>
                            <td width="50"><b>CPF:</b></td>
                            <td><?php echo $cpf; ?></td>
                        </tr>
                    </table>
                    <hr />
                    <br />
                    <h2>Produtos</h2>
                    <hr />
                    <table width="780" border="1" cellspacing="0" class="showProducts">
                        <tr>
                            <td width="20"><b>Cód:</b></td>
                            <td width="60"><b>Produto:</b></td>
                            <td width="20"><b>QTD:</b></td>
                            <td width="60"><b>Imposto:</b></td>
                            <td width="60"><b>Preço:</b></td>
                            <td width="60"><b>Total de Imposto:</b></td>
                            <td width="60"><b>Valor Total:</b></td>
                        </tr>
                        <?php foreach ($products as $p) : ?>
                            <tr>
                                <td><?php echo $p->getId(); ?></td>
                                <td><?php echo $p->getName(); ?></td>
                                <td><?php echo $p->getAmount(); ?></td>
                                <td><?php echo $p->getTax(true); ?>%</td>
                                <td>R$ <?php echo $p->getPrice(true); ?></td>
                                <td>R$ <?php echo number_format($p->getAmount() * $p->getPrice(), 2, ',', '.'); ?></td>
                                <td>R$ <?php echo number_format(($p->getTax() * ($p->getAmount() * $p->getPrice())) / 100, '2', ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <hr />
                    <br />
                    <div style="width: 780px; text-align: right; font-size: 12px;"><span style="border: 1px solid #000; padding: 10px;"><b>Total de Impostos:</b> R$ <?php echo $sale->getTotalTax(true); ?></span></div>
                    <br />
                    <br />
                    <div style="width: 780px; text-align: right; font-size: 18px;"><span style="border: 1px solid #000; padding: 10px;"><b>TOTAL:</b> R$ <?php echo $sale->getTotalPrice(true); ?></span></div>
                </section>
            </main>
            <footer style="text-align: right;">
            </footer>
        </div>
    </body>
</html>