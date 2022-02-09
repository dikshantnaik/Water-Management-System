<?php 
include('connection.php');
$sql2 = "SELECT * from products where product_id=1";
         $result2 = $con->query($sql2);
    // while($row = $result2->fetch_assoc()){
    //     echo $row['product_stock'];
    // }
        $row = $result2->fetch_assoc();
        
     
     
        echo $row['product_stock'];
    
?>