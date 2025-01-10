<?php

namespace Classes\Controllers\Auth;

use App;

class Auth
{

    static function isUserLoggedIn() {
        return isset($_SESSION['nom']);
    }

    static function getCurrentUser() {
        if (self::isUserLoggedIn()) {
            return [
                'id' => $_SESSION['uuId'],
                'nom' => $_SESSION['nom'],
                'score' => $_SESSION['score']
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
                $utilisateur = ['nom' => $user['nom_U'],'mdp' => $user['mdp'],'type' => $user['type_U']];
        } else {
            $utilisateur = null;
        }

        return $utilisateur;
    }

}
?>