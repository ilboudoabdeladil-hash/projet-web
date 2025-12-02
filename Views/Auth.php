<!DOCTYPE html>
<html>
<head>
<title><?= $action === 'login' ? 'Connexion' : 'Inscription' ?> - Quizzeo</title>
</head>
<body>
<h1><?= $action === 'login' ? 'Connexion' : 'Inscription' ?></h1>
 
<?php if(isset($error) && $error != ''): ?>
<p style="color:red;"><?= $error ?></p>
<?php endif; ?>
 
<form method="post" action="">
<?php if($action === 'register'): ?>

        Nom: <input type="text" name="nom" required><br>

        Prénom: <input type="text" name="prenom" required><br>
<?php endif; ?>
 
    Email: <input type="email" name="email" required><br>

    Mot de passe: <input type="password" name="password" required><br>
 
    <?php if($action === 'register'): ?>

        Confirmer mot de passe: <input type="password" name="password_confirm" required><br>

        Rôle: 
<select name="role">
<option value="user">Utilisateur</option>
<option value="admin">Admin</option>
</select><br>
<?php endif; ?>
 
    <button type="submit"><?= $action === 'login' ? 'Se connecter' : "S'inscrire" ?></button>
</form>
 
<?php if($action === 'login'): ?>
<p>Pas de compte ? <a href="index.php?action=register">S'inscrire</a></p>
<?php else: ?>
<p>Déjà un compte ? <a href="index.php?action=login">Se connecter</a></p>
<?php endif; ?>
 
</body>
</html>
 