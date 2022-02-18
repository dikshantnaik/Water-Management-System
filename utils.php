<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE);

  if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include 'connection.php';
function alert_box($msg)
{
  echo "<script>alert(\"".$msg."\")</script>";

}
function redirect($url){
    // echo "<script>window.location.href='".$url."';</script>";
    echo '<script type="text/javascript">
           window.location = "'.$url.'"
      </script>';
    // exit;
}

function getVendorCount() {
    include "connection.php";
    $sql = "SELECT * FROM vendor";
    $vendors = $con->query($sql);
    $rows= mysqli_num_rows($vendors);
    return $rows;
}
function getCustomerCount() {
    include "connection.php";
    $sql2 = "SELECT * FROM customer";
    $customer2 = $con->query($sql2);
    $rows2= mysqli_num_rows($customer2);
    return $rows2;
}function getProductCount() {
    include "connection.php";
    $sql3 = "SELECT * FROM products";
    $product3 = $con->query($sql3);
    $rows3= mysqli_num_rows($product3);
    return $rows3;
}
function Register(string $username1,string $pasword,string $email){
	include 'connection.php';
	$pasword = password_hash($pasword,PASSWORD_DEFAULT);

	try{    
        $sql = "INSERT INTO admin VALUES (NULL,?,?,?,'admin')";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss",$username1,$email,$pasword); 
        $stmt->execute();
        // alert_box("Vendors Data Added");
        // header('Location:vendors.php');
        $_SESSION['success'] = "Registered Success";
		
        
    }
    catch(mysqli_sql_exception $err){
        
        alert_box(mysqli_error($con));
    } finally{
        $stmt->close;
        $con->close;
    }
}

function Login(string $username1,string $password1){
	include 'connection.php';
	$pasword = password_hash($password1,PASSWORD_DEFAULT);
    error_log($password1);
	try{    
        $sql = "SELECT * from admin where username= '". $username1 ."'";
        $result = mysqli_query($con,$sql);
        if(!$result){
            error_log(mysqli_error($con));
        }
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($password1,$row['password'])){
                    
                    return "logedin";
                    $_SESSION['success'] = "Edited Success";
                }
            }
            
        }else{
            return "wrongpass";
        }
        if(mysqli_error($con)){
            error_log(mysqli_error($con));
        }
        // alert_box("Vendors Data Added");
        // header('Location:vendors.php');
    
		
        
    }
    catch(mysqli_sql_exception $err){
        
        alert_box(mysqli_error($con));
    } 
}
?>

<?php
    
    if(isset($_GET['delete_vendor'])){
		$sql = "DELETE FROM vendor WHERE id= " .$_GET['id'];
		$con->query($sql);
		$con->close;
		$_SESSION['success'] = "Deleted Sucess";
        redirect('vendors.php');
	}
  if(isset($_GET['delete_customer'])){
		$sql = "DELETE FROM customer WHERE customer_id= " .$_GET['id'];
		$con->query($sql);
		$con->close;
		$_SESSION['success'] = "Deleted Sucess";
        redirect('customer.php');
	}
    if(isset($_GET['payment_status'])){
        $con->query('UPDATE orders SET payment_status="'.$_GET['payment_status'].'" WHERE order_id = '.$_GET['order_id']);
        $con->close;
        $_SESSION['success'] = "Payment Status Updated ";
        redirect('orders.php');
        
    }
if(isset($_GET['delete_order'])){
    
        $con->query("DELETE FROM `orders_product` WHERE order_id = ".$_GET['id']);
        $con->query("DELETE FROM orders WHERE order_id = ".$_GET['id']);
        $con->close;
        $_SESSION['success'] = "Deleted Success ";
        redirect('orders.php');
        
    }
    
    
?>