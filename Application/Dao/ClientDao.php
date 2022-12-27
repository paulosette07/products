<?php

namespace Application\Dao;

class ClientDao extends \Library\AbstractModel {

    private $id;
    private $name;
    private $cpf;
    private $phone;
    private $birthday;
    private $insert_dt;
    private $update_dt;

    public function __construct() {
        $model = "Application\Dao\ClientDao";
        $table = "client";
        parent::__construct($model, $table);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCpf($show = false) {
        $cpf = $this->cpf;
        if ($show) {
            $cpf = $this->mask($cpf, "###.###.###-##");
        }
        return $cpf;
    }

    public function getPhone($show = false) {
        $phone = $this->phone;
        if ($show) {
            $phone = $this->mask($phone, "(##) # ####-####");
        }
        return $phone;
    }

    public function getBirthday($show = false) {
        $birthday = $this->birthday;
        if ($show) {
            if(!$birthday == '' || !$birthday == null) {
                $date = new \DateTime($birthday);
                $birthday = $date->format('d/m/Y');
            }
        }
        return $birthday;
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

    public function setCpf($cpf) {
        $this->cpf = parent::prepare($cpf);
        return $this;
    }

    public function setPhone($phone) {
        $this->phone = parent::prepare($phone);
        return $this;
    }

    public function setBirthday($birthday) {
        $this->birthday = parent::prepare($birthday);
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
        $this->setCpf($data->cpf);
        $this->setPhone($data->phone);
        $this->setBirthday($data->birthday);
        $this->setInsert_dt($data->insert_dt);
        $this->setUpdate_dt($data->update_dt);
    }

}
