<?php

require '/var/www/app/models/Problem.php';

$id = intval($_GET['id']) ?? null;
if (!$id) {
  header('Location: /pages/problems');
  exit;
}

$problem = Problem::findById($id);
if (!$problem) {
  header('Location: /pages/problems');
  exit;
}

$title = "Editar Problema #{$id}";
$view = '/var/www/app/views/problems/edit.phtml';
require '/var/www/app/views/layouts/application.phtml';
