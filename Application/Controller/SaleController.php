<?php

/**
 * Class Client
 */

namespace Application\Controller;

use \Application\Dao\SaleDao;
use \Application\Dao\SaleProductDao;
use \Library\System;
use \Library\Paginator;

class SaleController {

    public function list($search) {
        $searchFields = ['date', 'note', 'total_price'];
        $saleDao = new SaleDao();
        $saleTotal = $saleDao->list(true, $searchFields, $search);

        $pages = new Paginator();
        $pages->default_ipp = 10;
        $pages->items_total = $saleTotal;
        $pages->mid_range = 9;
        $pages->paginate();

        $sales = $saleDao->list(false, $searchFields, $search, $pages->start, $pages->limit);

        $sales['pages'] = $pages;

        return $sales;
    }

    public function save($post, $id) {
        $saleDao = new SaleDao();
        $saleProductDao = new SaleProductDao();

        $sale = $saleDao->save($post['data'], $id);
        if ($sale['success']) {
            $saleProductDao->delete($sale['id'], 'sale_id');
            $products = $post['saleProducts'];
            foreach ($products as $p) {
                $p['sale_id'] = $sale['id'];
                $saleProductDao->save($p, false, false, false);
            }
        }
        if (!$sale['success']) {
            System::redirect('error', 'ERROR - ' . $data['message'], 'sale-list');
        }
        System::redirect('msg', 'Registro Salvo com Sucesso', 'sale-list');
    }

    public function delete($key) {
        if (!$key) {
            System::redirect('error', 'ERROR - Está faltando o Código do Registro.', 'sale-list');
        }
        $saleProductDao = new SaleProductDao();
        $saleProductDao->delete($key, 'sale_id');

        $saleDao = new SaleDao();
        if ($saleDao->delete($key)) {
            System::redirect('danger', 'O Registro foi removido com Sucesso.', 'sale-list');
        }
    }

    public function view($key) {
        if (!$key) {
            System::redirect('error', 'ERROR - Está faltando o Código do Registro.', 'sale-list');
        }

        $saleDao = new SaleDao();
        $sale = $saleDao->loadById($key);
        
        $saleProductDao = new SaleProductDao();
        $saleProducts = $saleProductDao->fetchAll($key, 'sale_id');
        
        $data['sale'] = $sale;
        $data['products'] = $saleProducts;
        
        return $data;
    }

}
