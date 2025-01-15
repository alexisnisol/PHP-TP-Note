<?php

namespace Classes\Controllers\Admin;

use App;

class CreationQuestion
{

    static function creationQuestion($idQ, $type, $label, $choices, $correct, $fin) {
        $id = CreationQuestion::getIdQuestion($idQ);
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('INSERT INTO QUESTION (id_Q, id_Quiz, type_Q, label, choices, correct) VALUES (:id, :idQ, :type, :label, :choices, :correct)');
        $query->execute(array(':id' => $id, ':idQ' => $idQ, ':type' => $type, ':label' => $label, ':choices' => $choices, ':correct' => $correct));
        error_log(print_r($fin)."\nerror.log");
        if ($fin) {
            header('Location: index.php?action=home');
        }
        else{
            header('Location: index.php?action=createQuestion&idQ=' . $idQ);
        }
    }

    static function getIdQuestion($idQ) {
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('SELECT max(id_Q) FROM QUESTION WHERE id_Quiz = :idQ');
        $query->execute(array(':idQ' => $idQ));
        $query->execute();
        $id = $query->fetch();
        return $id["max(id_Q)"]+1;
    }
}
?>