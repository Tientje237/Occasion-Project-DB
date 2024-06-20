<?php

namespace Occasion;

class User
{
    private string $email;
    private string $password;
    public static array $users = [];
    private array $favorites = [];

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        self::$users[] = $this;
    }

    public function getMail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function printFavorites(): void
    {
        echo '<h1>Favoriete auto\'s van ' . $this->email . ': <br></h1>';
        $favoriteCars = $this->getFavorites();
        if (!empty($favoriteCars)) {
            foreach ($favoriteCars as $vehicle) {
                echo '<br>' . $vehicle->printVehicleInfo() . '</br>';
            }
        } else {
            echo 'Geen favoriete auto\'s gevonden.';
        }
    }

    public function addFavorite($favorite)
    {
        if (!in_array($favorite, $this->favorites)) {
            $this->favorites[] = $favorite;
        }
    }

    public function removeFavorite($favorite)
    {
        $key = array_search($favorite, $this->favorites);

        if ($key !== false) {
            unset($this->favorites[$key]);
            $this->favorites = array_values($this->favorites);
        }
    }

    public function getFavorites()
    {
        return $this->favorites;
    }


}
