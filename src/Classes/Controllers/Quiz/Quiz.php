<?php

namespace Classes\Controllers\Quiz;

use App;

class Quiz
{

    static function getQuiz($id)
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            *
        FROM QUIZ
        WHERE id_Quiz = :id
        ");
        $query->execute([':id' => $id]);
        return $query->fetch();
    }

    static function getParticipation($idQuiz, $idPlayer)
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            *
        FROM PARTICIPE
        WHERE id_Quiz = :idQuiz AND uuid = :idPlayer
        ");
        $query->execute([':idQuiz' => $idQuiz, ':idPlayer' => $idPlayer]);
        return $query->fetch();
    }

    static function saveParticipation($idQuiz, $idPlayer, $score)
    {

        $participation = self::getParticipation($idQuiz, $idPlayer);
        if ($participation) {
            $query = App::getApp()->getBD()->prepare("
                UPDATE PARTICIPE
                SET score = :score, date = CURRENT_TIMESTAMP
                WHERE id_Quiz = :idQuiz AND uuid = :idPlayer
            ");
            $query->execute([':idQuiz' => $idQuiz, ':idPlayer' => $idPlayer, ':score' => $score]);
            return $query->fetch();
        } else {
            $query = App::getApp()->getBD()->prepare("
                INSERT INTO PARTICIPE (id_Quiz, uuid, score)
                VALUES (:idQuiz, :idPlayer, :score)
            ");
            $query->execute([':idQuiz' => $idQuiz, ':idPlayer' => $idPlayer, ':score' => $score]);
            return $query->fetch();
        }
    }
}