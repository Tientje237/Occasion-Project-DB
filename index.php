<?php

require_once "vendor/autoload.php";

use Occasion\User;
use Smarty\Smarty;
use Occasion\Navigation;
use Occasion\CarList;
use Occasion\Stationwagon;
use Occasion\Suv;
use Occasion\Coupe;
use Occasion\Sedan;

session_start();

$action = $_GET['action'] ?? null;
$current_user = $_SESSION['current_user'] ?? null;
$users = $_SESSION['users'] ?? [];

$template = new Smarty();
$template->setTemplateDir("templates");
$template->clearCompiledTemplate();
$template->clearAllCache();

$navigation = new Navigation();

$carList = new CarList();
$car1 = new Stationwagon("Audi", "RS6 ABT Legacy Edition", "150.000", "760", "3.100", "2023", "Nardogrijs", "Benzine", "Zwart leder", "Automaat/Tiptronic", 5, "Full Option");
$car2 = new Suv("Audi", "RSQ8", "189.900", "600", "13.190", "2022", "Mythoszwart metallic", "Benzine", "Zwart leder", "Automaat/Tiptronic", 5, "Full Option");
$car3 = new Coupe("Porsche", "992 Carrera 4 GTS", "208.880", "480", "10.870", "2022", "Kreide", "Benzine", "Zwart leder", "Automaat/PDK", 4, "Full Option");
$car4 = new Coupe("Porsche", "992 GT3 RS", "250.000", "520", "3.250", "2022", "Haaiblauw", "Benzine", "Race-Tex (haaiblauw)", "Automaat/PDK", 2, "Full Option");
$car5 = new Coupe("Porsche", "911 Dakar", "409.900", "480", "78", "2023", "Wit / Gentiaanblauw", "Benzine", "Race-Tex Rallye (haaiblauw)", "Automaat/PDK", 2, "Full Option");
$car6 = new Sedan("BMW", "M3", "120.000", "450", "50.000", "2018", "Black", "Benzine", "Zwart leder", "Automatic/Steptronic", 5, "Full Option");
$car7 = new Sedan("BMW", "M5 Competition", "183.500", "625", "10.000", "2022", "Donington Grijs Metallic", "Benzine", "Zwart leder", "Automatic/Steptronic", 5, "Full Option");
$car8 = new Stationwagon("BMW", "M3 Competion Touring", "151.800", "510", "10.000", "2022", "Isle of Man groen metallic", "Benzine", "Zwart leder", "Automatic/Steptronic", 5, "Full Option");
$car9 = new Sedan("Audi", "A6", "55.000", "200", "100.000", "2018", "Zwart", "Benzine", "Zwart leder", "Handgeschakeld", 5, "Full Option");

$car9->setModel("S6");
$car9->setPrice("65.000");
$car9->setTransmission("Automatic/Tiptronic");

echo $navigation->generate();

$carList->addVehicle($car1);
$carList->addVehicle($car2);
$carList->addVehicle($car3);
$carList->addVehicle($car4);
$carList->addVehicle($car5);
$carList->addVehicle($car6);
$carList->addVehicle($car7);
$carList->addVehicle($car8);


switch ($action) {

    case "detailpagina":
        echo $car1->vehicleDetails();
        break;
    case "detailpagina2":
        echo $car9->vehicleDetails();
        break;
    case "categorie":

        break;

    case "aanbod":
        
//      echo "<td><a href='index.php?action=detailpagina'>", $car1->printVehicleInfo(), "</a></td>";
//      echo "<td><a href='index.php?action=detailpagina2'>", $car9->printVehicleInfo(), "</a></td>";
        $allCars = $carList->getAllCars();
        $template->assign('allCars', $allCars);
        $template->display("ShowCase.tpl");

        break;

    case "zoeken":
        $searchResults = [];
        $term = "";
        if (isset($_POST['searchTerm'])) {
            $term = $_POST['searchTerm'];
            $searchResults = $carList->searchCars($term);
        }

        $template->assign('searchResults', $searchResults);
        $template->assign('searchTerm', $term);
        $template->display("SearchForm.tpl");
        break;


    case "favorieten":

        if (isset($current_user) && is_object($current_user)) {

            if (isset($_POST['addFavorite'])) {
                $favoriteCar = $_POST['addFavorite'];
                $current_user->addFavorite($favoriteCar);
            }


            if (isset($_POST['removeFavorite']) && isset($_POST['favorite'])) {
                $favoriteToRemove = $_POST['favorite'];
                $current_user->removeFavorite($favoriteToRemove);
            }

            $favorites = $current_user->getFavorites();
            $template->assign('favorites', $favorites);
            $template->assign('current_user', $current_user);

            $template->display("Favorites.tpl");
        } else {
            die("Gebruiker is niet ingelogd om favorieten te kunnen markeren.");
        }


        break;

    case "register":
        $success = '';
        $error = '';

        if (!empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                if ($_POST['password1'] === $_POST['password2']) {
                    $new_user = new User($_POST['email'], $_POST['password1']);
                    $users[] = $new_user;
                    $_SESSION['users'] = $users;
                    $success = 'User registered successfully.';

                    header('Refresh: 2; URL=index.php?action=login');
                    exit;
                } else {
                    $error = 'Passwords do not match.';
                }
            } else {
                $error = 'Invalid email address.';
            }
        } else {
            $error = 'All fields are required.';
        }

        if (isset($success)) {
            $template->assign('success', $success);
        }
        if (isset($error)) {
            $template->assign('error', $error);
        }

        $template->display("RegisterForm.tpl");
        break;

    case "login":
        $success = '';
        $error = '';

        if (!empty($_POST['email']) && !empty($_POST['password1'])) {
            foreach ($users as $user) {
                if ($user->getMail() == $_POST['email']) {
                    if (password_verify($_POST['password1'], $user->getPassword())) {
                        $_SESSION['current_user'] = $user;
                        $success = 'User logged in successfully.';
                        header('Refresh: 2; URL=index.php?action=aanbod');
                        exit;
                    } else {
                        $error = 'Invalid password.';
                    }
                    break;
                }
            }
            if (empty($success)) {
                $error = 'Invalid email address.';
            }
        } else {
            $error = 'All fields are required.';
        }

        if (isset($success)) {
            $template->assign('success', $success);
        }
        if (isset($error)) {
            $template->assign('error', $error);
        }

        $template->display("LoginForm.tpl");
        break;

    case "logout":
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    default:
        $template->display("Layout.tpl");
}

?>
