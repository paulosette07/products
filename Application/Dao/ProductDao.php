<?php

namespace Application\Dao;

class ProductDao extends \Library\AbstractModel {

    private $id;
    private $name;
    private $note;
    private $price;
    private $product_type_id;
    private $insert_dt;
    private $update_dt;

    public function __construct() {
        $model = "Application\Dao\ProductDao";
        $table = "product";
        parent::__construct($model, $table);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getNote() {
        return $this->note;
    }

    public function getPrice($show = false) {
        $price = $this->price;
        if ($show) {
            $price = number_format($price, 2, ',', '.');
        }
        return $price;
    }

    public function getProductTypeId() {
        return $this->product_type_id;
    }

    public function getProductType() {
        if(!empty($this->product_type_id)) {
            $productTypeDao = new \Application\Dao\ProductTypeDao();
            $productType = $productTypeDao->loadById($this->product_type_id);
            return $productType;
        }
        return false;
    }

    public function getInsert_dt() {
        return $this->insert_dt;
    }

    public function getUpdate_dt() {
        return $this->update_dt;
    }

    public function setId($id) {
        $this->id = parent::prepare($id);
        return $this;
    }

    public function setName($name) {
        $this->name = parent::prepare($name);
        return $this;
    }

    public function setNote($note) {
        $this->note = parent::prepare($note);
        return $this;
    }

    public function setPrice($price) {
        $this->price = parent::prepare($price);
        return $this;
    }

    public function setProductTypeId($productTypeId) {
        $this->product_type_id = parent::prepare($productTypeId);
        return $this;
    }

    public function setInsert_dt($insert_dt) {
        $this->insert_dt = $insert_dt;
        return $this;
    }

    public function setUpdate_dt($update_dt) {
        $this->update_dt = $update_dt;
        return $this;
    }

    public function setListData($data) {
        $this->setId($data->id);
        $this->setName($data->name);
        $this->setNote($data->note);
        $this->setPrice($data->price);
        $this->setProductTypeId($data->product_type_id);
        $this->setInsert_dt($data->insert_dt);
        $this->setUpdate_dt($data->update_dt);
    }

}
