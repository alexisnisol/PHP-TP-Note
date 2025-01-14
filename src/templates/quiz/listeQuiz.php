<?php

use Classes\Controllers\Quiz\ListeQuiz;
use Classes\Controllers\Auth\Auth;


$liste_quiz = ListeQuiz::getAllQuiz(Auth::getCurrentId());
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
                        <td>NON Participer</td>
                        <td><a href="index.php?action=quiz&id=".<?php echo $donnees['id_Quiz']; ?>>Participer</a></td>
                    </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
</main>