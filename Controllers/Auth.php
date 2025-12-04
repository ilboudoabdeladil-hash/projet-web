<?php
require_once '../config.php';
require_once '../models/User.php';

$action = $_GET['action'] ?? '';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

//Fonction de nettoyage
function clean($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

//LOGIN
if ($action == 'login') {

    $email = clean($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Vérification champs vides
    if (empty($email) || empty($password)) {
        die("Veuillez remplir tous les champs.");
    }

    // Vérification email valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    $user = User::findByEmail($email);

    if ($user && password_verify($password, $user['password_hash'])) {

        if(!$user['actif']){
            die('Compte désactivé.');
        }

        // Sécurisation session
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        header("Location: ../views/dashboard.php");
        exit;

    } else {
        echo "Email ou mot de passe incorrect.";
    }

}

//REGISTER
elseif ($action == 'register') {

    $nom = clean($_POST['nom'] ?? '');
    $prenom = clean($_POST['prenom'] ?? '');
    $email = clean($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = clean($_POST['role'] ?? 'user');

    // Vérification champs vides
    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        die("Tous les champs sont obligatoires.");
    }

    // Email valide ?
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    // Email déjà enregistré ?
    if (User::findByEmail($email)) {
        die('Email déjà utilisé.');
    }

    // Mot de passe minimum
    if (strlen($password) < 6) {
        die("Le mot de passe doit contenir au moins 6 caractères.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    User::create($nom, $prenom, $email, $password_hash, $role);

    echo "Inscription réussie. <a href='../views/auth.php'>Se connecter</a>";
}

// LOGOUT
elseif ($action == 'logout') {
    session_destroy();
    header("Location: ../views/auth.php");
    exit;
}
?>
