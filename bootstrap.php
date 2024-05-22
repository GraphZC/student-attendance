<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;
use Src\Database\DatabaseConnector;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_PORT']);

$db = new DatabaseConnector();

$conn = $db->getConnection();

require 'src/Dependency/index.php';

$router = require 'src/Router/Router.php';