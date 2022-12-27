<?php

require_once 'autoload.php';

$action = (isset($_GET['action'])) ? $_GET['action'] : 'actionError';

Library\System::checkAction($action, 'product-list');

if ($action == 'save') {
    $post = $_POST;
    $id = false;
    if (isset($post['id'])) {
        if ($post['id'] != '') {
            $id = $post['id'];
        }
    }
    $data['name'] = $post['name'];
    $data['note'] = $post['note'];
    $data['price'] = \Library\System::removeMask($post['price']);
    $data['product_type_id'] = $post['product_type_id'];

    $productController = new Application\Controller\ProductController();
    $productController->save($data, $id);
}

if ($action == 'delete') {
    $key = (isset($_GET['key'])) ? Library\System::_var($_GET['key']) : false;
    $productController = new Application\Controller\ProductController();
    $productController->delete($key);
}