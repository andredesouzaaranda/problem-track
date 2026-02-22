<?php

define('DB_PATH', '/var/www/database/problems.txt');
if (!is_dir(dirname(DB_PATH))) {
  mkdir(dirname(DB_PATH), 0777, true);
}

$problems = file(DB_PATH, FILE_IGNORE_NEW_LINES);

$title = 'Problemas Registrados';
$view = '/var/www/app/views/problems/index.phtml';

require '/var/www/app/views/layouts/application.phtml';
