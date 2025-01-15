<?php

namespace Classes\Controllers\Quiz;

use App;

class Questions
{
    static function getQuestions($idQuiz): array
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            id_Q, type_Q as type, label, choices, correct
        FROM QUESTION
        WHERE id_Quiz = :idQuiz
        ");
        $query->execute([':idQuiz' => $idQuiz]);
        return $query->fetchAll();
    }

    static function getQuestion($idQuestion, $idQuiz)
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            id_Q, type_Q as type, label, choices, correct
        FROM QUESTION
        WHERE id_Q = :idQuestion AND id_Quiz = :idQuiz
        ");
        $query->execute([':idQuestion' => $idQuestion, ':idQuiz' => $idQuiz]);
        return $query->fetch();
    }

    static function getTotalQuestions($idQuiz): int
    {
        $query = App::getApp()->getBD()->prepare("
        SELECT
            COUNT(*)
        FROM QUESTION
        WHERE id_Quiz = :idQuiz
        ");
        $query->execute([':idQuiz' => $idQuiz]);
        return $query->fetchColumn();
    }

    static function loadQuestions($idQuiz): array
    {
        $questionsData = self::getQuestions($idQuiz);
        $questions = [];
        foreach ($questionsData as $question) {
            $className = 'Classes\Tools\type\\'.ucfirst($question['type']);
            $questions[] = new $className(
                $question['id_Q'],
                $question['label'],
                self::getChoicesInArray($question['choices']),
                self::getAnswers($question['correct'])
            );
        }
        return $questions;
    }

    static function loadQuestion($idQuestion, $idQuiz)
    {
        $questionData = self::getQuestion($idQuestion, $idQuiz);
        if (!$questionData) {
            return null;
        }
        $className = 'Classes\Tools\type\\'.ucfirst($questionData['type']);
        return new $className(
            $questionData['id_Q'],
            $questionData['label'],
            self::getChoicesInArray($questionData['choices']),
            self::getAnswers($questionData['correct'])
        );
    }

    static function getChoicesInArray($question): array
    {
        if (is_null($question)) {
            return [];
        }
        return explode(';', $question);
    }

    static function getAnswers($answers): string|array
    {
        if (is_null($answers)) {
            return "";
        }
        $res = explode(';', $answers);
        if (count($res) == 1) {
            return $res[0];
        }
        return $res;
    }
}