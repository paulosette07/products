<?php include_once './template-header.php'; ?>
<?php
$key = (isset($_GET['key'])) ? \Library\System::_var($_GET['key']) : false;
$id = '';
$date = date("Y-m-d");
$total_price = '';
$total_tax = '';
$note = '';
$client_id = '';
$status = '';

$clientDao = new \Application\Dao\ClientDao();
$clients = $clientDao->fetchAll();
$totalProducts = 0;
if ($key) {
    $saleProductDao = new \Application\Dao\SaleProductDao();
    $saleProducts = $saleProductDao->fetchAll($key, 'sale_id');
    $totalProducts = count($saleProducts);

    $saleDao = new \Application\Dao\SaleDao();
    $sale = $saleDao->loadById($key);
    $id = $sale->getId();
    $client_id = $sale->getClientId();
    $date = $sale->getDate();
    $total_price = $sale->getTotalPrice(true);
    $total_tax = $sale->getTotalTax(true);
    $note = $sale->getNote();
    $status = $sale->getStatus();
}
?>
<main>
    <div class="box">
        <h1>Vender</h1>
        <div class="formBox">
            <form action="sale-func.php?action=save" method="post" class="defaultForm" enctype="multipart/form-data" >
                <div class="row">
                    <label for="date">Data</label><br />
                    <input type="date" id="date" name="date" value="<?php echo $date; ?>" class="input input20"/>
                </div>
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <div class="row">
                    <label for="client_id">Cliente:</label><br />
                    <select name="client_id" id="client_id" class="input input40" required="required">
                        <option value="" >Selecionar...</option>
                        <?php $selected = null; ?>
                        <?php foreach ($clients as $client) : ?>
                            <?php $selected = ($client_id == $client->getId()) ? "selected='selected'" : ''; ?>
                            <option value="<?php echo $client->getId(); ?>" <?php echo $selected; ?>><?php echo $client->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <label for="note">OBS:</label><br />
                    <input type="text" id="note" name="note" value="<?php echo $note; ?>" class="input input60"/>
                </div>
                <div class="row">
                    <div class="col4">
                        <label for="total_tax">Imposto (R$):</label><br />
                        <input type="text" autocomplete="off"  id="total_tax" required="required" name="total_tax" value="<?php echo $total_tax; ?>" class="input input80 readonly"/>
                    </div>
                    <div class="col4">
                        <label for="total_price">Total (R$):</label><br />
                        <input type="text" autocomplete="off"  id="total_price" required="required" name="total_price" value="<?php echo $total_price; ?>" class="input input80 readonly"/>
                    </div>
                </div>
                <div class="row col4" style="clear: both;">
                    <label for="status">Status:</label><br />
                    <input type="radio" value="1" name="status" id="orcamento" <?php echo ($status == 1) ? 'checked' : ''; ?>  class="input input10" /> <label for="orcamento" style="cursor: pointer">Orçamento</label>
                    <input type="radio" value="2" name="status" id="finalizada" <?php echo ($status == 2) ? 'checked' : ''; ?>  class="input input10" /> <label for="finalizada" style="cursor: pointer">Finalizada</label>
                </div>
                <div class="row" style="border-top: 1px solid #000;">
                    <h2 style="padding: 10px;">Produtos:</h2>
                    <div class="input_fields_wrap">
                        <?php
                        $addDiv = '';
                        if ($totalProducts > 0):
                        $i = 0;
                        ?>
                            <?php foreach ($saleProducts as $p): ?>
                                <?php
                                $totalPrice = $p->getAmount() * $p->getPrice();
                                $totalTax = $p->getTax() * ($p->getAmount() * $p->getPrice()) / 100;
                                $addDiv .= "'prod_".$i."'";
                                if($i<$totalProducts-1) {
                                    $addDiv .= ", ";
                                }
                                ?>
                                <div id="prod_<?php echo $i; ?>">
                                    <input type="hidden" id="sale_product_id" name="sale_product_id[]" value="<?php echo $p->getProductId(); ?>" />
                                    <input type="text" autocomplete="off" id="sale_product_name" name="sale_product_name[]" placeholder="Digite para pesquisar o produto..." value="<?php echo $p->getName(); ?>" class="input input20"/>
                                    <div id="suggesstion-box" style="display: none;"><ul class='searchList'></u></div>
                                    <input type="number" id="sale_product_amount" min="1" required="required" name="sale_product_amount[]" value="<?php echo $p->getAmount(); ?>" placeholder="QTD" class="input input5"/>
                                    <input type="text" autocomplete="off"  id="sale_product_price" required="required" name="sale_product_price[]" value="<?php echo $p->getPrice(true); ?>"  placeholder="Preço" class="input input10" onkeypress="return false;"/>
                                    <input type="text" autocomplete="off"  id="sale_product_tax" required="required" name="sale_product_tax[]" value="<?php echo $p->getTax(true); ?>"  placeholder="Imposto" class="input input10" onkeypress="return false;"/>
                                    <input type="text" id="sale_product_total" name="sale_product_total[]" value="<?php echo number_format($totalPrice, 2, ',', '.'); ?>" placeholder="Total" class="input input10" disabled="true"/>
                                    <input type="text" id="sale_product_total_tax" name="sale_product_total_tax[]" value="<?php echo number_format($totalTax, 2, ',', '.'); ?>" placeholder="Total" class="input input10" disabled="true"/>
                                    <?php
                                    if($i > 0) {
                                        echo '<a href="#" class="remove_field"><i class="fas fa-minus-square" style="font-size: 20px; color: red;"></i></a>';
                                    }
                                    ?>
                                    <a href="#" class="add_field_button"><i class="fas fa-plus-square" style="font-size: 20px;"></i></a>
                                </div>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div id="prod_0">
                                <input type="hidden" id="sale_product_id" name="sale_product_id[]" />
                                <input type="text" autocomplete="off" id="sale_product_name" name="sale_product_name[]" placeholder="Digite para pesquisar o produto..." class="input input20"/>
                                <div id="suggesstion-box" style="display: none;"><ul class='searchList'></u></div>
                                <input type="number" id="sale_product_amount" min="1" required="required" name="sale_product_amount[]" value="" placeholder="QTD" class="input input5"/>
                                <input type="text" autocomplete="off"  id="sale_product_price" required="required" name="sale_product_price[]" value="" placeholder="Preço" class="input input10" onkeypress="return false;"/>
                                <input type="text" autocomplete="off"  id="sale_product_tax" required="required" name="sale_product_tax[]" value="" placeholder="Imposto" class="input input10" onkeypress="return false;"/>
                                <input type="text" id="sale_product_total" name="sale_product_total[]" value="" placeholder="Total" class="input input10" disabled="true"/>
                                <input type="text" id="sale_product_total_tax" name="sale_product_total_tax[]" value="" placeholder="Total" class="input input10" disabled="true"/>
                                <a href="#" class="add_field_button"><i class="fas fa-plus-square" style="font-size: 20px;"></i></a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <input type="submit" class="iBtn" value="Enviar" />
                <input type="button" onclick="location.href='sale-list.php';" class="iBtnRed" value="Voltar" />
            </form>
        </div>
    </div>
</main>
<script>
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var x = 1; //initlal text box count
    $(wrapper).on("click", ".add_field_button", function (e) { //on add input button click
        e.preventDefault();
        var length = wrapper.find("input:hidden").length;
        x++; //text box increment
        $(wrapper).append('<div id="prod_' + (length + 1) + '">\n\
                                <input type="hidden" id="sale_product_id" name="sale_product_id[]" />\n\
                                <input type="text" autocomplete="off" id="sale_product_name" name="sale_product_name[]" placeholder="Digite para pesquisar o produto..." class="input input20"/>\n\
                                <div id="suggesstion-box" style="display: none;"><ul class="searchList"></u></div>\n\
                                <input type="number" min="1" id="sale_product_amount" required="required" name="sale_product_amount[]" value="" placeholder="QTD" class="input input5"/>\n\
                                <input type="text" autocomplete="off" id="sale_product_price" required="required" name="sale_product_price[]" value="" placeholder="Preço" class="input input10" onkeypress="return false;"/>\n\
                                <input type="text" autocomplete="off" id="sale_product_tax" required="required" name="sale_product_tax[]" value="" placeholder="Imposto" class="input input10" onkeypress="return false;"/>\n\
                                <input type="text" id="sale_product_total" name="sale_product_total[]" value="" placeholder="Total" class="input input10" disabled="true"/>\n\
                                <input type="text" id="sale_product_total_tax" name="sale_product_total_tax[]" value="" placeholder="Total" class="input input10" disabled="true"/>\n\
                                <a href="#" class="remove_field"><i class="fas fa-minus-square" style="font-size: 20px; color: red;"></i></a> <a href="#" class="add_field_button"><i class="fas fa-plus-square" style="font-size: 20px;"></i></a>\n\
                           </div>');
    });

    var divShow = '';
    var inputDiscount = $('#total_discount');
    var divAdd = [<?php echo $addDiv; ?>];

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        divId = $(this).parent('div').attr('id');
        delete divAdd[divId];

        var inTotalPrice = moeda2float($('#total_price').val());
        var inTotalTax = moeda2float($('#total_tax').val());
        var inProdTotal = moeda2float($('#' + divId).find('#sale_product_total').val());
        var inProdTotalTax = moeda2float($('#' + divId).find('#sale_product_total_tax').val());
        inTotalTax -= inProdTotalTax;
        inTotalPrice -= inProdTotal;
        $('#total_tax').val(float2moeda(inTotalTax));
        $('#total_price').val(float2moeda(inTotalPrice));

        $(this).parent('div').remove();
        x--;
    });

    function selectProduct(id, name, price, tax, divId) {
        var hasDiv = divAdd.indexOf(divId);
        var inTotalPrice = moeda2float($('#total_price').val());
        var inTotalTax = moeda2float($('#total_tax').val());
        if (hasDiv != -1) {
            var inTax = moeda2float($('#' + divId).find('#sale_product_tax').val());
            var inPrice = moeda2float($('#' + divId).find('#sale_product_price').val());
            var valTax = (inTax * inPrice) / 100;
            inTotalTax -= valTax;
            inTotalPrice -= inPrice;
        } else {
            divAdd.push(divId);
        }
        var valTaxPlus = (tax * price) / 100;
        inTotalTax += valTaxPlus;
        inTotalPrice += parseFloat(price);

        divShow.parent('div').find('#sale_product_id').val(id);
        divShow.parent('div').find('#sale_product_name').val(name);
        divShow.parent('div').find('#sale_product_amount').val(1);
        divShow.parent('div').find('#sale_product_price').val(float2moeda(price));
        divShow.parent('div').find('#sale_product_tax').val(tax);
        divShow.parent('div').find('#sale_product_total').val(float2moeda(price));
        divShow.parent('div').find('#sale_product_total_tax').val(float2moeda(valTaxPlus));
        divShow.hide();
        $('#total_tax').val(float2moeda(inTotalTax));
        $('#total_price').val(float2moeda(inTotalPrice));
    }

    function amountProduct(amount, divId) {
        var inTotalPrice = moeda2float($('#total_price').val());
        var inTotalTax = moeda2float($('#total_tax').val());

        var hasDiv = divAdd.indexOf(divId);
        var total = moeda2float($('#' + divId).find('#sale_product_total').val());
        var price = moeda2float($('#' + divId).find('#sale_product_price').val());
        var tax = moeda2float($('#' + divId).find('#sale_product_tax').val());
        var amountPrice = price * amount;
        var valTax = (tax * total) / 100;
        inTotalTax -= valTax;
        inTotalPrice -= total;

        var valTaxPlus = (tax * amountPrice) / 100;
        inTotalTax += valTaxPlus;
        inTotalPrice += parseFloat(amountPrice);

        $('#' + divId).find('#sale_product_total').val(float2moeda(amountPrice));
        $('#' + divId).find('#sale_product_total_tax').val(float2moeda(valTaxPlus));
        $('#total_tax').val(float2moeda(inTotalTax));
        $('#total_price').val(float2moeda(inTotalPrice));
    }

    $(wrapper).on("blur", "#sale_product_amount", function () {
        divShow = $(this).parent('div').find('#suggesstion-box');
        divId = $(this).parent('div').attr('id');
        amountProduct($(this).val(), divId);
    });

    $(wrapper).on("keyup", "#sale_product_name", function () {
        divShow = $(this).parent('div').find('#suggesstion-box');
        divId = $(this).parent('div').attr('id');
        $.ajax({
            type: "POST",
            url: "sale-func.php?action=products",
            data: 'productKey=' + $(this).val(),
            dataType: 'JSON',
            beforeSend: function () {
                $(this).css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function (response) {
                divShow.find('.searchList').html('');
                var len = response.length;
                for (var i = 0; i < len; i++) {
                    var id = response[i].id;
                    var name = response[i].name;
                    var price = response[i].price;
                    var tax = response[i].tax;

                    var tr_str = "<li onClick=\"selectProduct('" + id + "', '" + name + "', '" + price + "', '" + tax + "', '" + divId + "');\">" + name + "</li>";
                    divShow.find('.searchList').append(tr_str);
                }
                divShow.show();
            }
        });
    });
</script>
<?php include_once './template-footer.php'; ?>