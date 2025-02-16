<?php

use Classes\Controllers\Admin\CreationQuestion;
use Classes\Tools\type\TypeEnum;

// Si la méthode est POST, traiter les données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idQ = $_GET['idQ'];
    $type = $_POST['type'];
    $label = $_POST['question'];
    $choices = $_POST['options'];
    $correct = $_POST['answer'];
    CreationQuestion::CreationQuestion($idQ, $type, $label, $choices, $correct, false);
}
?>

<div class="page">
    <div class="form-container">
        <h1>Création d'une question</h1>
        <section class="form-section">
            <form method="POST" action=''>
                <label for="type" class="label">Type de questions</label>
                <select name="type" id="type" required>
                    <option value="">---Type de votre question---</option>
                    <?php
                    foreach (TypeEnum::getTypes() as $type) {
                        echo "<option value='" . $type->name . "'>" . $type->name . "</option>";
                    }
                    ?>
                </select>
                <label for="question">Question</label>
                <input type="text" id="question" name="question" required>
                <div id="dynamic-fields">
                    <!-- Les champs dynamiques seront ajoutés ici -->
                </div>
                <div class="boutons">
                    <input type="submit" class="button" value="Ajouter la question">
                    <button href="index.php?action=quizAdmin" onclick="window.location.href='index.php?action=quizAdmin'">Créé le quiz</button>
                </div>
            </form>
        </section>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectType = document.getElementById('type');
        const dynamicFields = document.getElementById('dynamic-fields');

        const fieldsByType = {<?php
            foreach (TypeEnum::getTypes() as $type) {
                echo $type->name . ": `";
                echo $type->value;
                echo "`,";
            }
            ?>
        };
        selectType.addEventListener('change', () => {
            const selectedType = selectType.value;

            // Mettre à jour les champs dynamiques
            dynamicFields.innerHTML = fieldsByType[selectedType] || '';
        });
    });
</script>