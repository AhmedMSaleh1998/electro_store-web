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
<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
</head>
<body>
<!-- page -->
<?php 
    include_once "product.php";
    $prod = new product();
    $rs = $prod->GetProductById();
    if($row=mysqli_fetch_assoc($rs)){
?>
<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Home</a>
						<i>|</i>
					</li>
					<li>Single Product 1</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- Single Page -->
	<form method="POST">
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>S</span>ingle
				<span>P</span>age</h3>
			<!-- //tittle heading -->
			<div class="row">
          <img src="prod/<?php echo($row["productid"]);?>.jpg" width="180px" height="450px" style="float:right; margin-right:150px"/>
		  <div class="clearfix"></div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?php echo($row["name"]);?> (Gold, 16 GB) (3 GB RAM)</h3>
					<p class="mb-3">
						<span class="item_price">$<?php echo($row["price"]-($row["price"]*$row["discount"]));?></span>
						<del class="mx-2 font-weight-light">$<?php echo($row["price"]); ?></del>
						<label>Free delivery</label>
					</p>
					<div class="single-infoagile">
						<ul>
							<li class="mb-3">
								Cash on Delivery Eligible.
							</li>
							<li class="mb-3">
								Shipping Speed to Delivery.
							</li>
							<li class="mb-3">
								EMIs from $655/month.
							</li>
							<li class="mb-3">
								Bank OfferExtra 5% off* with Axis Bank Buzz Credit CardT&C
							</li>
						</ul>
					</div>
					<div class="product-single-w3l">
						<p class="my-3">
							<i class="far fa-hand-point-right mr-2"></i>
							<label>1 Year</label>Manufacturer Warranty</p>
						<ul>
							<li class="mb-1">
								3 GB RAM | 16 GB ROM | Expandable Upto 256 GB
							</li>
							<li class="mb-1">
								5.5 inch Full HD Display
							</li>
							<li class="mb-1">
								13MP Rear Camera | 8MP Front Camera
							</li>
							<li class="mb-1">
								3300 mAh Battery
							</li>
							<li class="mb-1">
								Exynos 7870 Octa Core 1.6GHz Processor
							</li>
						</ul>
						<p class="my-sm-4 my-3">
							<i class="fas fa-retweet mr-3"></i>Net banking & Credit/ Debit/ ATM card
						</p>
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
								if($ms=="ok")
								echo("<br/><div class='alert alert-success'>Item In Cart</div>");
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
	</div>
	</form>>
	<?php } ?>
	<!-- //Single Page -->
    <!-- js-files -->
	<!-- jquery -->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- //jquery -->

	<!-- nav smooth scroll -->
	<script>
		$(document).ready(function () {
			$(".dropdown").hover(
				function () {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>
	<!-- //nav smooth scroll -->

	<!-- popup modal (for location)-->
	<script src="js/jquery.magnific-popup.js"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- //popup modal (for location)-->

	<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<script>
		paypals.minicarts.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js

		paypals.minicarts.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

			if (total < 3) {
				alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
				evt.preventDefault();
			}
		});
	</script>
	<!-- //cart-js -->

	<!-- password-script -->
	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->

	<!-- imagezoom -->
	<script src="js/imagezoom.js"></script>
	<!-- //imagezoom -->

	<!-- flexslider -->
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
	

	<script src="js/jquery.flexslider.js"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
			});
		});
	</script>
	<!-- //FlexSlider-->

	<!-- smoothscroll -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->

	<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->

</body>
<?php
        include_once "footer.php";
?> 