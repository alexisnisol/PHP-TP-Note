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
}
    
?>