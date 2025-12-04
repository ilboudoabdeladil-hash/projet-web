<?php
require '../config.php';
if(!isset($_SESSION['user_id'])) header("Location: auth.php");
 
$user_role = $_SESSION['role'];
echo "<h2>Dashboard ($user_role)</h2>";
echo "<a href='../controllers/auth.php?action=logout'>Déconnexion</a><br>";
 
if($user_role == 'admin'){
    echo "<h3>Actions Admin</h3>";
    // Ici on peut lister utilisateurs et quiz avec activation/désactivation
} elseif($user_role == 'school' || $user_role == 'company'){
    echo "<h3>Mes Quiz</h3>";
    echo "<a href='quiz_form.php'>Créer un quiz</a>";
} else {
    echo "<h3>Quiz disponibles</h3>";
}
?>
 
 
 
 