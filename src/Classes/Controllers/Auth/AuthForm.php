<?php

namespace Classes\Controllers\Auth;

class AuthForm {

    static function checkLoginForm($nom, $password) {
        $user = Auth::getUserByName($nom);

        if($user){
            //verify password
            if(password_verify($password, $user['mdp'])){
                //TODO : store user in session instead of user_id (SESSION['user']['id'])
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['type'] = $user['type'];
                if ($user['type'] == 'ADM') {
                    header('Location: /admin');}
                elseif ($user['type'] == 'USER') {
                    header('Location: /ListeQuiz');
                } else {
                header('Location: /');
            }}else{
                $error = 'Mot de passe incorrect';
            }
        }else{
            $error = "Nom d'utilisateur incorrect";
        }

        return $error;
    }

    static function checkRegisterForm($email, $password, $firstName, $lastName, $address, $phone, $level, $weight) {
        $user = Auth::getUserByEmail($email);

        if(!$user){
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['type'] = $user['type'];
            header('Location: /');
        }else{
            $error = "Un utilisateur avec cet email existe déjà";
        }

        return $error;
    }
}

?>