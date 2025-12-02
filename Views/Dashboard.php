<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <?php
    if($user['role']==='admin'){

    echo "<h3>Liste des utilisateurs</h3>";

    foreach($users as $u){

        echo $u['nom']." ".$u['prenom']." - ".($u['actif']?'Actif':'Désactivé');

        echo " <a href='index.php?action=toggle_user&id=".$u['id']."'>Changer statut</a><br>";

    }

}
    ?>
<h1>Bonjour <?= $user['nom'] ?> <?= $user['prenom'] ?></h1>
<a href="index.php?action=logout">Déconnexion</a>
<h2>Vos Quiz</h2>
<ul>
<?php foreach($quizzes as $q): ?>
<li><?= $q['titre'] ?> 
<a href="index.php?action=edit_quiz&id=<?= $q['id'] ?>">Editer</a> | 
<a href="index.php?action=take_quiz&id=<?= $q['id'] ?>">Répondre</a>
</li>
<?php endforeach; ?>
</ul>
<a href="index.php?action=create_quiz">Créer un nouveau quiz</a>
</body>
</html>

 