<?php

use Classes\Controllers\Auth\AuthForm;

//if is post request
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //get post data
    $nom = $_POST['nom'];
    $password = $_POST['passwd'];
    $password2 = $_POST['passwd2'];
    $type = 'USER';
    $error = AuthForm::checkRegisterForm($nom, $password, $password2, $type);
}
?>
    <div class="header">
        <h1>inscription a notre quizz</h1>
    </div>
    <div class="content">

        <form class="connexion" method="POST" action="#">
            <p>Inscription</p>
            <input type="text" name="nom" id="nom" placeholder="Nom" />
            <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" />
            <button type="button" name="toggle-password" id="toggle-password" class="toggle-password" data-target="passwd">afficher</button>
            <input type="password" name="passwd2" id="passwd2" placeholder="Confirmer votre Mot de passe" />
            <button type="button" name="toggle-password" id="toggle-password" class="toggle-password" data-target="passwd2">afficher</button>
        <?php 
        if (isset($error)) {
                echo "<p class='fail'>".$error."</p>";
            } ?>
            <input type="submit" value="Se connecter" />
        </form>
    </div>
    
    <script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-target');
            const passwordField = document.getElementById(targetId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                button.textContent = 'Cacher';
            } else {
                passwordField.type = 'password';
                button.textContent = 'Afficher';
            }
        });
    });
    </script>
</body>
</html>