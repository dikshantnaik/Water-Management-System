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

function getVendorCount() {
    include "connection.php";
    $sql = "SELECT * FROM vendor";
    $vendors = $con->query($sql);
    $rows= mysqli_num_rows($vendors);
    return $rows;
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
		header('Location:vendors.php');
	}
  if(isset($_GET['delete_customer'])){
		$sql = "DELETE FROM customer WHERE customer_id= " .$_GET['id'];
		$con->query($sql);
		$con->close;
		$_SESSION['success'] = "Deleted Sucess";
		header('Location:customer.php');
	}
?>