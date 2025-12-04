<?php
require 'config.php';

// Si l'utilisateur est déjà connecté, redirige vers le dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: views/dashboard.php");
    exit();
} else {
    // Sinon, afficher le formulaire de login
    header("Location: views/auth.php");
    exit();
}
?>
