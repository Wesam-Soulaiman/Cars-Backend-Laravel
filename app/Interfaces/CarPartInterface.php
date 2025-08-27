<?php

namespace App\Interfaces;

use App\Filter\CarPartFilter;
use App\Models\CarPart;

interface CarPartInterface
{
    public function addCarPart($data);


    public function updateCarPart(CarPart $carPart, $data);


    public function deleteCarPart(CarPart $carPart);


    public function showCarPart(CarPart $carPart);


    public function indexCarPart(CarPartFilter $filters);


    public function SearchCarParts(CarPartFilter $filters);

    public function getCarPartById($id);
}
