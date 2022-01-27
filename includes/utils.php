<?php
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
?>