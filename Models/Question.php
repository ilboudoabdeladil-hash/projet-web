<?php
class Question {
    public static function create($quiz_id, $type, $enonce, $points){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO questions (quiz_id, type, enonce, points) VALUES (?,?,?,?)");
        $stmt->execute([$quiz_id, $type, $enonce, $points]);
        return $pdo->lastInsertId();
    }

    public static function addOption($question_id, $texte, $is_correct){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO question_options (question_id, texte, is_correct) VALUES (?,?,?)");
        $stmt->execute([$question_id, $texte, $is_correct]);
    }
}
?>
