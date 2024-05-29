<?php


namespace Cadastro\models;

class Beneficiary
{
    private $name;
    private $cpf;
    private $number;
    private $street;
    private $district;
    private $city;
    private $state;
    private $phone;
    private $cell;
    private $situation;

    public function __construct(string $name, string $cpf, string $number, string $street, string $district, string $city, string $state, string $phone = '', string $cell = '')
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->number = $number;
        $this->street = $street;
        $this->district = $district;
        $this->city = $city;
        $this->state = $state;
        $this->phone = $phone;
        $this->cell = $cell;
        $this->situation = 'A';
    }

    public function getBeneficiary()
    {
        return [
            'name' => $this-> name,
            'cpf' => $this-> cpf,
            'number' => $this-> number,
            'street' => $this-> street,
            'district' => $this-> district,
            'city' => $this-> city,
            'state' => $this-> state,
            'phone' => $this-> phone,
            'cell' => $this-> cell,
            'situation' => $this-> situation
        ];
    }
}
?>