<?php
define('BASE_URL', '/quizzeo/');

$host = 'localhost';
$db   = 'quizzeo';
$user = 'root';
$pass = ''; // ton mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Erreur de connexion DB: ".$e->getMessage());
}
?>