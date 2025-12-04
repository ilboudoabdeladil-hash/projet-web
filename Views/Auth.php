<?php
// Formulaire login ou register
$action = $_GET['action'] ?? 'login';
?>
<h2><?= $action == 'login' ? 'Connexion' : 'Inscription' ?></h2>
<form method="post" action="../controllers/auth.php?action=<?= $action ?>">
<?php if($action == 'register'): ?>
    Nom: <input type="text" name="nom" required><br>
    Prénom: <input type="text" name="prenom" required><br>
<?php endif; ?>
Email: <input type="email" name="email" required><br>
Mot de passe: <input type="password" name="password" required><br>
<?php if($action == 'register'): ?>
    Rôle:
    <select name="role">
        <option value="user">Utilisateur</option>
        <option value="school">École</option>
        <option value="company">Entreprise</option>
    </select><br>
<?php endif; ?>
<button type="submit"><?= $action == 'login' ? 'Se connecter' : 'S\'inscrire' ?></button>
</form>
<?php if($action == 'login'): ?>
    <a href="auth.php?action=register">Créer un compte</a>
<?php else: ?>
    <a href="auth.php?action=login">Se connecter</a>
<?php endif; ?>
 
 