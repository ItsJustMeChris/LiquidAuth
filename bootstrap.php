<?php
spl_autoload_register(function ($class) {
    $classes = 'classes/' . strtolower($class) . '.class.php';
    if (file_exists($classes)) {
        require_once $classes;
    }
    $controllers = 'controllers/' . strtolower($class) . '.php';
    if (file_exists($controllers)) {
        require_once $controllers;
    }
});
?>
