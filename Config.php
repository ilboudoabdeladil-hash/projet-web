<?php
// Configuration de la base de données
$host = '127.0.0.1:3307';
$db   = 'quizzeo';
$user = 'root';
$pass = 'Adil2005#';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Connexion échouée : ' . $e->getMessage());
}

session_start();
?>

