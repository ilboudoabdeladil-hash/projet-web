<?php
require '../config.php';
if(!isset($_SESSION['user_id'])) header("Location: auth.php");
 
$quiz_id = $_GET['quiz_id'] ?? null;
?>
<h2>Création / Édition d'un Quiz</h2>
 
<form method="post" action="../controllers/quiz.php?action=<?= $quiz_id ? 'add_question' : 'create' ?>">
 
<?php if(!$quiz_id): ?>
 
    <!-- Création du quiz -->
    <div>
        <label for="titre">Titre du quiz :</label><br>
        <input type="text" id="titre" name="titre" required>
    </div>
 
<?php else: ?>
 
    <!-- Ajout d'une question -->
    <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quiz_id) ?>">
 
    <div>
        <label for="enonce">Question :</label><br>
        <input type="text" id="enonce" name="enonce" required>
    </div>
 
    <div>
        <label for="type">Type de question :</label><br>
        <select id="type" name="type">
            <option value="QCM">QCM</option>
            <option value="LIBRE">Réponse libre</option>
        </select>
    </div>
 
    <div>
        <label for="points">Points :</label><br>
        <input type="number" id="points" name="points" min="1" value="1">
    </div>
 
<?php endif; ?>
 
    <button type="submit">
        <?= $quiz_id ? 'Ajouter une question' : 'Créer le quiz' ?>
    </button>
 
</form>
 
 