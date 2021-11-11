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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none;}
</style>
</head>
<body>
	<h1 class="text-danger text-center" style="height:70px">Special Offers</h1>
	<div class="w3-content w3-display-container">
	<?php
	include_once "ads.php";
	$ads=new ads();
	$rs = $ads->Getall();
	while($row=mysqli_fetch_assoc($rs)){
	?>
	<div class="w3-display-container mySlides">
	<a href="<?php echo($row["link"]);?>" target="_blank">
	<img src="ads/<?php echo($row["adid"]);?>.jpg" style="width:980px;height:450px;">
	</a>
	<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
	<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
	</div>
<?php } ?>
<hr>
    <div class="product-sec1 px-sm-5 px-3 py-sm-5  py-3 mb-4">
		<h3 class="heading-tittle text-center font-italic">The Most Popular <span class="text-danger">Departments</span></h3>
		<hr/>
		<div class="row">
		<?php 
		include_once "department.php";
		$dept = new department();
		$rs = $dept->GetPopular();
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
			<a style='font-size:24px' class="float-right text-danger" href="all departments.php">All Departments <i class='fas fa-external-link-alt text-warning'></i></a>
		</div>
		
	</div>
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
									$rs = $prod->GetPopularMobile();
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
						<!-- second section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<h3 class="heading-tittle text-center font-italic">New <span style="color:red"> Laptops</span></h3>
							<div class="row">
								<?php 
									include_once "product.php";
									$prod = new product();
									$rs = $prod->GetPopularLaptop();
									while($row=mysqli_fetch_assoc($rs)){
								?>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="prod/<?php echo($row["productid"]);?>.jpg" alt="" width="100px" height="150px;" >
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="single.php" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="single.php"><?php echo($row["name"]);?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price">$<?php echo($row["price"]);?></span>
												<del>$<?php echo($row["price"]-($row["price"]*$row["discount"]));?></del>
											</div>
											<?php 
												if(isset($_SESSION["id"])){ ?>
													<input type="submit" value="Add to cart" name="btncart<?php echo($row['productid']); ?>" class="btn btn-success">
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
														$cart->UpdateQTYP($row["productid"]); 
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
						<!-- //second section -->
						<!-- third section -->
						<div class="product-sec1 product-sec2 px-sm-5 px-3">
							<div class="row">
								<h3 class="col-md-4 effect-bg">Summer Carnival</h3>
								<p class="w3l-nut-middle">Get Extra 10% Off</p>
								<div class="col-md-8 bg-right-nut">
									<img src="images/image1.png" alt="">
								</div>
							</div>
						</div>
						<!-- //third section -->
						<!-- fourth section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mt-4">
							<h3 class="heading-tittle text-center font-italic">Large Appliances</h3>
							<div class="row">
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/m7.jpg" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="single.php" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<span class="product-new-top">New</span>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="single.php">Whirlpool 245</a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price">$230.00</span>
												<del>$280.00</del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												<form action="#" method="post">
													<fieldset>
														<input type="hidden" name="cmd" value="_cart" />
														<input type="hidden" name="add" value="1" />
														<input type="hidden" name="business" value=" " />
														<input type="hidden" name="item_name" value="Whirlpool 245" />
														<input type="hidden" name="amount" value="230.00" />
														<input type="hidden" name="discount_amount" value="1.00" />
														<input type="hidden" name="currency_code" value="USD" />
														<input type="hidden" name="return" value=" " />
														<input type="hidden" name="cancel_return" value=" " />
														<input type="submit" name="submit" value="Add to cart" class="button btn" />
													</fieldset>
												</form>
											</div>

										</div>
									</div>
								</div>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/m8.jpg" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="single.php" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="single.php">BPL Washing Machine</a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price">$180.00</span>
												<del>$200.00</del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												<form action="#" method="post">
													<fieldset>
														<input type="hidden" name="cmd" value="_cart" />
														<input type="hidden" name="add" value="1" />
														<input type="hidden" name="business" value=" " />
														<input type="hidden" name="item_name" value="BPL Washing Machine" />
														<input type="hidden" name="amount" value="180.00" />
														<input type="hidden" name="discount_amount" value="1.00" />
														<input type="hidden" name="currency_code" value="USD" />
														<input type="hidden" name="return" value=" " />
														<input type="hidden" name="cancel_return" value=" " />
														<input type="submit" name="submit" value="Add to cart" class="button btn" />
													</fieldset>
												</form>
											</div>

										</div>
									</div>
								</div>
								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/m9.jpg" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="single.php" class="link-product-add-cart">Quick View</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="single.php">Microwave Oven</a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price">$199.00</span>
												<del>$299.00</del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												<form action="#" method="post">
													<fieldset>
														<input type="hidden" name="cmd" value="_cart" />
														<input type="hidden" name="add" value="1" />
														<input type="hidden" name="business" value=" " />
														<input type="hidden" name="item_name" value="Microwave Oven" />
														<input type="hidden" name="amount" value="199.00" />
														<input type="hidden" name="discount_amount" value="1.00" />
														<input type="hidden" name="currency_code" value="USD" />
														<input type="hidden" name="return" value=" " />
														<input type="hidden" name="cancel_return" value=" " />
														<input type="submit" name="submit" value="Add to cart" class="button btn" />
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- //fourth section -->
					</div>
				</div>
				<!-- //product left -->

				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Search Here..</h3>
							<form action="#" method="post">
								<input type="search" placeholder="Product name..." name="search" required="">
								<input type="submit" value=" ">
							</form>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Price</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="#">Under $1,000</a>
									</li>
									<li class="my-1">
										<a href="#">$1,000 - $5,000</a>
									</li>
									<li>
										<a href="#">$5,000 - $10,000</a>
									</li>
									<li class="my-1">
										<a href="#">$10,000 - $20,000</a>
									</li>
									<li>
										<a href="#">$20,000 $30,000</a>
									</li>
									<li class="mt-1">
										<a href="#">Over $30,000</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- //price -->
						<!-- discounts -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Discount</h3>
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">5% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">10% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">20% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">30% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">50% or More</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">60% or More</span>
								</li>
							</ul>
						</div>
						<!-- //discounts -->
						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3">Customer Review</h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>4.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half"></i>
										<span>3.5</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>3.0</span>
									</a>
								</li>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half"></i>
										<span>2.5</span>
									</a>
								</li>
							</ul>
						</div>
						<!-- //reviews -->
						<!-- electronics -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Electronics</h3>
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Accessories</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Cameras & Photography</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Car & Vehicle Electronics</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Computers & Accessories</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">GPS & Accessories</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Headphones</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Home Audio</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Home Theater, TV & Video</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Mobiles & Accessories</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Portable Media Players</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Tablets</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Telephones & Accessories</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Wearable Technology</span>
								</li>
							</ul>
						</div>
						<!-- //electronics -->
						<!-- delivery -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Cash On Delivery</h3>
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Eligible for Cash On Delivery</span>
								</li>
							</ul>
						</div>
						<!-- //delivery -->
						<!-- arrivals -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">New Arrivals</h3>
							<ul>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Last 30 days</span>
								</li>
								<li>
									<input type="checkbox" class="checked">
									<span class="span">Last 90 days</span>
								</li>
							</ul>
						</div>
						<!-- //arrivals -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>
	<!-- //top products -->

	<!-- middle section -->
	<div class="join-w3l1 py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<div class="row">
				<div class="col-lg-6">
					<div class="join-agile text-left p-4">
						<div class="row">
							<div class="col-sm-7 offer-name">
								<h6>Smooth, Rich & Loud Audio</h6>
								<h4 class="mt-2 mb-3">Branded Headphones</h4>
								<p>Sale up to 25% off all in store</p>
							</div>
							<div class="col-sm-5 offerimg-w3l">
								<img src="images/off1.png" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mt-lg-0 mt-5">
					<div class="join-agile text-left p-4">
						<div class="row ">
							<div class="col-sm-7 offer-name">
								<h6>A Bigger Phone</h6>
								<h4 class="mt-2 mb-3">Smart Phones 5</h4>
								<p>Free shipping order over $100</p>
							</div>
							<div class="col-sm-5 offerimg-w3l">
								<img src="images/off2.png" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- middle section -->
	<script>
		var slideIndex = 1;
		showDivs(slideIndex);
		function plusDivs(n) {
		showDivs(slideIndex += n);
		}

		function showDivs(n) {
		var i;
		var x = document.getElementsByClassName("mySlides");
		if (n > x.length) {slideIndex = 1}
		if (n < 1) {slideIndex = x.length} ;
		for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		}
		x[slideIndex-1].style.display = "block";
		}
	</script>
	  </body>
	  </html>

	<?php
        include_once "footer.php";
    ?>  