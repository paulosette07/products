<?php

require_once 'autoload.php';

$action = (isset($_GET['action'])) ? $_GET['action'] : 'actionError';

$functions = array('save', 'delete', 'products');
Library\System::checkAction($action, 'sale-list', $functions);

if ($action == 'save') {
    $post = $_POST;
    $id = false;
    if (isset($post['id'])) {
        if ($post['id'] != '') {
            $id = $post['id'];
        }
    }
    $data['date'] = $post['date'];
    $data['client_id'] = $post['client_id'];
    $data['note'] = $post['note'];
    $data['status'] = $post['status'];
    $data['total_price'] = \Library\System::removeMask($post['total_price']);
    $data['total_tax'] = \Library\System::removeMask($post['total_tax']);
    
    $total = count($post['sale_product_id']);
    $products = array();
    if ($total > 0) {
        for ($i = 0; $i < $total; $i++) {
            $saleProduct = array();
            $saleProduct['product_id'] = $post['sale_product_id'][$i];
            $saleProduct['name'] = $post['sale_product_name'][$i];
            $saleProduct['amount'] = $post['sale_product_amount'][$i];
            $saleProduct['price'] = \Library\System::removeMask($post['sale_product_price'][$i]);
            $saleProduct['tax'] = \Library\System::removeMask($post['sale_product_tax'][$i]);
            $products[] = $saleProduct;
        }
    }

    $save['data'] = $data;
    $save['saleProducts'] = $products;

    $saleController = new Application\Controller\SaleController();
    $saleController->save($save, $id);
}

if ($action == 'delete') {
    $key = (isset($_GET['key'])) ? Library\System::_var($_GET['key']) : false;
    $saleController = new Application\Controller\SaleController();
    $saleController->delete($key);
}

if ($action == 'products') {
    $productDao = new Application\Dao\ProductDao();

    $searchFields = ['name'];
    $searchValue = (isset($_POST['productKey'])) ? Library\System::_var($_POST['productKey']) : '';
    $result = $productDao->list(false, $searchFields, $searchValue);
    $return = array();
    if ($result['total'] > 0) {
        foreach ($result['data'] as $p) {
            $prodArr = array();
            $prodArr['id'] = $p->getId();
            $prodArr['name'] = htmlentities($p->getName());
            $prodArr['price'] = $p->getPrice();
            $prodArr['tax'] = 0;
            if ($p->getProductType()->getTax()) {
                $prodArr['tax'] = $p->getProductType()->getTax();
            }
            $return[] = $prodArr;
        }
    } else {
        $prodArr = array();
        $prodArr['name'] = 'Nenhum registro encontrado';
        $return[] = $prodArr;
    }

    echo json_encode($return);
}    