<?php

namespace Application\Dao;

class ProductTypeDao extends \Library\AbstractModel {

    private $id;
    private $name;
    private $note;
    private $tax;
    private $insert_dt;
    private $update_dt;

    public function __construct() {
        $model = "Application\Dao\ProductTypeDao";
        $table = "product_type";
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

    public function getTax($show = false) {
        $tax = $this->tax;
        if ($show) {
            $tax = $tax.'%';
        }
        return $tax;
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

    public function setTax($tax) {
        $this->tax = parent::prepare($tax);
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
        $this->setTax($data->tax);
        $this->setInsert_dt($data->insert_dt);
        $this->setUpdate_dt($data->update_dt);
    }

}
