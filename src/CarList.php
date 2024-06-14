<?php

namespace Occasion;

class CarList {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function searchCars($term) {
        $stmt = $this->pdo->prepare("SELECT * FROM car WHERE Brand LIKE ? OR Model LIKE ? OR Specifications LIKE ?");
        $searchTerm = "%$term%";
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }
}