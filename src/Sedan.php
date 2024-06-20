<?php

namespace Occasion;

class Sedan extends Car
{
    Private string $carosserie;

    Public function __construct(string $brand, string $model, string $price, string $hpower, string $mileage, string $year, string $color, string $fueltype, string $Interior, string $transmission, int $seats, string $specifications)
    {
        parent::__construct($brand, $model, $price, $hpower, $mileage, $year, $color, $fueltype, $Interior, $transmission, $seats, $specifications);
        $this->carosserie = 'Sedan';
    }

    public function printVehicleInfo(): string
    {
        return "$this->brand $this->model <br> €$this->price | $this->year | $this->mileage km<br><br>";
    }

    public function vehicleDetails(): string
    {
        return "$this->brand $this->model <br> €$this->price <br> $this->hpower pk <br> $this->mileage km<br> Datum Deel 1: $this->year <br> Carosserie: $this->carosserie <br> Kleur: $this->color <br> Brandstof: $this->fueltype <br> Interieur: $this->Interior <br> Transmissie: $this->transmission <br> Aantal stoelen: $this->seats <br> Specificaties: $this->specifications <br><br>";
    }
}