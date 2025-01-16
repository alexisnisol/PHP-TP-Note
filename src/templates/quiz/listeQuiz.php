<?php

use Classes\Controllers\Quiz\ListeQuiz;
use Classes\Controllers\Quiz\QuizManager;
use Classes\Controllers\Auth\Auth;

$liste_quiz = ListeQuiz::getAllPlayerQuizWithTotalQuestions(Auth::getCurrentId());
$isPlaying = QuizManager::isPlaying();
$currentIdQuiz = QuizManager::getCurrentIdQuiz();
?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll(".change-quiz");

        buttons.forEach(button => {
            button.addEventListener("click", event => {
                const id = button.getAttribute("data-id");

                const isPlaying = <?php echo json_encode($isPlaying); ?>;
                const currentIdQuiz = <?php echo json_encode($currentIdQuiz); ?>;
                if (isPlaying && currentIdQuiz !== id) {
                    if (!confirm("Un quiz est déjà en cours.\nSi vous continuez, vous perdrez votre progression. Voulez-vous continuer ?")) {
                        event.preventDefault();
                    }
                }
            });
        });
    });
</script>

<main>
    <div class="main-liste-spec">
        <h1 id="les-specs-orga">Voici la liste des Quiz disponibles</h1>
        <div class="conteneur">
            <h3 class="paragraphe">Sur cette page, vous pouvez vous exercer en réalisant les Quiz ci-dessous</h3>
            <p class="droits">Vous pouvez voir toutes les caractéristiques des Quiz, notamment leur nom, thème et vos notes.</p>
        </div>
        <table id="table-spec">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Theme</th>
                    <th scope="col">Dernière Note</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($liste_quiz as $donnees) {
            ?>
                    <tr>
                        <td><?php echo $donnees['name_Q']; ?></td>
                        <td><?php echo $donnees['theme']; ?></td>
                        <td><?php echo isset($donnees['score']) ? $donnees['score'] . '/'. $donnees['totalQ'] : 'Non participé'; ?></td>
                        <?php
                        if (Auth::isUserLoggedIn()) {
                            $texte = is_null($donnees['score']) ? 'Participer' : 'Refaire';

                            if (QuizManager::isPlaying() && QuizManager::getCurrentIdQuiz() == $donnees['id_Quiz']) {
                                $texte = '<strong>Continuer</strong>';
                            }
                            echo '<td><a data-id="' . $donnees['id_Quiz'] . '" class="change-quiz" href="index.php?action=quiz&id=' . $donnees['id_Quiz'] . '">' . $texte . '</a></td>';
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