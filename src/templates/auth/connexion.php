<?php

use Classes\Controllers\Auth\AuthForm;

// Si la méthode est POST, traiter les données
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $password = $_POST['passwd'];
    $error = AuthForm::checkLoginForm($nom, $password);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion au Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
        <div class="form-container">
            <h2>Se connecter au Quiz</h2>
            <form action="#" method="post">
                <div class="input-container">
                    <input name="email" type="email" placeholder="Adresse mail" required>
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
    
    <script>
    document.querySelectorAll('.password-toggle-btn').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-target');
            const passwordField = document.getElementById(targetId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                button.textContent = '🙈';
            } else {
                passwordField.type = 'password';
                button.textContent = '👁';
            }
        });
    });
    </script>
</body>
</html>
