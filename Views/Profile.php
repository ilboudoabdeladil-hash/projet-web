<!DOCTYPE html>
<html>
<head>
<title>Profil - Quizzeo</title>
</head>
<body>
<h1>Mon Profil</h1>
<a href="index.php?action=dashboard">Retour au dashboard</a> |
<a href="index.php?action=logout">Déconnexion</a>
 
<?php

if(isset($error)) echo "<p style='color:red;'>$error</p>";

if(isset($success)) echo "<p style='color:green;'>$success</p>";

?>
 
<form method="post" action="">

    Nom: <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required><br>

    Prénom: <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required><br>

    Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

    Nouveau mot de passe: <input type="password" name="password"><br>

    Confirmer mot de passe: <input type="password" name="password_confirm"><br>
<button type="submit">Mettre à jour</button>
</form>
</body>
</html>
 