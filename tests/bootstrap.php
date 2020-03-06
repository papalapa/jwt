<?php

require dirname(__DIR__).'/vendor/autoload.php';

define('PROJECT_DIR', realpath(dirname(__DIR__)));
define('JWT_CERT', PROJECT_DIR.'/jwt-cert.pem');
define('JWT_KEY', PROJECT_DIR.'/jwt-key.pem');
define('JWT_EMPTY', PROJECT_DIR.'/jwt-empty.pem');
