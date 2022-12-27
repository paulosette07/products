<?php

require_once 'autoload.php';

$action = (isset($_GET['action'])) ? $_GET['action'] : 'actionError';

Library\System::checkAction($action, 'product-type-list');

if ($action == 'save') {
    $post = $_POST;
    $id = false;
    if(isset($post['id'])) {
        if($post['id'] != '') {
            $id = $post['id'];
        }
    }
    $data['name'] = $post['name'];
    $data['note'] = $post['note'];
    $data['tax'] = \Library\System::removeMask($post['tax']);
    
    $productTypeController = new Application\Controller\ProductTypeController();
    $productTypeController->save($data, $id);
}

if ($action == 'delete') {
    $key = (isset($_GET['key'])) ? Library\System::_var($_GET['key']) : false;
    $productTypeController = new Application\Controller\ProductTypeController();
    $productTypeController->delete($key);
}