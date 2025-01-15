<?php

namespace Classes\Controllers\Admin;

use App;

class CreationQuiz
{

    static function creationQuiz($nom, $theme) {
        $id = self::getId();
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('INSERT INTO QUIZ (id_Quiz,name_Q,theme) VALUES (:id, :nom, :theme)');
        $query->execute(array(':nom' => $nom, ':theme' => $theme, ':id' => $id()));
        header('Location: index.php?idQ='.$id.'action=createQuestion');
    }

    static function getId() {
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('SELECT max(id_Quiz) FROM QUIZ');
        $query->execute();
        $id = $query->fetch();
        $id = $id['max(id_Quiz)'];
        return $id+1;
    }
}
?>