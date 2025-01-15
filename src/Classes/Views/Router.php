<?php

namespace Classes\Views;

use Classes\Views\Template;

class Router {

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

    public function execute() {
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
                self::render('quiz/quiz.php', 'Quiz', ['quiz.css']);
                break;
            case 'connexion':
                self::render('auth/connexion.php', 'connexion', ['connexion.css']);
                break;
            case 'creaQuiz':
                self::render('auth/creaQuiz.php', 'creaQuiz', ['Create_Spec.css']);
                break;
            case 'inscription':
                self::render('auth/inscription.php', 'inscription', ['connexion.css']);
                break;
            default:
                self::render('404.php', 'Page introuvable', ['404.css']);
                break;
        }
    }
}