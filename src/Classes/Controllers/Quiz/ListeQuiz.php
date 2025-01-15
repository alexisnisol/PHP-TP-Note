<?php

namespace Classes\Controllers\Quiz;

use App;

class ListeQuiz
{
    static function getLastParticipation($idQuiz, $idPlayer)
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            *
        FROM PARTICIPE
        WHERE id_Quiz = :idQuiz AND uuid = :idPlayer
        ORDER BY date DESC
        ");
        $query->execute([':idQuiz' => $idQuiz, ':idPlayer' => $idPlayer]);
        return $query->fetch();
    }

    static function getAllParticipations($idPlayer)
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            QUIZ.name_Q,
            QUIZ.theme,
            PARTICIPE.score,
            PARTICIPE.date,
            COUNT(QUESTION.id_Q) AS totalQ
        FROM PARTICIPE
                 JOIN QUIZ ON PARTICIPE.id_Quiz = QUIZ.id_Quiz
                JOIN QUESTION ON QUIZ.id_Quiz = QUESTION.id_Quiz
        WHERE PARTICIPE.uuid = :idPlayer
        GROUP BY date, QUIZ.name_Q, QUIZ.theme, PARTICIPE.score
        ORDER BY 
            date DESC
        ");
        $query->execute([':idPlayer' => $idPlayer]);
        return $query->fetchAll();

    }

    static function getAllPlayerQuizWithTotalQuestions($uuid)
    {
        $query = App::getApp()->getBD()->prepare("
    SELECT
        QUIZ.id_Quiz,
        QUIZ.name_Q,
        QUIZ.theme,
        LAST_PARTICIPATION.score,
        COUNT(QUESTION.id_Q) as totalQ
    FROM QUIZ
    LEFT JOIN (
        SELECT 
            PARTICIPE.id_Quiz,
            PARTICIPE.score
        FROM PARTICIPE
        WHERE PARTICIPE.uuid = :uuid
          AND PARTICIPE.date = (
              SELECT MAX(subP.date)
              FROM PARTICIPE subP
              WHERE subP.uuid = :uuid AND subP.id_Quiz = PARTICIPE.id_Quiz
          )
    ) AS LAST_PARTICIPATION ON QUIZ.id_Quiz = LAST_PARTICIPATION.id_Quiz
    LEFT JOIN QUESTION ON QUIZ.id_Quiz = QUESTION.id_Quiz
    GROUP BY QUIZ.id_Quiz
");

        $query->execute([':uuid' => $uuid]);
        $quiz = $query->fetchAll();
        return $quiz;
    }
}

?>