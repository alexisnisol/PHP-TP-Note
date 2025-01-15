<?php

use Classes\Controllers\Admin\CreationQuiz;

// Si la méthode est POST, traiter les données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nomQ'];
    $theme = $_POST['theme'];
    CreationQuiz::CreationQuiz($nom, $theme);
}
?>



<main id="create-art">
        <div>
            <h1>Création d'un quiz</h1>
            <section class="form-section">
            <form method="POST" action="#">

                <label for="nomQ">Nom du quiz</label>
                <input type="text" id="nomQ" name="nomQ">

                <label for="theme">Theme de votre quiz</label>
                <input type="text" id="theme" name="theme">

                <div id="boutons">
                    <button type="submit" class="bouton-bas" >Créé le quiz</button>
                </div>

            </form>
        </section>
    </main>
