<?php
namespace Cadastro\models;

class Cars
{
    private $plate;
    private $chassi;
    private $automaker;
    private $model;
    private $yearManufacturing;
    private $yearModel;
    private $idBeneficiary;
    private $situation;

    public function __construct($plate, $chassi, $automaker, $model, $yearManufacturing, $yearModel, $idBeneficiary)
    {
        $this->plate = $plate;
        $this->chassi = $chassi;
        $this->automaker = $automaker;
        $this->model = $model;
        $this->yearManufacturing = $yearManufacturing;
        $this->yearModel = $yearModel;
        $this->idBeneficiary = $idBeneficiary;
        $this->situation = 'A';
    }

    public function getCar()
    {
        return [
            'plate' => $this->plate,
            'chassi' => $this->chassi,
            'automaker' => $this->automaker,
            'model' => $this->model,
            'yearManufacturing' => $this->yearManufacturing,
            'yearModel' => $this->yearModel,
            'idBeneficiary' => $this->idBeneficiary,
            'situation' => $this->situation
        ];
    }


}