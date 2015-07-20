<?php

namespace Litpi;

require 'includes/classmap.php';
require 'includes/conf.php';
require 'Vendor/autoload.php';

spl_autoload_register('autoloadlitpi');

//INIT REGISTRY VARIABLE - MAIN STORAGE OF APPLICATION
$registry = Registry::getInstance();
$registry->set('conf', $conf);

$db = new MyPdoProxy();
$db->addMaster($conf['db']['host'], $conf['db']['user'], $conf['db']['pass'], $conf['db']['name']);
$db->addSlave($conf['db']['host'], $conf['db']['user'], $conf['db']['pass'], $conf['db']['name']);
$registry->set('db', $db);


/////////////////////////
///// Important, process to include controller file
///This is the main different with LITPI framework core
//Parsing route information to include module/controller
$route = isset($_GET['route']) ? trim($_GET['route'], '/\\') : '';
$parts = explode('/', $route);
for ($i = 0; $i < count($parts); $i++) {
    $parts[$i] = htmlspecialchars($parts[$i]);
}
$module = array_shift($parts);
$controller = array_shift($parts);
$registry->set('module', $module);
$registry->set('controller', $controller);
$class = '\\controller\\' . $module . '\\' . $controller;

//Init slim object
$app = new \Slim\Slim();

//check if valid controller
if (classmap($class) != '') {
    $myControllerObj = new $class($registry, $app);
    $myControllerObj->run();
} else {
    $app->notFound(function () use ($app) {
        echo file_get_contents('404.html');
    });
}
$app->run();
