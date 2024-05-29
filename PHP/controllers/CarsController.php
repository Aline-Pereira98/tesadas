<?php
require_once dirname(__FILE__) . '/../models/Cars.php';
require_once dirname(__FILE__) . '/../repositories/CarsRepository.php';

use Cadastro\models\Cars;
use Cadastro\repositories\CarsRepository;


class CarsController
{
    public function getCarsBeneficiary(string $idBeneficiary)
    {
        try {
            $repository = new CarsRepository();
            return $repository->getCarsBeneficiary($idBeneficiary);

        } catch (Exception $e) {
            echo 'Exce��o capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function newCar(array $data, $idBeneficiary)
    {
        try {
            [
                'plate' => $plate,
                'chassi' => $chassi,
                'automaker' => $automaker,
                'model' => $model,
                'yearManufacturing' => $yearManufacturing,
                'yearModel' => $yearModel
            ] = $data;

            $model = new Cars($plate, $chassi, $automaker, $model, $yearManufacturing, $yearModel, $idBeneficiary);
            $car = $model->getCar();

            $repository = new CarsRepository();
            $repository->registerCar($car);

        } catch (Exception $e) {
            echo 'Exce��o capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function deleteCar($idCar)
    {
        $repository = new CarsRepository();
        return $repository->deleteCar($idCar);
    }

    public function getCar($idCar)
    {
        $repository = new CarsRepository();
        return $repository->getCarById($idCar);
    }

    public function updateCar($car, $dataUpdate)
    {
        $dataUpdate['id_beneficiario'] = $car['id_beneficiario'];
        $dataUpdate['id'] = $car['id'];

        $repository = new CarsRepository();
        return $repository->updateCarById($dataUpdate);


    }
}