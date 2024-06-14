<?php

global $pdo;
require_once "vendor/autoload.php";
require_once "src/db.php";

use Occasion\User;
use Smarty\Smarty;
use Occasion\CarList;

session_start();

$action = $_GET['action'] ?? null;

$template = new Smarty();
$template->setTemplateDir("templates");
$template->clearCompiledTemplate();
$template->clearAllCache();

echo "Occasion site<br>";

if (isset($_SESSION['user_id'])) {
    echo "<td><a href='index.php?action=aanbod'>Aanbod</a><br></td>";
    echo "<td><a href='index.php?action=favorieten'>Favorieten</a><br></td>";
    echo "<td><a href='index.php?action=zoeken'>Zoeken</a><br></td>";
    echo "<td><a href='index.php?action=logout'>Uitloggen</a><br></td>";
} else {
    echo "<td><a href='index.php?action=aanbod'>Aanbod</a><br></td>";
    echo "<td><a href='index.php?action=favorieten'>Favorieten</a><br></td>";
    echo "<td><a href='index.php?action=zoeken'>Zoeken</a><br></td>";
    echo "<td><a href='index.php?action=login'>Inloggen</a><br></td>";
    echo "<td><a href='index.php?action=register'>Registreren</a><br></td>";
}
echo "<br><br>";

$carList = new CarList($pdo);

switch($action)
{
    case "detailpagina":
        $car_id = $_GET['id'] ?? null;
        if ($car_id) {
            $stmt = $pdo->prepare('SELECT * FROM Auto WHERE ID = ?');
            $stmt->execute([$car_id]);
            $car = $stmt->fetch();
            if ($car) {
                $template->assign('car', $car);
                $template->display("CarDetails.tpl");
            } else {
                echo "Auto niet gevonden.";
            }
        } else {
            echo "Geen auto ID opgegeven.";
        }
        break;

    case "aanbod":
        $stmt = $pdo->query('SELECT * FROM car');
        $cars = $stmt->fetchAll();
        $template->assign('cars', $cars);
        $template->display("CarList.tpl");
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
        if (!isset($_SESSION['user_id'])) {
            echo "Log in om favorieten te beheren.";
            exit;
        }
        $user_id = $_SESSION['user_id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['car_id'])) {
            $car_id = $_POST['car_id'];
            $stmt = $pdo->prepare('INSERT INTO Favorites (UserID, AutoID) VALUES (?, ?)');
            $stmt->execute([$user_id, $car_id]);
        }
        $stmt = $pdo->prepare('SELECT Auto.* FROM Auto JOIN Favorites ON Auto.ID = Favorites.AutoID WHERE Favorites.UserID = ?');
        $stmt->execute([$user_id]);
        $favorites = $stmt->fetchAll();
        $template->assign('favorites', $favorites);
        $template->display("Favorites.tpl");
        break;

    case "register":
        $success = '';
        $error = '';
        if (!empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                if ($_POST['password1'] == $_POST['password2']) {
                    $email = $_POST['email'];
                    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare('INSERT INTO Users (Email, PasswordHash) VALUES (?, ?)');
                    $stmt->execute([$email, $password]);
                    $success = 'User registered successfully.';
                    header('Location: index.php?action=login', true, 303);
                    exit();
                } else {
                    $error = 'Passwords do not match.';
                }
            } else {
                $error = 'Invalid email address.';
            }
        } else {
            $error = 'All fields are required.';
        }
        $template->assign('success', $success);
        $template->assign('error', $error);
        $template->display("RegisterForm.tpl");
        break;

    case "login":
        $template->display("LoginForm.tpl");
        $success = '';
        $error = '';
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $stmt = $pdo->prepare('SELECT * FROM Users WHERE Email = ?');
            $stmt->execute([$_POST['email']]);
            $user = $stmt->fetch();
            if ($user && password_verify($_POST['password'], $user['PasswordHash'])) {
                $_SESSION['user_id'] = $user['UserID'];
                $success = 'User logged in successfully.';
                header('Location: index.php?action=aanbod', true, 303);
                exit();
            } else {
                $error = 'Invalid email or password.';
            }
        } else {
            $error = 'All fields are required.';
        }
        $template->assign('success', $success);
        $template->assign('error', $error);
        break;

    case "logout":
        session_unset();
        session_destroy();
        header('Location: index.php?action=aanbod', true, 303);
        exit();
        break;

    default:
        $template->display("Layout.tpl");
}
?>
