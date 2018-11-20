<?php

return[
    [
        'Pattern'    => '|^form/?$|',
        'Controller' => 'AddPolice',
        'Method' => 'index'
    ],
    
    #osnovna ruta
    [
        'Pattern' => '|^.*$|',
        'Controller' => 'Main',
        'Method' => 'index'
    ]
];
