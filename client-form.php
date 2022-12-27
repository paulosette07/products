<?php include_once './template-header.php'; ?>
<?php 
$key = (isset($_GET['key'])) ? \Library\System::_var($_GET['key']) : false;
$id = '';
$name = '';
$cpf = '';
$phone = '';
$birthday = '';

if($key) {
   $clientDao = new \Application\Dao\ClientDao();
   $client = $clientDao->loadById($key);
   $id = $client->getId();
   $name = $client->getName();
   $cpf = $client->getCpf();
   $phone = $client->getPhone();
   $birthday = $client->getBirthday();
}
?>
<main>
    <div class="box">
        <h1>Cadastro de Cliente</h1>
        <div class="formBox">
            <form action="client-func.php?action=save" method="post" class="defaultForm">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <div class="row">
                    <label for="name">Nome:</label><br />
                    <input type="text" id="name" required="required" name="name" value="<?php echo $name; ?>"  class="input input50"/>
                </div>
                <div class="row">
                    <label for="cpf">CPF:</label><br />
                    <input type="text" id="cpf" name="cpf" value="<?php echo $cpf; ?>" class="input input20"/>
                </div>
                <div class="row">
                    <label for="phone">Telefone:</label><br />
                    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"  class="input input20"/>
                </div>
                <div class="row"><br />
                    <label for="birthday">Aniversário:</label><br />
                    <input type="date" id="birthday" name="birthday" value="<?php echo $birthday; ?>" class="input input20"/>
                </div>
                <input type="submit" class="iBtn" value="Enviar" />
                <input type="button" onclick="location.href='client-list.php';" class="iBtnRed" value="Voltar" />
            </form>
        </div>
    </div>
</main>
<script>
    $("#cpf").mask("999.999.999-99");
    $("#phone").mask("(99)9 9999-9999");
</script>
<?php include_once './template-footer.php'; ?>