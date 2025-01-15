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
    CreationQuestion::CreationQuestion($idQ, $type, $label, $choices, $correct, true);
}
?>