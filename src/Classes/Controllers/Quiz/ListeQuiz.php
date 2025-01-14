<?php

namespace Classes\Controllers\Quiz;

use App;

class ListeQuiz
{

    static function getAllQuiz() {
        $query = App::getApp()->getBD()->prepare('SELECT * FROM QUIZ');
        $query->execute();
        $quiz = $query->fetchAll();
        return $quiz;
    }

    static function getAllPlayerQuiz($uuid) {
        $query = App::getApp()->getBD()->prepare('SELECT * FROM QUIZ left join PARTICIPE on QUIZ.id_Quiz = PARTICIPE.id_Quiz WHERE uuid = :uuid');
        $query->execute(['uuid' => $uuid]);
        $quiz = $query->fetchAll();
        return $quiz;
    }
}
    
?>