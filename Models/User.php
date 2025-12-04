<?php
class User {
    public static function findByEmail($email){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function create($nom, $prenom, $email, $password_hash, $role){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, email, password_hash, role) VALUES (?,?,?,?,?)");
        $stmt->execute([$nom, $prenom, $email, $password_hash, $role]);
    }

    public static function toggleActive($user_id){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET actif = !actif WHERE id=?");
        $stmt->execute([$user_id]);
    }
}
?>

