# PHP - TP Noté

## Membre de l'équipe
- Nicolas Lepage  
- Alexis Nisol  
- Alexy Wiciak  

---

## Introduction
Ce projet a été réalisé en équipe de 3 dans le cadre d'un TP noté en PHP. Il met en œuvre plusieurs fonctionnalités que nous avons apprise en cours et appliquées lors de ce projet.

---

## Prérequis
Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :
- PHP (version 8.3 ou supérieure)
- Serveur web local (Apache, Nginx ou équivalent)
- Base de données MySQL/MariaDB/SQLite

---

## Fonctionnalités

### Utilisateurs

En tant qu'utilisateur, vous devez créer un compte pour vous connecter afin de répondre aux différents quiz que vous pouvez réaliser sur la page d'accueil.

Si vous quittez pendant un quiz, vous pourrez reprendre là où vous en étiez. Vous pouvez consulter les différents noms, thèmes et les notes que vous aurez obtenues.

À la fin de chaque QCM, il sera possible de voir les éventuelles erreurs que vous aurez commises pour connaître vos bonnes et vos mauvaises réponses.

---

### Admin

En tant qu'administrateur,vous pouvez vous connecter avec les identifiants :  
> **nom** : `admin`  
> **mot de passe** : `admin`

Vous pouvez aussi répondre aux différents quiz, mais vous avez en plus la possibilité de gérer ceux-ci en ajoutant un quiz avec le nombre de questions, le thèmes, le type, les diffents choix et la bonne réponse associée.

Une fois le quiz créé, vous pourrez le modifier à tout moment. Chaque attribut est modifiable. De plus, le type de question est modulable et flexible, la structure permet de supporter de nouveaux types facilement.

Enfin, l'administrateur pourra supprimer les quiz qu'il souhaite. 

---

## Fonctionnalités prévues

- Modification d'un quiz
- Extension de l'application pour gérer des sondages
- Classement
- Chronomètre
- Navigation non séquentielle (Retour en arrière possible)
- Import / Export des quiz en json

---

## Installation

1. **Cloner le dépôt** :
   ```bash
   git clone https://github.com/alexisnisol/PHP-TP-Note.git
   cd src
   php -S localhost:8000
   ```
2. **Modifier les identifiants de connexion à la base de données** :  
   Dans `src/Config/ConfigBD.php`
