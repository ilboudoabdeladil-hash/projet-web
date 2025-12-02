<h2><?= isset($quiz) ? "Quiz: ".$quiz['titre'] : "Créer un Quiz" ?></h2>
 
<?php if($action==='create_quiz' || $action==='edit_quiz'): ?>
<form method="post" action="">

    Titre du quiz: <input type="text" name="titre" value="<?= $quiz['titre'] ?? '' ?>" required><br>
<button type="submit"><?= $quiz ? "Mettre à jour" : "Créer" ?></button>
</form>
 
<h3>Ajouter une question</h3>
<form method="post" action="index.php?action=add_question&quiz_id=<?= $quiz['id'] ?>">

    Énoncé: <input type="text" name="enonce" required><br>

    Type: <select name="type">
<option value="QCM">QCM</option>
<option value="LIBRE">Libre</option>
</select><br>

    Points: <input type="number" name="points" value="1" min="1"><br>
<!-- Pour QCM on peut ajouter JS pour plusieurs options -->
<button type="submit">Ajouter question</button>
</form>
 
<?php if(!empty($questions)): ?>
<h3>Questions existantes</h3>
<ul>
<?php foreach($questions as $q): ?>
<li><?= $q['enonce'] ?> (<?= $q['type'] ?>)</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
 
<?php elseif($action==='take_quiz'): ?>
<form method="post" action="index.php?action=submit_quiz&quiz_id=<?= $quiz['id'] ?>">
<?php foreach($questions as $q): ?>
<p><?= $q['enonce'] ?> (<?= $q['points'] ?> points)</p>
<?php if($q['type']==='QCM'):

        $stmt = $pdo->prepare("SELECT * FROM question_options WHERE question_id=?");

        $stmt->execute([$q['id']]);

        $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($options as $opt): ?>
<input type="radio" name="answers[<?= $q['id'] ?>]" value="<?= $opt['id'] ?>" required> <?= $opt['texte'] ?><br>
<?php endforeach; 

    else: ?>
<input type="text" name="answers[<?= $q['id'] ?>]" required><br>
<?php endif; ?>
<?php endforeach; ?>
<button type="submit">Soumettre le quiz</button>
</form>
<?php endif; ?>
 