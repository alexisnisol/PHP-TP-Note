<!doctype html>
<html lang="fr">

<head>
    <link rel="stylesheet" type="text/css" href="../../static/css/Table_Spec.css">
    <meta charset="utf-8">
    <title>Liste des quiz</title>

</head>
<body>
    <main>
        <div class="main-liste-spec">
            <h1 id="les-specs-orga">Les quiz</h1>
            <table id="table-spec">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Theme</th>
                        <th scope="col">Note</th>
                    </tr>
                </thead>
                <tbody>
                <?php $reponse = $bdd->query('SELECT nameQ, theme, max(score),id_Quiz FROM QUIZ NATURAL JOIN PARTICIPE where uuid = "' . $_SESSION['idU'] . '"');
                while ($donnees = $reponse->fetch()) {
                    ?>
                        <tr>
                            <td><?php echo $donnees['nameQ']; ?></td>
                            <td><?php echo $donnees['theme']; ?></td>
                            <td><?php echo $donnees['score']; ?></td>
                            <td><a href="index.php?action=quiz,id=".<?php echo $donnees['id_Quiz']; ?>>Participer</a></td>
                </tr>
                    <?php
                }
                $reponse->closeCursor();
                ?>
                <?php $reponse2 = $bdd->query('(SELECT * FROM QUIZ) minus (SELECT * FROM QUIZ NATURAL JOIN PARTICIPE where uuid = "' . $_SESSION['idU'] . '")');
                while ($donnees = $reponse2->fetch()) {
                    ?>
                        <tr>
                            <td><?php echo $donnees['nameQ']; ?></td>
                            <td><?php echo $donnees['theme']; ?></td>
                            <td>NON Participer</td>
                            <td><a href="index.php?action=quiz,id=".<?php echo $donnees['id_Quiz']; ?>>Participer</a></td>
                </tr>
                    <?php
                }
                $reponse->closeCursor();
                ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>