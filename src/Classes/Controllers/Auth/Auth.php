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
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email']
            ];
        }
        return null;
    }

    static function getCurrentUserObj() {
        if (self::isUserLoggedIn()) {
            return self::getUserById($_SESSION['user_id']);
        }
        return null;
    }

    static function checkUserLoggedIn() {
        if(!self::isUserLoggedIn()){
            header('Location: /index.php');
        }
    }

    static function getUserById($id) {
        $query = App::getApp()->getDB()->prepare('SELECT * FROM PERSONNE WHERE id_p = :id_p');
        $query->execute(array(':id_p' => $id));
        $user = $query->fetch();

        if($user){
            if (isset($user['salaire'])) {
                $userObj = new Instructor($user['id_p'], $user['nom'], $user['prenom'], $user['adresse'], $user['email'], $user['telephone'], $user['niveau'], $user['poids'], $user['mdp'], $user['salaire'], $user['experience']);
            } else {
                $userObj = new User($user['id_p'], $user['nom'], $user['prenom'], $user['adresse'], $user['email'], $user['telephone'], $user['niveau'], $user['poids'], $user['mdp']);
            }
        } else {
            $userObj = null;
        }

        return $userObj;
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