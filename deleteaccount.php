<?php 
ob_start();
session_start();
if(isset($_SESSION["id"])){
include_once "Customer.php";
	$cust=new Customer();
		$msg=$cust->Delete();
		if($msg=="ok")
		{
			$dir="customer/";
			$img=$_SESSION['id'];
			$fdir= $dir.$img.".jpg";
			unlink($fdir);
			echo("<script> window.open('logout.php', '_self')</script>");		 
		}
		else{
			echo("<div class='alert alert-danger'> ".$msg."</div>");	
		}
	}	
?>