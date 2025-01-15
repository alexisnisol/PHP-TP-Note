<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/css/header.css">
    <link rel="stylesheet" href="./static/css/footer.css">
    <?php

    use Classes\Controllers\Auth\Auth;

    if (!empty($cssFiles)) {
        foreach ($cssFiles as $cssFile) {
            echo '<link rel="stylesheet" href="./static/css/' . $cssFile . '">';
        }
    }
    ?>
    <title><?php echo $title ?? null ?></title>
</head>
<body>

<header>
    <div class="logo">
        <img src="./static/img/logo.png" alt="Logo">
        <h1>PHP Quiz</h1>
    </div>
    <nav class="nav-menu">
        <ul>
            <li><a href="./index.php">Accueil</a></li>
            <?php
            if (!Auth::isUserLoggedIn()) {
                echo "<li><a href='index.php?action=inscription'>Inscription</a></li>";
            }
            else if (Auth::isUserAdmin()) {
                echo "<li><a href='index.php?action=quizAdmin'>Gérer</a></li>";
            }
            ?>
        </ul>
    </nav>
    <div class="actions">
        <?php
        if (Auth::isUserLoggedIn()) {
            echo '<p>Bonjour, ' . Auth::getCurrentUser()['nom'] . '</p>';

            echo '<a href="index.php?action=logout">Déconnexion</a>';
        } else {
            echo '<a href="index.php?action=connexion">Connexion</a>';
        }
        ?>
    </div>
</header>


<main>
    <?php echo $content ?? null ?>
</main>

<footer>
    <div class="col1">
        <H3>
            PHP TP noté
        </H3>
        <img src="./static/img/logo.png" alt="logo">
    </div>

    <div class="col2">
        <H3>
            Contacts
        </H3>
        <p>02 38 49 44 62</p>
        <p>Rue d'issoudun, 45067 Orléans cedex 02</p>

    </div>
    <div class="col3">
        <H3>
            Membres de l'équipe
        </H3>
        <ul>
            <li>Alexis Nisol</li>
            <li> Nicolas Lepage</li>
            <li>Alexy Wiciak</li>
        </ul>

    </div>
    <div class="horizontal">
        <p><strong>&copy; 2024 - Tous droits réservés</strong></p>
    </div>

</footer>
</body>
</html>