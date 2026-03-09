<?php

require '/var/www/app/models/Problem.php';

$problem = new Problem();
$title = 'Problemas Registrados';
$view = '/var/www/app/views/problems/new.phtml';

require '/var/www/app/views/layouts/application.phtml';
