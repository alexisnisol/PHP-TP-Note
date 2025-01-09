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

        ob_start();
        require ROOT . '/Action/' . $view;
        $content = ob_get_clean();

        self::$template->setLayout('main');
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
                self::render('home.php', 'Accueil', ['index.css']);
                break;
            case 'quiz':
                self::render('quiz.php', 'Quiz', ['quiz.css']);
                break;
            default:
                self::render('404.php', 'Page introuvable', ['404.css']);
                break;
        }
    }
}