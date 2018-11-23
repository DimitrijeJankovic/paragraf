<?php

return[
    [
        'Pattern'    => '|^form/?$|',
        'Controller' => 'Main',
        'Method' => 'addPolice'
    ],
    [
        'Pattern'    => '|^form/printPolice/([0-9]+)/?$|',
        'Controller' => 'Main',
        'Method' => 'printPolice'
    ],
    [
        'Pattern'    => '|^form/police/users/([0-9]+)/?$|',
        'Controller' => 'Main',
        'Method' => 'addUsersToPolice'
    ],
    
    #osnovna ruta
    [
        'Pattern' => '|^.*$|',
        'Controller' => 'Main',
        'Method' => 'index'
    ]
];
