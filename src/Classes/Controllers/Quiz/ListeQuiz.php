<?php

namespace Classes\Controllers\Quiz;

use App;

class ListeQuiz
{

    static function getAllPlayerQuiz($uuid)
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            QUIZ.id_Quiz,
            QUIZ.name_Q,
            QUIZ.theme,
            PARTICIPE.score
        FROM QUIZ
        LEFT JOIN PARTICIPE ON QUIZ.id_Quiz = PARTICIPE.id_Quiz AND PARTICIPE.uuid = :uuid
        ORDER BY QUIZ.id_Quiz
");
        $query->execute([':uuid' => $uuid]);
        $quiz = $query->fetchAll();
        return $quiz;
    }
}

?>