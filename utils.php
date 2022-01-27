<?php
session_start();
function alert_box($msg)
{
  echo "<script>alert(\"".$msg."\")</script>";

}
function Success($msg)
{
    echo '<div class="alert alert-success alert-dismissable">
   		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    		<strong>Success! </strong>'. $msg.'
  	  </div>';
}
function getVendorCount() : int{
	$sql = "SELECT COUNT(*) as Count FROM vendor";
	$vendors = $con->query($sql);
	error_log(var_dump($vendors));
	return $vendors;
}
?>
<?php
    include 'connection.php';
    if(isset($_GET['delete_vendor'])){
		$sql = "DELETE FROM vendor WHERE id= " .$_GET['id'];
		$con->query($sql);
		$con->close;
		$_SESSION['success'] = "Deleted Sucess";
		header('Location:vendors.php');
	}
?>