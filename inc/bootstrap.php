<?php
error_reporting(E_ALL);
ini_set("display_errors", '1');
ini_set("html_errors", '1');
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . '/dotenv.php';
require __DIR__. '/func.php';
require __DIR__ . '/connection.php';



$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();
