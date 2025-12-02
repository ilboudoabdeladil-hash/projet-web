<?php
session_start();
require 'config.php';

// Routeur minimal
$action = $_GET['action'] ?? 'login';
switch($action){
    case 'login': login($pdo); break;
    case 'register': register($pdo); break;
    case 'dashboard': dashboard($pdo); break;
    case 'create_quiz': createQuiz($pdo); break;
    case 'edit_quiz': editQuiz($pdo); break;
    case 'take_quiz': takeQuiz($pdo); break;
    case 'logout': logout(); break;
    default: echo "Page non trouvée";
}

// ===================== FONCTIONS CONTROLEURS =====================

function login($pdo){
    $error = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($password, $user['password_hash'])){
            if(!$user['actif']) $error = "Compte désactivé.";
            else{
                $_SESSION['user'] = $user;
                header("Location: index.php?action=dashboard"); exit;
            }
        } else { $error = "Email ou mot de passe incorrect."; }
    }
    include 'views/auth.php';
}

function register($pdo){
    $error = '';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'] ?? 'user';
        try{
            $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, email, password_hash, role) VALUES (?,?,?,?,?)");
            $stmt->execute([$nom,$prenom,$email,$password_hash,$role]);
            header("Location: index.php?action=login"); exit;
        } catch(PDOException $e){
            $error = "Erreur : email déjà utilisé.";
        }
    }
    include 'views/auth.php';
}

function dashboard($pdo){
    if(!isset($_SESSION['user'])) { header("Location: index.php?action=login"); exit; }
    $user = $_SESSION['user'];
    // Récupérer les quiz selon le rôle
    if($user['role'] === 'admin'){
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $pdo->query("SELECT * FROM quizzes");
        $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM quizzes WHERE owner_id = ?");
        $stmt->execute([$user['id']]);
        $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    include 'views/dashboard.php';
}

function createQuiz($pdo){
    if(!isset($_SESSION['user'])) { header("Location: index.php?action=login"); exit; }
    $user = $_SESSION['user'];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $titre = $_POST['titre'];
        $stmt = $pdo->prepare("INSERT INTO quizzes (titre, owner_id) VALUES (?,?)");
        $stmt->execute([$titre,$user['id']]);
        header("Location: index.php?action=dashboard"); exit;
    }
    include 'views/quiz.php';
}

function editQuiz($pdo){
    if(!isset($_SESSION['user'])) { header("Location: index.php?action=login"); exit; }
    $quiz_id = $_GET['id'] ?? null;
    if(!$quiz_id) { echo "Quiz introuvable"; exit; }

    // récupérer quiz
    $stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id=?");
    $stmt->execute([$quiz_id]);
    $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

    // récupérer questions
    $stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id=?");
    $stmt->execute([$quiz_id]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include 'views/quiz.php';
}

function takeQuiz($pdo){
    $quiz_id = $_GET['id'] ?? null;
    if(!$quiz_id){ echo "Quiz introuvable"; exit; }
    $stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id=?");
    $stmt->execute([$quiz_id]);
    $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id=?");
    $stmt->execute([$quiz_id]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include 'views/quiz.php';
}

function logout(){
    session_destroy();
    header("Location: index.php?action=login");
    exit;
}
?>