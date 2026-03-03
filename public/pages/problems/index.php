<?php

define('DB_PATH', '/var/www/database/problems.txt');
$problems = file(DB_PATH, FILE_IGNORE_NEW_LINES);
if (empty($problems)) {
  $problems = [];
}
$title = 'Problemas Registrados';
$view = '/var/www/app/views/problems/index.phtml';

require '/var/www/app/views/layouts/application.phtml';
