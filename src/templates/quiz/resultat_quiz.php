<?php

use Classes\Controllers\Quiz\QuizManager;

if (!QuizManager::isPlaying()) {
    header('Location: index.php');
    exit();
} else {
    $answers = QuizManager::getArrayAnswers();
    $quiz = QuizManager::getQuiz();
    $totalQuestions = QuizManager::getTotalQuestions();
    $allQuestions = QuizManager::getAllQuestions();
    $score = QuizManager::computeScore($allQuestions);
}
?>

    <div class="quiz-page">
        <h1><?php echo $quiz['name_Q'] . " - " . $quiz['theme'] ?></h1>
        <div class="quiz-container">
            <h1>Résultat</h1>
            <p>Vous avez obtenu <?php echo $score . '/' . $totalQuestions ?> de bonnes réponses</p>
            <div class="answers">
                <?php

                foreach ($allQuestions as $question) :
                    echo "<h2>" . $question->getLabel() . "</h2>";

                    $playerAnswer = QuizManager::getAnswerToString($answers[$question->getId()]);
                    $questionAnswer = $question->getAnswer();
                    $color = $playerAnswer == $question->getAnswer() ? "good-answer" : "bad-answer";
                    echo "<p class='" . $color . "'>Vous avez répondu : " . $playerAnswer . "</p>";
                    echo "<p>La bonne réponse était : " . $questionAnswer . "</p>";
                    ?>

                <?php endforeach; ?>
            </div>
        </div>
        <a href="index.php" class="next-button">Retour</a>
    </div>
<?php
QuizManager::saveScore($score);
?>