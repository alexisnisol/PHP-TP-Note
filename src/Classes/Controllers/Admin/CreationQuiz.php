<?php

namespace Classes\Controllers\Admin;

use App;

class CreationQuiz
{

    static function createQuiz($nom, $theme): void
    {
        $id = self::getNextId();
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('INSERT INTO QUIZ (id_Quiz,name_Q,theme) VALUES (:id, :nom, :theme)');
        $query->execute(array(':nom' => $nom, ':theme' => $theme, ':id' => $id));
        header('Location: index.php?idQ='.$id.'&action=createQuestion');
    }

    private static function getNextId() {
        $bdd = App::getApp()->getBD();
        $query = $bdd->prepare('SELECT IFNULL(max(id_Quiz), 0) as maxi FROM QUIZ');
        $query->execute();
        $res = $query->fetch();
        $id = $res['maxi'];
        return $id+1;
    }
}
?>