<?php

use Classes\Controllers\Quiz\ListeQuiz;
use Classes\Controllers\Quiz\QuizManager;
use Classes\Controllers\Auth\Auth;


$liste_quiz = ListeQuiz::getAllPlayerQuiz(Auth::getCurrentId());
?>

<main>
    <div class="main-liste-spec">
        <h1 id="les-specs-orga">Les quiz</h1>
        <table id="table-spec">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Theme</th>
                    <th scope="col">Note</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($liste_quiz as $donnees) {
            ?>
                    <tr>
                        <td><?php echo $donnees['name_Q']; ?></td>
                        <td><?php echo $donnees['theme']; ?></td>
                        <td><?php echo $donnees['score'] ? $donnees['score'] . '/20': 'Non participé'; ?></td>
                        <?php
                        if (Auth::isUserLoggedIn()) {
                            $texte = $donnees['score'] == null ? 'Participer' : 'Refaire';

                            if (QuizManager::isPlaying() && QuizManager::getCurrentIdQuiz() == $donnees['id_Quiz']) {
                                $texte = '<strong>Continuer</strong>';
                            }
                            echo '<td><a href="index.php?action=quiz&id=' . $donnees['id_Quiz'] . '">' . $texte . '</a></td>';
                        } else {
                            echo '<td><a href="index.php?action=connexion">Se connecter</a></td>';
                        }
                        ?>
                    </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</main>