<?php   
	session_start();
	if(isset($_SESSION["id"])){
		include_once "headerafter.php";
	}else{
		include_once "headerbefore.php";
		//echo("<script> window.open('login.php', '_self')</script>");	
	}
	//include_once "headerBefore.php";
	?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none;}
</style>
</head>
<div class="product-sec1 px-sm-5 px-3 py-sm-5  py-3 mb-4">
		<h3 class="heading-tittle text-center font-italic">All <span class="text-danger">Departments</span></h3>
		<hr/>
		<div class="row">
		<?php 
		include_once "department.php";
		$dept = new department();
		$rs = $dept->GetAll();
		while($row=mysqli_fetch_assoc($rs)){
		?>
			<div class="col-md-2 product-men mt-5">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item text-center">
						<img src="department/<?php echo($row["departmentid"]); ?>.jpg" alt="" width="90px" height="90px">
					</div>
					<div class="item-info-product text-center border-top mt-4">
						<h4 class="pt-1">
							<a href="departmentproducts.php?deptno=<?php echo($row["departmentid"]);?>"><?php echo($row["name"]); ?></a>
							<hr>
						</h4>
					</div>
				</div>
			</div>
			<?php } ?>
			</div>
		</div>
		
	</div>
	<!-- //first section -->