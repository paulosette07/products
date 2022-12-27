<?php

require_once 'autoload.php';

$action = (isset($_GET['action'])) ? $_GET['action'] : 'actionError';

Library\System::checkAction($action, 'client-list');

if ($action == 'save') {
    $post = $_POST;
    $id = false;
    if(isset($post['id'])) {
        if($post['id'] != '') {
            $id = $post['id'];
        }
    }
    $data['name'] = $post['name'];
    $data['cpf'] = \Library\System::removeMask($post['cpf']);
    $data['phone'] = \Library\System::removeMask($post['phone']);
    $data['birthday'] = $post['birthday'];
    
    $clientController = new Application\Controller\ClientController();
    $clientController->save($data, $id);
}

if ($action == 'delete') {
    $key = (isset($_GET['key'])) ? Library\System::_var($_GET['key']) : false;
    $clientController = new Application\Controller\ClientController();
    $clientController->delete($key);
}