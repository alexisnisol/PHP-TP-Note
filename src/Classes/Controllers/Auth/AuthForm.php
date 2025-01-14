<?php

namespace Classes\Controllers\Auth;

use App;

class AuthForm
{

    static function checkLoginForm($nom, $password)
    {
        $user = Auth::getUserByName($nom);

        $error = '';
        if ($user) {
            //verify password
            if (password_verify($password, $user['mdp'])) {

                $_SESSION['uuid'] = $user['uuid'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['type'] = $user['type'];

                if ($user['type'] == 'ADM') {
                    header('Location: index.php?action=admin');
                } elseif ($user['type'] == 'USER') {
                    header('Location: index.php');
                } else {
                    header('Location: /');
                }
            } else {
                $error = 'Mot de passe incorrect';
            }
        } else {
            $error = "Nom d'utilisateur incorrect";
        }
        return $error;
    }

    static function checkRegisterForm($nom, $password, $password2, $type)
    {
        $user = Auth::getUserByName($nom);

        $error = '';
        if (is_null($user) && $password == $password2) {

            $query = App::getApp()->getBD()->prepare('INSERT INTO UTILISATEUR (uuid,nom_U, mdp, type_U) VALUES (:uuid, :nom, :mdp, :typeU)');
            $query->execute(array(':nom' => $nom, ':mdp' => password_hash($password, PASSWORD_DEFAULT), ':typeU' => $type, ':uuid' => uniqid()));
            header('Location: index.php?action=connexion');

        } else if ($password != $password2) {
            $error = "Les mots de passe ne correspondent pas";
        } else {
            $error = "Un utilisateur avec ce nom existe déjà";
        }
        return $error;
    }
}

?>