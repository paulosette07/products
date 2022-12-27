<?php include_once './template-header.php'; ?>
<?php
$saleController = new Application\Controller\SaleController();
$search = null;
if (isset($_GET['search'])) {
    if ($_GET['search'] != '') {
        $search = $_GET['search'];
    }
}
$list = $saleController->list($search);
$rows = 0;
if ($list['total'] > 0) {
    $rows = $list['data'];
}
$pages = $list['pages'];
?>
<main>
    <div class="box">
        <h1>Vendas</h1>
        <div class="searchBox">
            <form action="" method="get" class="searchForm" >
                <input type="text" name="search" class="iTxt" value="<?php echo $search; ?>"/><input type="submit" value="Buscar" class="iBtn"/>
            </form>
        </div>
        <div class="listBox">
            <div class="addNutton"><a href="sale-form.php">Adicionar</a></div>
            <?php if ($rows != 0) : ?>
                <table>
                    <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Impostos</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><?php echo $r->getDate(true); ?></td>
                            <td><?php echo $r->getClient()->getName(); ?></td>
                            <td><?php echo $r->getTotalTax(true); ?></td>
                            <td><?php echo $r->getTotalPrice(true); ?></td>
                            <td><?php echo $r->getStatus(true); ?></td>
                            <td><a href="sale-form.php?key=<?php echo $r->getId(); ?>"><i class="fas fa-edit" style="color: blue;"></i></a></td>
                            <td><a href="#" onclick="deleteConfirm(<?php echo $r->getId(); ?>, 'sale-func');"><i class="fas fa-trash" style="color: red;"></i></a></td>
                            <td><a href="sale-view.php?key=<?php echo $r->getId(); ?>"><i class="fas fa-print" style="color: green;"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php if ($pages->items_total > 0) { ?>
                    <?php echo $pages->display_pages(); ?>
                    <?php echo $pages->display_items_per_page(); ?>
                    <?php echo $pages->display_jump_menu(); ?>
                <?php } ?>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php include_once './template-footer.php'; ?>