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
<!-- checkout page -->
<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>My </span>Orders
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Order No</th>
								<th>Order Date</th>
								<th>Order Status</th>
								<th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<?php 
						include_once "ShoppingCart.php";
						$cart = new Cart();
						$rs   = $cart->GetView();
						while($row=mysqli_fetch_assoc($rs)){
						?>
						<tbody>
							<tr class="rem1">
								<td class="invert"><?php echo($row["orderno"]); ?></td>
                                <td class="invert"><?php echo($row["date"]); ?></td>
                                <td class="invert"><?php echo($row["status"]); ?></td>
                                <td class="invert"><?php echo($row["name"]); ?></td>
								<td class="invert-image">
									<img src="prod/<?php echo($row["productid"]);?>.jpg" alt=" " width="50px" height="50px" class="img-responsive">
									</a>
								</td>
								<td class="invert"><?php echo($row["price"]); ?></td>
                                <td class="invert"><?php echo($row["quantity"]); ?></td>
                                <td class="invert"><?php echo($row["total"]); ?></td>
							</tr>
						</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
    <?php 
    include_once "footer.php";
    ?>