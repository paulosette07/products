<?php

namespace Application\Dao;

class SaleDao extends \Library\AbstractModel {

    private $id;
    private $date;
    private $total_price;
    private $total_tax;
    private $note;
    private $status;
    private $client_id;
    private $insert_dt;
    private $update_dt;

    public function __construct() {
        $model = "Application\Dao\SaleDao";
        $table = "sale";
        parent::__construct($model, $table);
    }

    public function getId() {
        return $this->id;
    }

    public function getDate($show = false) {
        $date = $this->date;
        if ($show) {
            $newDate = new \DateTime($date);
            $date = $newDate->format('d/m/Y');
        }
        return $date;
    }

    public function getTotalPrice($show = false) {
        $price = $this->total_price;
        if ($show) {
            $price = number_format($price, 2, ',', '.');
        }
        return $price;
    }

    public function getTotalTax($show = false) {
        $tax = $this->total_tax;
        if ($show) {
            $tax = number_format($tax, 2, ',', '.');
        }
        return $tax;
    }

    public function getNote() {
        return $this->note;
    }

    public function getStatus($show = false) {
        $status = $this->status;
        if ($show) {
            $status = ($status == 1) ? 'Orçamento' : 'Finalizada';
        }
        return $status;
    }

    public function getClientId() {
        return $this->client_id;
    }

    public function getClient() {
        if (!empty($this->client_id)) {
            $clientDao = new \Application\Dao\ClientDao();
            $client = $clientDao->loadById($this->client_id);
            return $client;
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

    public function setDate($date) {
        $this->date = parent::prepare($date);
        return $this;
    }

    public function setTotalPrice($price) {
        $this->total_price = parent::prepare($price);
        return $this;
    }

    public function setTotalTax($tax) {
        $this->total_tax = parent::prepare($tax);
        return $this;
    }

    public function setNote($note) {
        $this->note = parent::prepare($note);
        return $this;
    }

    public function setStatus($status) {
        $this->status = parent::prepare($status);
        return $this;
    }

    public function setClientId($clientId) {
        $this->client_id = parent::prepare($clientId);
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
        $this->setDate($data->date);
        $this->setTotalPrice($data->total_price);
        $this->setTotalTax($data->total_tax);
        $this->setNote($data->note);
        $this->setClientId($data->client_id);
        $this->setStatus($data->status);
        $this->setInsert_dt($data->insert_dt);
        $this->setUpdate_dt($data->update_dt);
    }

}
