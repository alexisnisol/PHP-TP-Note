<?php

use Classes\Controllers\Quiz\ListeQuiz;
use Classes\Controllers\Quiz\QuizManager;
use Classes\Controllers\Auth\Auth;

$liste_quiz = ListeQuiz::getAllParticipations(Auth::getCurrentId());
?>

<main>
    <div class="main-liste-spec">
        <h1 id="les-specs-orga">Voici votre historique des Quiz</h1>
        <table id="table-spec">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Theme</th>
                <th scope="col">Note</th>
                <th scope="col">Date ▲</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($liste_quiz as $donnees) {
                ?>
                <tr>
                    <td><?php echo $donnees['name_Q']; ?></td>
                    <td><?php echo $donnees['theme']; ?></td>
                    <td><?php echo $donnees['score'] . '/'. $donnees['totalQ']; ?></td>
                    <td><?php echo $donnees['date']; ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</main>