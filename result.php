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
<!-- //first section -->
	<!-- top Products -->
	<form method="POST">
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>O</span>ur
				<span>N</span>ew
				<span>P</span>roducts</h3>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">New Brand<span style="color:red"> Mobiles</span></h3>
							<br><br>
							<div class="row">
								<?php 
									include_once "product.php";
									$prod = new product();
                                    if(isset([$_post['se']]))
									$rs = $prod->Filter1($_GET["se"]);
                                    elseif(isset([$post['see']]))
                                    include_once "Database.php";
                                    $dbb = new Database();
                                    $rrs = $dbb->GetData("select * from product where price='".$_Get["price"]."' and rate='".$_Get["rate"]."' and departmentid='".$_Get["departmentid"]."'");
									while($row=mysqli_fetch_assoc($rs)){
								?>
								
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="prod/<?php echo($row["productid"]);?>.jpg" alt="" width="100px" height="220px;" >
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="single.php?prono=<?php echo ($row["productid"]) ?>" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="single.php"><?php echo($row["name"]);?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price">$<?php echo($row["price"]-($row["price"]*$row["discount"]));?></span>
												<del>$<?php echo($row["price"]);?></del>
											</div>
											<?php 
												if(isset($_SESSION["id"])){ ?>
													<input type="submit" value="Add to cart" onclick="document.getElementById('id01').style.display='block'" name="btncart<?php echo($row['productid']); ?>" class="btn btn-success">
											<?php 	}else{ ?>
													<input type="submit" value="Add to cart" name="btnlogin" class="btn btn-danger">
											<?php 	} ?>
											<?php 
												if(isset($_POST["btncart".$row['productid']])){
													include_once "ShoppingCart.php";
													$cart = new Cart();
													$cart->setprono($row['productid']);
													$cart->setproname($row['name']);
													$cart->setqty(1);
													$cart->setprice($row['price']-($row['price']*$row['discount']));
													$cart->setTotal($row['price']-($row['price']*$row['discount']));
													$cart->setUserID($_SESSION['id']);
													$ms=$cart->Add();
													if($ms=="ok"){
													echo("<br/><div class='alert alert-success'>Item In Cart</div>");
													}
													elseif(strpos($ms,"proname"))
												{	
													$cart->UpdateQTYP($row['productid']); 
													echo("<br/><div class='alert alert-success'>Item In Cart</div>");
												
												}
													else
													echo($ms);
												}
												if(isset($_POST["btnlogin"])){
													echo("<script>window.open('login.php','_self')</script>");
												}
												?>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</form>	
						<!-- //first section -->