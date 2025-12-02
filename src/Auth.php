<?php
require_once __DIR__ . '/Utils.php';

class Auth {

    private static $usersFile = __DIR__ . '/../data/users.json';

    public static function isLogged() {
        session_start();
        return isset($_SESSION['user']);
    }

    public static function user() {
        session_start();
        return $_SESSION['user'] ?? null;
    }

    public static function login($email, $password) {
        $users = Utils::loadJSON(self::$usersFile);

        foreach ($users as $id => $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {

                if (!$user['active']) {
                    return ["error" => "Votre compte est désactivé par l'administrateur."];
                }

                session_start();
                $_SESSION['user'] = ["id" => $id, ...$user];
                return ["success" => true];
            }
        }

        return ["error" => "Identifiants incorrects"];
    }

    public static function register($email, $password, $firstname, $lastname, $role) {
        $users = Utils::loadJSON(self::$usersFile);

        foreach ($users as $u) {
            if ($u['email'] === $email) {
                return ["error" => "Email déjà utilisé"];
            }
        }

        $id = uniqid("user_");

        $users[$id] = [
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "firstname" => $firstname,
            "lastname" => $lastname,
            "role" => $role,
            "active" => true
        ];

        Utils::saveJSON(self::$usersFile, $users);

        return ["success" => true];
    }

    public static function logout() {
        session_start();
        session_destroy();
    }
}