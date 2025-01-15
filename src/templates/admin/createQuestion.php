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
            <label for="answer">Bonne réponse</label>
            <input type="text" id="answer" name="answer" required>
                <div id="boutons">
                    <input type="submit" class="bouton-bas" formaction="" value="Créé le quiz">
                    <input type="submit" class="bouton-bas" formaction="index.php?action=createQuestion&idQ=' . $idQ" value="Rajouter une question">
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
                            include 'templates/admin/form/' . $type->name . '.php';
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