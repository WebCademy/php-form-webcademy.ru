<?php

function printArray ($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";  
}

$carsSimple = ['Audi', 'Ford', 'Renault', 'VW'];

printArray($carsSimple);

$carsAssoc = [ 
        'Audi' => 'TT' , 
        'Ford' => 'Focus', 
        'Renault' => 'Koleos', 
        'VW' => 'Tuareg'
        ];

printArray($carsAssoc);


