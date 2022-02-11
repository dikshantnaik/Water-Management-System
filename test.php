<?php 
    $cars = array("Volvo", "BMW", "Toyota");
    echo count($cars);
    echo isset($cars[5]);

    for ($i=0; $i < count($cars)+4; $i++) { 
        echo isset($cars[$i]);
    }
    
?>