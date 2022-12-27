<?php

/**
 * Class Client
 */

namespace Application\Controller;

use \Application\Dao\ProductTypeDao;
use \Library\System;
use \Library\Paginator;

class ProductTypeController {

    public function list($search) {
        $searchFields = ['name', 'note', 'tax'];
        $typeDao = new ProductTypeDao();
        $typeTotal = $typeDao->list(true, $searchFields, $search);

        $pages = new Paginator();
        $pages->default_ipp = 10;
        $pages->items_total = $typeTotal;
        $pages->mid_range = 9;
        $pages->paginate();

        $types = $typeDao->list(false, $searchFields, $search, $pages->start, $pages->limit);

        $types['pages'] = $pages;

        return $types;
    }

    public function save($data, $id) {
        $productTypeDao = new ProductTypeDao();
        $productType = $productTypeDao->save($data, $id);
        if (!$productType['success']) {
            System::redirect('error', 'ERROR - ' . $data['message'], 'product-type-list');
        }
        System::redirect('msg', 'Registro Salvo com Sucesso', 'product-type-list');
    }

    public function delete($key) {
        if (!$key) {
            System::redirect('error', 'ERROR - Está faltando o Código do Registro.', 'product-type-list');
        }
        $productTypeDao = new ProductTypeDao();
        if ($productTypeDao->delete($key)) {
            System::redirect('danger', 'O Registro foi removido com Sucesso.', 'product-list');
        }
    }

}
