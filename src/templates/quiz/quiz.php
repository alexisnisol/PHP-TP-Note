<?php

use Classes\Controllers\Quiz\QuizManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['answer'])) {
        //$question = QuizManager::getCurrentQuestion();
        //$question->checkAnswer($_POST['answer']);
        QuizManager::addAnswer($_POST['answer']);
    } else {
        QuizManager::addAnswer([]);
    }
    QuizManager::checkNextQuestion();
}

QuizManager::checkQuizStarted($_GET['id']);

$quiz = QuizManager::getQuiz();
$question = QuizManager::getCurrentQuestion();
?>

<div class="quiz-page">
    <h1><?php echo $quiz['name_Q'] . " - " . $quiz['theme'] ?></h1>
    <div class="quiz-container">
        <h1>Question <?php echo QuizManager::getCurrentIdQuestion() . '/' . QuizManager::getTotalQuestions()?></h1>
        <form method="post" action="#">
            <?php echo $question->render()?>
            <button type="submit" class="next-button">Suivant</button>
        </form>
    </div>
</div>