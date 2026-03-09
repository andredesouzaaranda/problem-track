<?php

require '/var/www/app/models/Problem.php';

$problem = Problem::findById(intval($_GET['id'] ?? null));

if (!$problem) {
  header('Location: /pages/problems');
  exit;
}

$title = "Detalhes do Problema #{$problem->getId()}";
$view = '/var/www/app/views/problems/show.phtml';
require '/var/www/app/views/layouts/application.phtml';
