<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="src/static/css/connexion.css">
    <title>Quizz</title>
</head>

<body>
    <div class="header">
        <h1>Connexion a notre quizz</h1>
    </div>
    <div class="content">

        <form class="connexion" method="POST" action="tentative_co.php">
            <p>CONNEXION</p>
            <input type="text" name="nom" id="nom" placeholder="Nom" />
            <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" />
            <button type="button" name="toggle-password" id="toggle-password" class="toggle-password" data-target="passwd">afficher</button>
            <?php session_start();
            if (!empty($_SESSION['connexion_fail'])) {
                $_SESSION['connexion_fail'] = false;
                echo "<p class='fail'>L'identifiant ou le mot de passe est incorrect</p>";
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