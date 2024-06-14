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

$carList = new CarList($pdo);

switch($action)
{
    case "detailpagina":
        $car_id = $_GET['id'] ?? null;
        if ($car_id) {
            $stmt = $pdo->prepare('SELECT * FROM Car WHERE ID = ?');
            $stmt->execute([$car_id]);
            $car = $stmt->fetch();
            if ($car) {
                if (isset($_SESSION['user_id'])) {
                    $stmt_check = $pdo->prepare('SELECT COUNT(*) FROM Favorites WHERE UserID = ? AND CarID = ?');
                    $stmt_check->execute([$_SESSION['user_id'], $car_id]);
                    $is_favorite = (bool) $stmt_check->fetchColumn();

                    $car['is_favorite'] = $is_favorite;
                } else {
                    $car['is_favorite'] = false;
                }

                $template->assign('car', $car);
                $template->assign('session_user_id', isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null);
                $template->display("CarDetails.tpl");
            } else {
                echo "Auto niet gevonden.";
            }
        } else {
            echo "Geen auto ID opgegeven.";
        }
        break;

    case "aanbod":
        $stmt = $pdo->query('SELECT * FROM Car');
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

            if (isset($_POST['remove'])) {
                $stmt = $pdo->prepare('DELETE FROM Favorites WHERE UserID = ? AND CarID = ?');
                $stmt->execute([$user_id, $car_id]);
            } else {
                $stmt_check = $pdo->prepare('SELECT COUNT(*) FROM Favorites WHERE UserID = ? AND CarID = ?');
                $stmt_check->execute([$user_id, $car_id]);
                $is_favorite = (bool) $stmt_check->fetchColumn();

                if (!$is_favorite) {
                    $stmt = $pdo->prepare('INSERT INTO Favorites (UserID, CarID) VALUES (?, ?)');
                    $stmt->execute([$user_id, $car_id]);
                }
            }

            header('Location: index.php?action=favorieten');
            exit();
        }

        $stmt = $pdo->prepare('SELECT Car.* FROM Car JOIN Favorites ON Car.ID = Favorites.CarID WHERE Favorites.UserID = ?');
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

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $stmt = $pdo->prepare('SELECT * FROM Users WHERE Email = ?');
            $stmt->execute([$_POST['email']]);
            $user = $stmt->fetch();

            if ($user && password_verify($_POST['password'], $user['PasswordHash'])) {
                $stmt = $pdo->prepare('UPDATE Users SET lastlogin = CURRENT_TIMESTAMP WHERE UserID = ?');
                $stmt->execute([$user['UserID']]);

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
