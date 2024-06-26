<?php

require_once "vendor/autoload.php";
require_once "./src/db.php";
require_once "./src/MySql.php";

use Occasion\User;
use Smarty\Smarty;
use Occasion\CarList;

session_start();

$dbInstance = DB::getInstance();
$connection = $dbInstance->getConnection();
$database = new MySql($connection);

$action = $_GET['action'] ?? null;

$template = new Smarty();
$template->setTemplateDir("templates");
$template->clearCompiledTemplate();
$template->clearAllCache();

$template->assign('session_user_id', $_SESSION['user_id'] ?? null);

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

$carList = new CarList($connection);

switch($action)
{
    case "detailpagina":
        $car_id = $_GET['id'] ?? null;
        if ($car_id) {
            $car = $database->select('Car', ['*'], "ID = $car_id")[0];
            if ($car) {
                if (isset($_SESSION['user_id'])) {
                    $is_favorite = (bool)$database->select('favorites', ['COUNT(*)'], "UserID = {$_SESSION['user_id']} AND CarID = $car_id")[0]['COUNT(*)'];
                    $car['is_favorite'] = $is_favorite;
                } else {
                    $car['is_favorite'] = false;
                }

                $template->assign('car', $car);
                $template->assign('session_user_id', $_SESSION['user_id'] ?? null);
                $template->display("CarDetails.tpl");
            } else {
                echo "Auto niet gevonden.";
            }
        } else {
            echo "Geen auto ID opgegeven.";
        }
        break;

    case "aanbod":
        $cars = $database->select('car', ['*']);
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

            if (isset($_POST['remove'])) {
//                $database->delete('favorites', 'UserID = ? AND CarID = ?', [$user_id, $car_id]);
            } else {
//                $is_favorite = $database->select('favorites', ['UserID' => $user_id, 'CarID' => $car_id], ['COUNT(*) as count'])[0]['count'] > 0;
                $is_favorite = $database->select('favorites', '*', ['UserID' => $user_id, 'CarID' => $car_id])[0];
                if (!$is_favorite) {
                    $database->insert('favorites', ['UserID' => $user_id, 'CarID' => $car_id]);
                }
            }

            header('Location: index.php?action=favorieten');
            exit();
        }

        $favorites = $database->select('Car JOIN favorites ON Car.ID = favorites.CarID', ['Car.*'], 'favorites.UserID = ?', [$user_id]);
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
                    $database->insert('Users', [
                        'Email' => $email,
                        'PasswordHash' => $password
                    ]);
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

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $user = $database->select('users', ['*'], "Email = '{$_POST['email']}'")[0];

            if ($user && password_verify($_POST['password'], $user['PasswordHash'])) {
                $database->update('users', ['LastLogin' => date('Y-m-d H:i:s')], "UserID = {$user['UserID']}");

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
