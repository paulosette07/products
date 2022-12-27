<?php include_once './template-header.php'; ?>
<?php 
$key = (isset($_GET['key'])) ? \Library\System::_var($_GET['key']) : false;
$id = '';
$name = '';
$note = '';
$tax = '';

if($key) {
   $productTypeDao = new \Application\Dao\ProductTypeDao();
   $productType = $productTypeDao->loadById($key);
   $id = $productType->getId();
   $name = $productType->getName();
   $note = $productType->getNote();
   $tax = $productType->getTax();
}
?>
<main>
    <div class="box">
        <h1>Cadastro de Tipo de Produto</h1>
        <div class="formBox">
            <form action="product-type-func.php?action=save" method="post" class="defaultForm">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <div class="row">
                    <label for="name">Nome:</label><br />
                    <input type="text" id="name" required="required" name="name" value="<?php echo $name; ?>"  class="input input50"/>
                </div>
                <div class="row">
                    <label for="tax">Imposto (%):</label><br />
                    <input type="text" id="tax" name="tax" required="required" value="<?php echo $tax; ?>" class="input input20"/>
                </div>
                <div class="row">
                    <label for="note">Descrição:</label><br />
                    <input type="text" id="note" name="note" value="<?php echo $note; ?>"  class="input input60"/>
                </div>
                <input type="submit" class="iBtn" value="Enviar" />
                <input type="button" onclick="location.href='product-type-list.php';" class="iBtnRed" value="Voltar" />
            </form>
        </div>
    </div>
</main>
<script>
    $("#tax").mask('##0,00%', {reverse: true});
</script>
<?php include_once './template-footer.php'; ?>