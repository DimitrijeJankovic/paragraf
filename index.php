<?php
    require_once 'sys/Autoloader.php';
    require __DIR__ . '/vendor/autoload.php';
    
    Session::begin();
    
    $Request = $_SERVER['REQUEST_URI'];
    $Request = substr($Request, strlen(Configuration::PATH));
    
    $Routes = require_once 'Reoutes.php';
    
    $FoundRoute = null;
    $Arguments = [];
    foreach ($Routes as $Route){
        if(preg_match($Route['Pattern'], $Request, $Arguments)){
            $FoundRoute = $Route;
            break;
        }
    }
    
    unset($Arguments[0]);
    $Arguments = array_values($Arguments);
    
    $controlerPath = 'app/controllers/'.$FoundRoute['Controller'].'Controller.php';
    if(!file_exists($controlerPath)){
        die('Controller class does not exit.');
    }

    require_once $controlerPath;
    
    $imeKlse = $FoundRoute['Controller'].'Controller';
    $worker = new $imeKlse;
    
    if(method_exists($worker, '__pre')){
        call_user_func([$worker , '__pre']);
    }
    
    if(method_exists($worker, $FoundRoute['Method'])){
        $methodName = $FoundRoute['Method'];
		call_user_func_array([$worker, $methodName], $Arguments);
    }else{
        die('This controlle does not have the requsted method.');
    }

    $DATA = $worker->getData();
    
    if($worker instanceof ApiController){
        ob_clean();
        header('Content-type: text/json; charset=utf-8');
        echo json_encode($DATA);
        exit;
    }
    
    require 'app/views/'.$FoundRoute['Controller'].'/'.$FoundRoute['Method'].'.php';