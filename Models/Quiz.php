<?php
class Quiz {
    public static function create($titre, $owner_id){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO quizzes (titre, owner_id) VALUES (?, ?)");
        $stmt->execute([$titre, $owner_id]);
        return $pdo->lastInsertId();
    }

    public static function toggleActive($quiz_id){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE quizzes SET statut = CASE WHEN statut='en_cours' THEN 'termine' ELSE 'en_cours' END WHERE id=?");
        $stmt->execute([$quiz_id]);
    }
}
?>
