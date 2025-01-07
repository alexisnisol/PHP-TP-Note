<?php
declare(strict_types=1);

require 'Classes/Autoloader.php'; //colle ici le code de l'autoloader

Autoloader::register();

use Provider\DataLoaderJson;
use Views\Template;

// $form = [
//     [
//         'type' => 'text',
//         'name' => 'mytext',
//         'required' => false,
//     ],
//     [
//         'type' => 'hidden',
//         'name' => 'hiddenfield',
//         'required' => false,
//     ],
//     [
//         'type' => 'textarea',
//         'name' => 'mytextarea',
//         'required' => true,
//     ],
// ];

$loader = new DataLoaderJson('Data/model.json');
$form = $loader->getData();

$questions=[];
foreach($form as $field) {
    $className = 'Tools\type\\'.ucfirst($field['type']);
    array_push($questions, new $className($field['name'], $field['required']));
}

// use Database\SQLiteDatabase;
// $db = new SQLiteDatabase('Data/form.db');

// $db->createDatabase();
// $form = $db->getForm();

// ob_start();
// foreach($form as $field) {
//     $className = 'Tools\type\\'.ucfirst($field['type']);
//     //$className = ucfirst($field['type']);
//     echo new $className($field['name'], $field['required']).PHP_EOL;
// }
// $content = ob_get_clean();

/*
$text = new Text('myinput', false, 'coucou');
echo $text->render().PHP_EOL;

$checkbox = new Checkbox('mycheckbox', true);
echo $checkbox->render().PHP_EOL;

$hidden = new Hidden('myhidden');
echo $hidden->render().PHP_EOL;

echo new Text('mytexttostring').PHP_EOL;

echo new Textarea('mytextarea', true, 'default value').PHP_EOL;
*/

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