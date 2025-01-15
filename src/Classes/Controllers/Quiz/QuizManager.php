<?php


namespace Classes\Controllers\Quiz;

use Classes\Controllers\Auth\Auth;

class QuizManager
{

    static function isPlaying()
    {
        return isset($_SESSION['idQuiz']);
    }

    static function getCurrentIdQuiz()
    {
        if (self::isPlaying()) {
            return $_SESSION['idQuiz'];
        }
        return null;
    }

    static function checkQuizStarted($currentId)
    {
        $isPlaying = self::isPlaying();
        if (!$isPlaying || $currentId != self::getCurrentIdQuiz()) {
            if ($isPlaying) {
                //TODO: popup pour dire que le quiz est déjà en cours
                self::endQuiz();
            }
            self::startQuiz($currentId);
        }
    }

    static function getCurrentIdQuestion()
    {
        if (self::isPlaying()) {
            return $_SESSION['idQuestion'];
        }
        return null;
    }

    static function startQuiz($id)
    {
        $_SESSION['idQuiz'] = $id;
        $_SESSION['idQuestion'] = 1;
        $_SESSION['answers'] = [];
    }

    static function checkNextQuestion()
    {
        if (self::nextQuestion()) {
            header('Location: index.php?action=quiz&id=' . self::getCurrentIdQuiz());
        } else {
            header('Location: index.php?action=resultat_quiz&id=' . self::getCurrentIdQuiz());
        }
        exit();
    }

    static function nextQuestion()
    {
        if ($_SESSION['idQuestion'] >= Questions::getTotalQuestions($_SESSION['idQuiz'])) {
            //self::endQuiz();
            return false;
        }
        $_SESSION['idQuestion']++;
        return true;
    }


    static function endQuiz()
    {
        unset($_SESSION['idQuiz']);
        unset($_SESSION['idQuestion']);
        unset($_SESSION['answers']);
    }

    static function getCurrentQuestion()
    {
        if (self::isPlaying()) {
            return Questions::loadQuestion($_SESSION['idQuestion'], $_SESSION['idQuiz']);
        }
        return null;
    }

    static function getTotalQuestions()
    {
        if (self::isPlaying()) {
            return Questions::getTotalQuestions($_SESSION['idQuiz']);
        }
        return null;
    }

    static function getAllQuestions()
    {
        if (self::isPlaying()) {
            return Questions::loadQuestions($_SESSION['idQuiz']);
        }
        return null;
    }

    static function getQuiz()
    {
        if (self::isPlaying()) {
            return Quiz::getQuiz($_SESSION['idQuiz']);
        }
        return null;
    }


    static function getArrayAnswers(): array
    {
        if (self::isPlaying()) {
            return $_SESSION['answers'] ?? [];
        }
        return [];
    }

    static function getAnswer($idQuestion)
    {
        if (self::isPlaying()) {
            $val = $_SESSION['answers'][$idQuestion] ?? null;

        }
        return null;
    }

    static function getAnswerToString($answer): string|array
    {
        if (is_null($answer)) {
            return "";
        }
        if (is_array($answer)) {
            return implode(',', $answer);
        }
        return $answer;
    }

    static function addAnswer($answer)
    {
        if (self::isPlaying()) {
//            if (is_array($answer)) {
//                $answer = implode(',', $answer);
//            }
            $_SESSION['answers'][$_SESSION['idQuestion']] = $answer;
        }
        return null;
    }

    static function computeScore($questions)
    {
        $score = 0;
        foreach ($questions as $question) {
            $userAnswer = $_SESSION['answers'][$question->getId()];
            $score = $question->checkAnswer($userAnswer) ? $score + $question->getScore() : $score;
            $question->setValue($userAnswer);
            $question->setLocked(true);
        }
        return $score;
    }

    static function saveScore($score): void
    {
        if (self::isPlaying()) {
            $idQuiz = $_SESSION['idQuiz'];
            $idUser = Auth::getCurrentId();
            Quiz::saveParticipation($idQuiz, $idUser, $score);
        }
        QuizManager::endQuiz();
    }
}

?>