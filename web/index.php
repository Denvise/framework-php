<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(__DIR__.'/../src/Views/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false
]);
echo $twig->render('default.twig');

Framework\App::run();
 ?>
