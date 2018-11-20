<?php
    function autoLoad($imeKlase) {
        if (in_array ($imeKlase, ['Misc', 'Controler', 'DataBase', 'ModelInterface', 'Session', 'AdminController', 'Helpers', 'ApiController'])) {
            require_once 'sys/'.$imeKlase.'.php';
        } elseif (preg_match('/^([A-Z][a-z]+)+Controller$/', $imeKlase)) {
            require_once 'app/controllers/' . $imeKlase . '.php';
        } elseif (preg_match('/^([A-Z][a-z]+)+Model$/', $imeKlase)) {
            require_once 'app/models/' . $imeKlase . '.php';
        } else if($imeKlase === 'Configuration'){
            require_once $imeKlase.'.php';
        }
    }
    
    spl_autoload_register('autoLoad');

