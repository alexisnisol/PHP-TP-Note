<?php

namespace Classes\Controllers\Quiz;

use App;

class Quiz
{

    static function getAllQuiz() {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            *
        FROM QUIZ
        ");
        $query->execute();
        return $query->fetchAll();
    }

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
        $query = App::getApp()->getBD()->prepare("
                INSERT INTO PARTICIPE (id_Quiz, uuid, score)
                VALUES (:idQuiz, :idPlayer, :score)
            ");
        $query->execute([':idQuiz' => $idQuiz, ':idPlayer' => $idPlayer, ':score' => $score]);
        return $query->fetch();
    }

    static function deleteQuiz($idQuiz)
    {
        $query = App::getApp()->getBD()->prepare("
            DELETE FROM PARTICIPE
            WHERE id_Quiz = :idQuiz
        ");
        $query->execute([':idQuiz' => $idQuiz]);

        $query = App::getApp()->getBD()->prepare("
            DELETE FROM QUESTION
            WHERE id_Quiz = :idQuiz
        ");
        $query->execute([':idQuiz' => $idQuiz]);

        $query = App::getApp()->getBD()->prepare("
            DELETE FROM QUIZ
            WHERE id_Quiz = :idQuiz
        ");
        $query->execute([':idQuiz' => $idQuiz]);

        return $query->rowCount() > 0; // Retourne true si la suppression a réussi
    }

}