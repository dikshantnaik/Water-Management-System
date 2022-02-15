<?php 
    $product_id=  $_GET['product_id'];
    $product_quantity = $_GET['product_quantity'];

    
    echo print_r($product_id);
    echo print_r($product_quantity);
    // echo var_dump($product_id);
    $flag = 0;
    for ($i=0; $i <= count($product_quantity); $i++) { 
        
            if($product_quantity[$i]!=null){
                echo "<br> conditions";
                    
                echo $product_id[$flag] ." = ".$product_quantity[$i];
                $flag++;
        }
    }
    
?>