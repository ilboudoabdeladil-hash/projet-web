<?php
require_once '../config.php';
require_once '../models/User.php';
require_once '../models/Quiz.php';

$action = $_GET['action'] ?? '';

if($action == 'toggle_user'){
    $user_id = $_GET['user_id'];
    User::toggleActive($user_id);
    header("Location: ../views/dashboard.php");
}

if($action == 'toggle_quiz'){
    $quiz_id = $_GET['quiz_id'];
    Quiz::toggleActive($quiz_id);
    header("Location: ../views/dashboard.php");
}
?>
