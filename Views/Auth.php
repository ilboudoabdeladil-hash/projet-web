<!DOCTYPE html>
<html>
<head><title>Quizzeo Auth</title></head>
<body>
<h1><?= isset($_POST['email']) ? 'Connexion' : 'Inscription' ?></h1>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
<?php if($action==='register'): ?>
    Nom: <input type="text" name="nom" required><br>
    Prénom: <input type="text" name="prenom" required><br>
<?php endif; ?>
Email: <input type="email" name="email" required><br>
Mot de passe: <input type="password" name="password" required><br>
<?php if($action==='register'): ?>
    Rôle: 
    <select name="role">
        <option value="user">Utilisateur</option>
        <option value="admin">Admin</option>
    </select><br>
<?php endif; ?>
<button type="submit"><?= $action==='register'?'S’inscrire':'Se connecter' ?></button>
</form>
<?php if($action==='login'): ?>
<p>Pas de compte ? <a href="index.php?action=register">Inscription</a></p>
<?php else: ?>
<p>Déjà un compte ? <a href="index.php?action=login">Connexion</a></p>
<?php endif; ?>
</body>
</html>
