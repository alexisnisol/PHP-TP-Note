<?php

namespace Classes\Views;

use Classes\Controllers\Auth\Auth;

class Router
{

    private static $template;


    public function __construct()
    {
        self::$template = new Template(ROOT . '/templates');
    }

    public static function render(string $view, string $title, array $cssFiles = [])
    {
        self::renderWithTemplate($view, 'main', $title, $cssFiles);
    }

    public static function renderWithTemplate(string $view, string $layout, string $title, array $cssFiles = [])
    {

        ob_start();
        require ROOT . '/templates/' . $view;
        $content = ob_get_clean();

        self::$template->setLayout($layout);
        self::$template->setTitle($title);
        self::$template->setCssFiles($cssFiles);
        self::$template->setContent($content);

        echo self::$template->compile();
    }

    public function execute()
    {
        if (isset($_GET['action']) && $_GET['action'] !== '') {
            $action = $_GET['action'];
        } else {
            $action = 'home';
        }

        switch ($action) {
            case 'home':
                self::render('quiz/listeQuiz.php', 'Liste des quiz', ['table_quiz.css']);
                break;
            case 'quiz':
                Auth::checkUserLoggedIn();
                self::render('quiz/quiz.php', 'Quiz', ['quiz.css']);
                break;
            case "resultat_quiz":
                Auth::checkUserLoggedIn();
                self::render('quiz/resultat_quiz.php', 'Résultat du quiz', ['quiz.css']);
                break;
            case 'historique':
                Auth::checkUserLoggedIn();
                self::render('quiz/historique.php', 'Historique', ['table_quiz.css']);
                break;
            case 'quizAdmin':
                Auth::checkIsAdmin();
                self::render('admin/quizAdmin.php', 'Quiz Admin', ['table_quiz.css']);
                break;
            case 'createQuiz':
                Auth::checkIsAdmin();
                self::render('admin/createQuiz.php', 'Création de quiz', ['form.css', 'create_quiz.css']);
                break;
            case 'createQuestion':
                Auth::checkIsAdmin();
                self::render('admin/createQuestion.php', 'Création de question', ['form.css', 'create_quiz.css']);
                break;
            case 'connexion':
                self::render('auth/connexion.php', 'Connexion', ['form.css']);
                break;
            case 'inscription':
                self::render('auth/inscription.php', 'Inscription', ['form.css']);
                break;
            case 'logout':
                session_destroy();
                header('Location: /index.php');
                break;
            default:
                self::render('404.php', 'Page introuvable', ['404.css']);
                break;
        }
    }
}