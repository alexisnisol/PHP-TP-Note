<?php

namespace Classes\Controllers\Auth;

use App;

class Auth
{

    static function isUserLoggedIn(): bool
    {
        return isset($_SESSION['nom']);
    }

    static function getCurrentId() {
        if (self::isUserLoggedIn()) {
            return $_SESSION['uuid'];
        }
        return null;
    }

    static function getCurrentUser() {
        if (self::isUserLoggedIn()) {
            return [
                'id' => $_SESSION['uuid'],
                'nom' => $_SESSION['nom'],
                'type' => $_SESSION['type']
            ];
        }
        return null;
    }

    static function checkUserLoggedIn() {
        if(!self::isUserLoggedIn()){
            header('Location: /index.php');
        }
    }


    static function getUserByName($nom) {
        $query = App::getApp()->getBD()->prepare('SELECT * FROM UTILISATEUR WHERE nom_U = :nom');
        $query->execute(array(':nom' => $nom));
        $user = $query->fetch();
        if($user){
                $utilisateur = ['uuid' => $user['uuid'], 'nom' => $user['nom_U'], 'mdp' => $user['mdp'],'type' => $user['type_U']];
            } else {
            $utilisateur = null;
        }

        return $utilisateur;
    }

}
?>