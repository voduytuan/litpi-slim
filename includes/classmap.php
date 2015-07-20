<?php

function classmap($classname)
{
    //Lowercase all part in classname to prevent some weird case name
    $classname = strtolower($classname);

    $classmapList = classmapList();

    $shortclassname = str_replace(array('\\controller\\', 'controller\\'), '', $classname);
    if (isset($classmapList[$shortclassname])) {
        return 'Controller' . DIRECTORY_SEPARATOR . $classmapList[$shortclassname];
    } else {
        return '';
    }
}

function classmapList()
{
    $s = DIRECTORY_SEPARATOR;

    //Create by Generator
    $classmapList = array(
        'v1\system' => 'V1' . $s . 'System.php',

    );

    return $classmapList;
}


function autoloadlitpi($classname)
{
    $filepathFromMapping = classmap($classname);

    $sitepath = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

    if ($filepathFromMapping == '') {
        //Process Namespace Directoryseparator
        $namepart = explode('\\', $classname);

        //If we not found some default root namespace
        //Make VENDOR is default namespace
        if (!in_array(strtolower($namepart[0]), array('model', 'controller', 'vendor'))) {
            array_unshift($namepart, 'Vendor');
        }

        $filepath = $sitepath;
        for ($i = 0; $i < count($namepart); $i++) {
            $filepath .= trim($namepart[$i]);

            if ($i == count($namepart) - 1) {
                $filepath .= '.php';
            } else {
                $filepath .= DIRECTORY_SEPARATOR;
            }
        }
    } else {
        $filepath = $sitepath . $filepathFromMapping;
    }

    if (is_readable($filepath)) {
        include_once($filepath);

        return true;
    } else {
        return false;
    }
}

function rewriteruleParsing($route)
{
    $registry = \Litpi\Registry::getInstance();
    $conf = $registry->get('conf');

    ////////////////////////////
    // Parsing Route to get MODULE, CONTROLLER & ACTION
    $parts = explode('/', $route);
    $module = '';
    $controller = '';
    $action = '';

    if ($parts[0]) {
        $module = $parts[0];
    }

    if (!empty($parts[1])) {
        $controller = $parts[1];
        if (!empty($parts[2])) {
            $action = $parts[2];
        } else {
            $action = 'index';
            $route = $module . '/' . $controller . '/' . 'index';
        }
    } else {
        $controller = 'index';
        $action = 'index';
        $route = $module . '/' . 'index' . '/' . 'index';
    }

    $registry->set('module', $module);
    $registry->set('controller', $controller);
    $registry->set('action', $action);
    $registry->set('route', $route);

    return $route;
}
