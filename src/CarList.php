<?php

    namespace Occasion;

    class CarList
    {
    private array $cars = [];

    public function addVehicle(Car $car)
    {
        $this->cars[] = $car;
    }

    public function getAllCars(): array
    {
        return $this->cars;
    }

    public function getCarById(int $carId)
    {
        foreach ($this->cars as $car) {
            if ($car->getId() === $carId) {
                return $car;
            }
        }
        return null;
    }

    public function searchCars($term) {
        $results = [];
        foreach ($this->cars as $car) {
            if (stripos($car->getBrand(), $term) !== false || stripos($car->getModel(), $term) !== false) {
                $results[] = $car;
            }
        }
        return $results;
    }

}

