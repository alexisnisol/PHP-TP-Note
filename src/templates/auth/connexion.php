<?php

use Classes\Controllers\Auth\AuthForm;

// Si la méthode est POST, traiter les données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $error = AuthForm::checkLoginForm($nom, $password);
}
?>

<div class="page">
    <div class="form-container">
        <h2>Se connecter au Quiz</h2>
        <form action="#" method="post">
            <div class="input-container">
                <input id="nom" name="nom" placeholder="Nom d'utilisateur" required>
            </div>
            <div class="input-container">
                <div class="password-wrapper">
                    <input id="password" name="password" type="password" placeholder="Mot de passe" required>
                    <button type="button" class="password-toggle-btn" data-target="password">👁</button>
                </div>
            </div>
            <?php
            if (isset($error)) {
                echo '<p class="error-message">*' . $error . '</p>';
            }
            ?>
            <button type="submit">Se connecter</button>
        </form>

        <a href="./index.php?action=inscription" class="register-link">Pas encore de compte ? Inscrivez-vous</a>
    </div>
</div>

<script src="./static/js/passwordToggle.js"></script>