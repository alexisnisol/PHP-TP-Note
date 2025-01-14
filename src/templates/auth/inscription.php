<?php

use Classes\Controllers\Auth\AuthForm;

// Si la méthode est POST, traiter les données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $password = $_POST['passwd'];
    $password2 = $_POST['passwdConfirm'];
    $type = 'USER';
    $error = AuthForm::checkRegisterForm($nom, $password, $password2, $type);
}
?>

<div class="page">
    <div class="form-container">
        <h2>S'inscrire au Quiz</h2>
        <form action="#" method="post">
            <div class="input-container">
                <input name="nom" type="text" placeholder="Nom" required>
            </div>
            <div class="input-container">
                <div class="password-wrapper">
                    <input id="password" name="passwd" type="password" placeholder="Mot de passe" required>
                    <button type="button" class="password-toggle-btn" data-target="password">👁</button>
                </div>
            </div>
            <div class="input-container">
                <div class="password-wrapper">
                    <input id="password2" name="passwdConfirm" type="password" placeholder="Confirmer le mot de passe" required>
                    <button type="button" class="password-toggle-btn" data-target="password2">👁</button>
                </div>
            </div>
            <?php
            if (isset($error)) {
                echo '<p class="error-message">*' . $error . '</p>';
            }
            ?>
            <button type="submit">S'inscrire</button>
        </form>

        <a href="./index.php?action=connexion" class="login-link">Déjà un compte ? Connectez-vous</a>
    </div>
</div>

<script src="./static/js/passwordToggle.js"></script>