<?php

namespace Occasion;

abstract class Car
{
    Protected string $id;
    Protected string $brand;
    Protected string $model;
    Protected string $price;
    Protected string $hpower;
    Protected string $mileage;
    Protected string $year;
    Protected string $color;
    Protected string $fueltype;
    Protected string $Interior;
    Protected string $transmission;
    Protected int $seats;
    Protected string $specifications;

    public static array $allCars = [];

    Public function __construct(string $brand, string $model, string $price, string $hpower, string $mileage, string $year, string $color, string $fueltype, string $Interior, string $transmission, int $seats, string $specifications)
    {
        $this->id = uniqid();
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
        $this->hpower = $hpower;
        $this->mileage = $mileage;
        $this->year = $year;
        $this->color = $color;
        $this->fueltype = $fueltype;
        $this->Interior = $Interior;
        $this->transmission = $transmission;
        $this->seats = $seats;
        $this->specifications = $specifications;
        array_push(self::$allCars, $this);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function setHpower(string $hpower): void
    {
        $this->hpower = $hpower;
    }

    public function setMileage(string $mileage): void
    {
        $this->mileage = $mileage;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    public function setFueltype(string $fueltype): void
    {
        $this->fueltype = $fueltype;
    }

    public function setInterior(string $Interior): void
    {
        $this->Interior = $Interior;
    }

    public function setTransmission(string $transmission): void
    {
        $this->transmission = $transmission;
    }

    public function setSeats(int $seats): void
    {
        $this->seats = $seats;
    }

    public function setSpecifications(string $specifications): void
    {
        $this->specifications = $specifications;
    }

    public static function getAllCars()
    {
        echo '<h1>Alle voertuigen: <br></h1>';
        foreach (self::$allCars as $vehicle) {
            echo "<br>" . $vehicle->getVehicle() . "</br>";
        }
    }

    public function vehicleDetails()
    {
        return $this->brand . ' ' . $this->model . ' ' . $this->price . ' ' . $this->hpower . ' ' . $this->mileage . ' ' . $this->year . ' ' . $this->color . ' ' . $this->fueltype . ' ' . $this->Interior . ' ' . $this->transmission . ' ' . $this->seats . ' ' . $this->specifications;
    }

    public function getBrand(): string {
        return $this->brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getHorsePower() {
        return $this->hpower;
    }

    public function getMileage() {
        return $this->mileage;
    }

    public function getYear() {
        return $this->year;
    }

    public function getColor() {
        return $this->color;
    }

    public function getFuelType() {
        return $this->fueltype;
    }

    public function getInterior() {
        return $this->Interior;
    }

    public function getTransmission() {
        return $this->transmission;
    }

    public function getSeats() {
        return $this->seats;
    }

    public function getSpecifications() {
        return $this->specifications;
    }

    public function isFavorite(): bool
    {
        return isset($_SESSION['favorites']) && in_array($this->id, $_SESSION['favorites']);
    }

    abstract public function printVehicleInfo(): string;

}