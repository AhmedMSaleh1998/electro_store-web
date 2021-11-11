<?php
 ob_start();
 session_start();
if(isset($_SESSION["id"]))
{
	include_once "headerafter.php";
}else{
	echo("<script> window.open('login.php', '_self')</script>");		 
}
?>

<div class="container">
<div class="row">
	<center>
	<h1 >Profile Page </h1>
    <table class="table table-border table-striped" style="margin:25px;width:800px;" >
    <?php
	include_once "customer.php";
	$cust=new customer();
	$rs=$cust->GetByID();
	if($row=mysqli_fetch_assoc($rs))
	{
    ?>
		<tr><td colspan="2"  style="text-align:center">
		<img src="customer/<?php echo($_SESSION["id"]) ?>.jpg" width="200px" height="200px"/> </td></tr>
		<tr><td>Full Name </td><td> <?php echo($row["name"]); ?> </td></tr>
		<tr><td>Phone </td><td> <?php echo($row["phone"]); ?>  </td></tr>
		<tr><td>Email </td><td> <?php echo($row["email"]); ?>  </td></tr>
		<tr><td>Country </td><td> <?php echo($row["country"]); ?>  </td></tr>
		<tr><td>state </td><td><?php echo($row["state"]); ?>   </td></tr>
		<tr><td>city </td><td> <?php echo($row["city"]); ?>  </td></tr>
		<tr><td colspan="2" style="text-align:center"> <a href="updateprofile.php" class="btn btn-warning">Update My Profile</a></td></tr>
		<tr><td colspan="2" style="text-align:center"> <a href="deleteconfirmation.php" class="btn btn-danger">Delete My Account</a></td></tr>
		<?php } ?>
	</table>
	</center>
</div>
</div>
<?php 
include_once "footer.php";

?>
