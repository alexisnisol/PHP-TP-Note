<?php

use Classes\Controllers\Quiz\ListeQuiz;
use Classes\Controllers\Quiz\Quiz;
use Classes\Controllers\Auth\Auth;

// Traitement de la suppression si un ID est passé
if (isset($_GET['id'])) {
    $idQuiz = intval($_GET['id']);
    Quiz::deleteQuiz($idQuiz);

    // Redirection après suppression
    header("Location: index.php?action=quizAdmin&message=Quiz supprimé avec succès");
    exit();
}

// Récupération des quiz
$liste_quiz = Quiz::getAllQuiz();
?>

<main>
    <div class="main-liste-spec">
        <h1 id="les-specs-orga">Gérer les Quiz</h1>
        <table id="table-spec">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Thème</th>
                    <th scope="col">
                        <a class="add-btn" href="index.php?action=createQuiz">Ajouter</a>
                    </th>
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
                            <a href="#" data-id="<?php echo $donnees['id_Quiz']; ?>" class="delete-btn">Supprimer</a>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const deleteButtons = document.querySelectorAll(".delete-btn");

            deleteButtons.forEach(button => {
                button.addEventListener("click", event => {
                    event.preventDefault();
                    const quizId = button.getAttribute("data-id");
                    const confirmDelete = confirm("Êtes-vous sûr de vouloir supprimer ce quiz ?");
                    if (confirmDelete) {
                        window.location.href = `index.php?action=quizAdmin&id=${quizId}`;
                    }
                });
            });
        });
    </script>
</main>
