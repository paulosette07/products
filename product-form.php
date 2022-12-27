<?php include_once './template-header.php'; ?>
<?php
$key = (isset($_GET['key'])) ? \Library\System::_var($_GET['key']) : false;
$id = '';
$name = '';
$price = '';
$note = '';
$product_type_id = '';

$productTypeDao = new \Application\Dao\ProductTypeDao();
$productTypes = $productTypeDao->fetchAll();
if ($key) {
    $productDao = new \Application\Dao\ProductDao();
    $product = $productDao->loadById($key);
    $id = $product->getId();
    $name = $product->getName();
    $price = $product->getPrice();
    $note = $product->getNote();
    $product_type_id = $product->getProductTypeId();
}
?>
<main>
    <div class="box">
        <h1>Cadastro de Produto</h1>
        <div class="formBox">
            <form action="product-func.php?action=save" method="post" class="defaultForm" enctype="multipart/form-data" >
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <div class="row">
                    <label for="name">Nome:</label><br />
                    <input type="text" id="name" required="required" name="name" value="<?php echo $name; ?>"  class="input input50"/>
                </div>
                <div class="row">
                    <label for="price">Preço (R$):</label><br />
                    <input type="text" id="price" required="required" name="price" value="<?php echo $price; ?>" class="input input20"/>
                </div>
                <div class="row">
                    <label for="note">Descrição:</label><br />
                    <input type="text" id="note" name="note" value="<?php echo $note; ?>" class="input input60"/>
                </div>
                <div class="row">
                    <label for="product_type_id">Tipo:</label><br />
                    <select name="product_type_id" id="product_type_id" class="input input40">
                        <option value="" >Selecionar...</option>
                        <?php $selected = null; ?>
                        <?php foreach ($productTypes as $type) : ?>
                            <?php $selected = ($product_type_id == $type->getId()) ? "selected='selected'" : ''; ?>
                            <option value="<?php echo $type->getId(); ?>" <?php echo $selected; ?>><?php echo $type->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" class="iBtn" value="Enviar" />
                <input type="button" onclick="location.href='product-list.php';" class="iBtnRed" value="Voltar" />
            </form>
        </div>
    </div>
</main>
<script>
    $("#price").mask('000.000.000.000.000,00', {reverse: true});
</script>
<?php include_once './template-footer.php'; ?>