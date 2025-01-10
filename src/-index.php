<?php
declare(strict_types=1);

require 'Classes/Autoloader.php'; //colle ici le code de l'autoloader

Autoloader::register();

use Provider\DataLoaderJson;
use Views\Template;

$loader = new DataLoaderJson('Data/model.json');
$form = $loader->getData();

$questions=[];
foreach($form as $field) {
    $className = 'Tools\type\\'.ucfirst($field['type']);
    array_push($questions, new $className($field['name'], $field['required']));
}

$action = $_REQUEST['action'] ?? false;

ob_start();
switch ($action) {
    case 'submit':
        include 'Action/answer.php';
        break;
    default:
        include 'Action/form.php';
        break;
}
$content = ob_get_clean();

$template = new Template('templates');
$template->setLayout('main');
$template->setContent($content);

echo $template->compile();

?>