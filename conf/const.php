<?php
//ドキュメントルート /var/www/html
define ('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define ('MODEL_PATH', $_SERVER['DOCUMENT_ROOT'].'/../model/');
define ('VIEW_PATH', $_SERVER['DOCUMENT_ROOT'].'/../view/');

define ('IMAGE_PATH', '/assets/images/');
define ('STYLESHEET_PATH', '/assets/css/');
define ('IMAGE_DIR', $_SERVER['DOCUMENT_ROOT'].'/assets/images/');

define ('DB_HOST', 'mysql');
define ('DB_NAME', 'sample');
define ('DB_USER', 'testuser');
define ('DB_PASS', 'password');
define ('DB_CHARSET', 'utf8');

