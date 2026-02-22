<?php

$id = $_GET['id'] ?? null;
if ($id === null) {
  header('Location: /pages/problems');
  exit;
}

define('DB_PATH', '/var/www/database/problems.txt');
$problems = file(DB_PATH, FILE_IGNORE_NEW_LINES);

if (!isset($problems[$id])) {
  header('Location: /pages/problems');
  exit;
}

$problem = $problems[$id];
$title = "Detalhes do Problema #{$id}";

$view = '/var/www/app/views/problems/show.phtml';
require '/var/www/app/views/layouts/application.phtml';
