<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/bootstrap.php';
define('TEMPLATES_PATH', 'src/templates/');
$params = explode("/", $_GET['query']);
session_start();
// [0] = view [1] = controller [2] = action
// users/auth/register
// users/view/user
if (isset($params[1]) && !isset($params[2])) {
    die("Non action controller catch");
}

if (isset($params[1]) && isset($params[2])) {
    $controllerName = '\LiquidAuth\Controllers\\'.ucfirst($params[1]).'Controller';
    $actionName = strtolower($params[2]);
    if (!class_exists($controllerName)) {
        die("Controller doesn't exist");
    }
    $controller = new $controllerName;
    $controller->$actionName();
}

$view = new \LiquidAuth\Controllers\ViewController;

$view->setView($params);

?>
