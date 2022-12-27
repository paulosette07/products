<?php

/**
 * Class Client
 */

namespace Application\Controller;

use \Application\Dao\ProductDao;
use \Library\System;
use \Library\Paginator;

class ProductController {

    public function list($search) {
        $searchFields = ['name', 'note', 'price'];
        $productDao = new ProductDao();
        $productTotal = $productDao->list(true, $searchFields, $search);

        $pages = new Paginator();
        $pages->default_ipp = 10;
        $pages->items_total = $productTotal;
        $pages->mid_range = 9;
        $pages->paginate();

        $products = $productDao->list(false, $searchFields, $search, $pages->start, $pages->limit);

        $products['pages'] = $pages;

        return $products;
    }

    public function save($data, $id) {
        $productDao = new ProductDao();
        $product = $productDao->save($data, $id);
        if (!$product['success']) {
            System::redirect('error', 'ERROR - ' . $data['message'], 'product-list');
        }
        System::redirect('msg', 'Registro Salvo com Sucesso', 'product-list');
    }

    public function delete($key) {
        if (!$key) {
            System::redirect('error', 'ERROR - Está faltando o Código do Registro.', 'product-list');
        }
        $productDao = new ProductDao();
        if ($productDao->delete($key)) {
            System::redirect('danger', 'O Registro foi removido com Sucesso.', 'product-list');
        }
    }

}
