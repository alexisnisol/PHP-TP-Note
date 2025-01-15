<?php

use Classes\Controllers\Quiz\ListeQuiz;
use Classes\Controllers\Quiz\QuizManager;
use Classes\Controllers\Auth\Auth;


$liste_quiz = ListeQuiz::getAllPlayerQuiz(Auth::getCurrentId());
?>

<main>
    <div class="main-liste-spec">
        <h1 id="les-specs-orga">Gérer les Quiz</h1>
        <table id="table-spec">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Theme</th>
                    <th scope="cole"><a class="add-btn"href="#">Ajouter</a></th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($liste_quiz as $donnees) {
            ?>
                <tr>
                    <td><?php echo $donnees['name_Q']; ?></td>
                    <td><?php echo $donnees['theme']; ?></td>
                    <td>
                        <div class="btn-container">
                            <a href="#" class="edit-btn">Modifier</a>
                            <a href="#" class="delete-btn">Supprimer</a>
                        </div>
                    </td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</main>