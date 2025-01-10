<?php

    
    $nom = $_POST['nom'];
    $mdp = $_POST['passwd'];
    

    $reqType = $bdd->prepare('SELECT typeU, mdp FROM UTILISATEUR WHERE nomU=:nom');
    $reqType->bindParam(":id", $id, PDO::PARAM_STR);
    $reqType->execute();

    $row = $reqType->fetch();
    $role = $row["typeU"];
    $bd_mdp = $row["mdp"];

    $_SESSION["nom"] = $nom;

    if ($mdp == $bd_mdp) {
        if ($role == "ADM") {
            header('');
            exit;
        } else {
            header('');
            exit;}
    } else {
        $_POST['fail'] = 'tr';
        require_once 'connexion.php';
    }