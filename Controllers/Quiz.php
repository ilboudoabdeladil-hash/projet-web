<?php
class Question {
    private $db;

    // Constructeur pour passer le PDO
    public function __construct($db){
        $this->db = $db;
    }

    // Créer une question
    public function create($quiz_id, $type, $enonce, $points){
        $stmt = $this->db->prepare("INSERT INTO questions (quiz_id, type, enonce, points) VALUES (?,?,?,?)");
        $stmt->execute([$quiz_id, $type, $enonce, $points]);
        return $this->db->lastInsertId();
    }

    // Ajouter une option pour une question QCM
    public function addOption($question_id, $texte, $is_correct){
        $stmt = $this->db->prepare("INSERT INTO question_options (question_id, texte, is_correct) VALUES (?,?,?)");
        $stmt->execute([$question_id, $texte, $is_correct]);
    }

    // Récupérer toutes les questions d'un quiz avec leurs options
    public function getByQuiz($quiz_id){
        $stmt = $this->db->prepare("SELECT * FROM questions WHERE quiz_id=?");
        $stmt->execute([$quiz_id]);
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Ajouter les options à chaque question
        foreach ($questions as &$q){
            $q['options'] = $this->getOptions($q['id']);
        }

        return $questions;
    }

    // Récupérer les options d'une question
    public function getOptions($question_id){
        $stmt = $this->db->prepare("SELECT * FROM question_options WHERE question_id=?");
        $stmt->execute([$question_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>