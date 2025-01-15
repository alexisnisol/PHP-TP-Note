<?php

namespace Classes\Controllers\Admin;

use App;

class CreationQuiz
{

    static function creationQuiz($nom, $theme, $questions) {
        $id = getId();
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('INSERT INTO QUIZ (id_Quiz,name_Q,theme) VALUES (:id, :nom, :theme)');
        $query->execute(array(':nom' => $nom, ':theme' => $theme, ':id' => $id()));
        foreach ($questions as $question) {
            CreationQuestion::creationQuestion($id, $question['type'], $question['label'], $question['choices'], $question['correct']);
        }
        
        
    }

    static function getId() {
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('SELECT max(id_Quiz) FROM QUIZ');
        $query->execute();
        $id = $query->fetch();
        return $id+1;
    }
}
?>