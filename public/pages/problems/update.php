<?php

require '/var/www/app/models/Problem.php';

$method = $_REQUEST['_method'] ?? $_SERVER['REQUEST_METHOD'];

if ($method !== 'PUT') {
  header('Location: /pages/problems');
  exit;
}

$problem = $_POST['problem'];
$id = $problem['id'] ?? null;
$title = trim($problem['title']);
$problem = Problem::findById($id);
$problem->setTitle($title);

if ($problem->save()) {
  header('Location: /pages/problems');
} else {
  $title = "Editar Problema #{$id}";
  $view = '/var/www/app/views/problems/edit.phtml';
  include '/var/www/app/views/layouts/application.phtml';
}
