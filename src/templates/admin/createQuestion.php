<?php

use Classes\Controllers\Admin\CreationQuestion;
use Classes\Tools\type\TypeEnum;

// Si la méthode est POST, traiter les données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idQ = $_GET['idQ'];
    $type = $_POST['nomQ'];
    $theme = $_POST['theme'];
    CreationQuestion::CreationQuestion($idQ, $type, $label, $choices, $correct);
}
?>



<main id="create-art">
        <div>
            <h1>Création d'un quiz</h1>
            <section class="form-section">
            <form method="POST" action="#">
                <label for="type">Type de question</label>
                <input type="select" id="type" name="type">
                <?php foreach (TypeEnum::getTypes() as $type) { 
                  echo  "<option value=" . $type . ">" . $type . "</option>";} ?>
                <label for="theme">Theme de votre quiz</label>
                <input type="text" id="theme" name="theme">
                

                <div id="boutons">
                    <button type="submit" class="bouton-bas" >Créé le quiz</button>
                </div>

            </form>
        </section>
    </main>
