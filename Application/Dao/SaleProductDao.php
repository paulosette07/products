<?php

namespace Application\Dao;

class SaleProductDao extends \Library\AbstractModel {

    private $id;
    private $name;
    private $amount;
    private $price;
    private $tax;
    private $product_id;
    private $sale_id;

    public function __construct() {
        $model = "Application\Dao\SaleProductDao";
        $table = "sale_product";
        parent::__construct($model, $table);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getPrice($show = false) {
        $price = $this->price;
        if ($show) {
            $price = number_format($price, 2, ',', '.');
        }
        return $price;
    }

    public function getTax($show = false) {
        $tax = $this->tax;
        if ($show) {
            $tax = number_format($tax, 2, ',', '.');
        }
        return $tax;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function getProduct() {
        if(!empty($this->product_id)) {
            $productDao = new \Application\Dao\ProductDao();
            $product = $productDao->loadById($this->product_id);
            return $product;
        }
        return false;
    }

    public function getSaleId() {
        return $this->sale_id;
    }

    public function getSale() {
        if(!empty($this->sale_id)) {
            $saleDao = new \Application\Dao\SaleDao();
            $sale = $saleDao->loadById($this->sale_id);
            return $sale;
        }
        return false;
    }

    public function setId($id) {
        $this->id = parent::prepare($id);
        return $this;
    }

    public function setName($name) {
        $this->name = parent::prepare($name);
        return $this;
    }

    public function setAmount($amount) {
        $this->amount = parent::prepare($amount);
        return $this;
    }

    public function setPrice($price) {
        $this->price = parent::prepare($price);
        return $this;
    }

    public function setTax($tax) {
        $this->tax = parent::prepare($tax);
        return $this;
    }

    public function setProductId($productId) {
        $this->product_id = parent::prepare($productId);
        return $this;
    }

    public function setSaleId($saleId) {
        $this->sale_id = parent::prepare($saleId);
        return $this;
    }

    public function setListData($data) {
        $this->setId($data->id);
        $this->setName($data->name);
        $this->setAmount($data->amount);
        $this->setPrice($data->price);
        $this->setTax($data->tax);
        $this->setProductId($data->product_id);
        $this->setSaleId($data->sale_id);
    }

}
