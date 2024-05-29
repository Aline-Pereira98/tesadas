<?php
require_once dirname(__FILE__) . '/../models/Beneficiary.php';
require_once dirname(__FILE__) . '/../repositories/BeneficiaryRepository.php';
require_once dirname(__FILE__) . '/../hellpers/Validators.php';
use Cadastro\models\Beneficiary;
use Cadastro\repositories\BeneficiaryRepository;


class BeneficiaryController
{
    public function newBeneficiary(array $data)
    {
        try {
            [
                'name' => $name, 'cpf' => $cpf,
                'number' => $number, 'street' => $street,
                'district' => $district, 'city' => $city,
                'state' => $state, 'phone' => $phone, 'cell' => $cell
            ] = $data;

            $validation = new Validators();
            $validation->formattingCPF($cpf);

            $model = new Beneficiary($name, $cpf, $number, $street, $district, $city, $state, $phone, $cell);
            $beneficiary = $model->getBeneficiary();
            $repository = new BeneficiaryRepository();
            $repository->registerBeneficiary($beneficiary);

        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }

    }

    public function getBeneficiary(string $cpf)
    {
        try {
            $validation = new Validators();
            $validation->formattingCPF($cpf);
            $repository = new BeneficiaryRepository();
            return $repository->getBeneficiary($cpf);
        } catch (Exception $e) {
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
}