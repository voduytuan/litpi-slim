<?php

define('HOST', 'localhost/litpi-slim/');
define('TABLE_PREFIX', 'lit_');
define('IS_PRODUCTION', false);

if (!IS_PRODUCTION) {
    ini_set("display_errors", 1);
}

date_default_timezone_set('Asia/Ho_Chi_Minh');

//Init array contains all configuration for website
$conf = array();

//Main Database (Master)
$conf['db']['host'] = 'localhost';
$conf['db']['name'] = 'teamcrop';
$conf['db']['user'] = 'root';
$conf['db']['pass'] = 'root';