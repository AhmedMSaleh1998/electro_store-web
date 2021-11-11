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
<html lang="zxx">

<head>
	<title>Electro Store Ecommerce Category Bootstrap Responsive Web Template | Checkout :: w3layouts</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8" />
	<meta name="keywords" content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/>
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta tag Keywords -->

	<!-- Custom-Files -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="css/fontawesome-all.css">
	<!-- Font-Awesome-Icons-CSS -->
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
	<!-- pop-up-box -->
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<!-- menu style -->
	<!-- //Custom-Files -->

	<!-- web fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	    rel="stylesheet">
	<!-- //web fonts -->

</head>

	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Home</a>
						<i>|</i>
					</li>
					<li>Cart</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>C</span>art
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Product Id.</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Product Name</th>
								<th>Total</th>
								<th>Remove</th>
							</tr>
						</thead>
						<form method="post">
						<?php 
						include_once "ShoppingCart.php";
						$cart = new Cart();
						$rs   = $cart->GetAll();
						while($row=mysqli_fetch_assoc($rs)){
						?>
						<tbody>
							<tr class="rem1">
								<td class="invert"><?php echo($row["prono"]); ?></td>
								<td class="invert-image">
									<a href="single.php">
									<img src="prod/<?php echo($row["prono"]);?>.jpg" alt=" " class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
										<input type="submit" name="btnminus<?php echo($row["prono"]); ?>" class="btn btn-secondary" value="-"/>
											<div class="entry value">
												<span><?php echo($row["quantity"]);?></span>
											</div>
											<input type="submit" name="btnplus<?php echo($row["prono"]); ?>" class="btn btn-secondary" value="+"/>
											<?php
                                        if(isset($_POST["btnminus".$row["prono"]]))
                                        {
                                            include_once "ShoppingCart.php";
                                            $cart = new Cart();
                                            $rs=$cart->UpdateQTYM($row["prono"]);
                                            echo("<script> window.open('checkout.php', '_self')</script>");	
                                        }
                                        if(isset($_POST["btnplus".$row["prono"]]))
                                        {
                                            include_once "ShoppingCart.php";
                                            $cart = new Cart();
                                            $rss=$cart->UpdateQTYP($row["prono"]);
                                            echo("<script> window.open('checkout.php', '_self')</script>");	
                                        }
                                    ?>
										</div>
									</div>
								</td>
								<td class="invert"><?php echo($row["proname"]);?></td>
								<td class="invert">$<?php echo($row["Total"]);?></td>
								<td class="invert">
									<div class="rem">
									<input type="submit" name="btndelete<?php echo($row["prono"]); ?>" class="glyphicon btn" value="&#xe083"/>
									<?php
                                        if(isset($_POST["btndelete".$row["prono"]]))
                                        {
                                            include_once "ShoppingCart.php";
                                            $cart = new Cart();
                                            $rs=$cart->DeleteCart($row["prono"]);
                                            echo("<script> window.open('checkout.php', '_self')</script>");	
                                        }
									?>
									</div>
								</td>
							</tr>
						</tbody>
						<?php } ?>
						<tfooter>
							<tr>
								<td colspan="4" style="background-color:#000;color:#fff">Total</td>
								<td  class="agile_inner_breadcrumb">
									<?php
									include_once "ShoppingCart.php";
									$cart = new Cart();
									$rs=$cart->GetSum();
									if($ro=mysqli_fetch_assoc($rs))
										echo($ro["total"]." $");
								?>
								<td>
						    </tr>
					</tfooter>
					</table>
				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<input type="submit" name="orderConfirm" value="Order Confirm" class="btn btn-danger">
								<?php
								if(isset($_POST["orderConfirm"]))
								{
								 include_once "Database.php";
								 $db=new Database();
								 $msg=$db->RunDML("insert into orders values(Default,Default,'Pending','".$_SESSION['id']."','0')");
								 if($msg=="ok")
								 {
									 $mx=$db->GetData("select max(orderno) as  maax from orders where customerid='".$_SESSION['id']."'");
									 if($rowmax=mysqli_fetch_assoc($mx))
									 {
										 $max=$rowmax["maax"];
									 include_once "Shoppingcart.php";
									 $cart = new Cart();
									 $rss=$cart->GetAll();
									 while($ro=mysqli_fetch_assoc($rss))
									 {
										  $ms= $db->RunDML("insert into sales values('".$ro["prono"]."','".$max."','".$ro["quantity"]."','".$ro["price"]."','".$ro["Total"]."')");
									}
										$db->RunDML("Delete from ordertemp where userid='".$_SESSION["id"]."'");
										echo("<script> window.open('cartMSG.php?orderno=$max', '_self')</script>");	
								 }
								 }
								}
									 ?>
							</div>
						</div>
					<div class="checkout-right-basket">
						<a href="payment.html">Make a Payment
							<span class="far fa-hand-point-right"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	<!-- //checkout page -->
	<!-- footer -->
		<?php 
			include_once "footer.php";
		?>
	<!-- footer -->
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

	<!-- quantity -->
	<script>
		$('.value-plus').on('click', function () {
			var divUpd = $(this).parent().find('.value'),
				newVal = parseInt(divUpd.text(), 10) + 1;
			divUpd.text(newVal);
		});

		$('.value-minus').on('click', function () {
			var divUpd = $(this).parent().find('.value'),
				newVal = parseInt(divUpd.text(), 10) - 1;
			if (newVal >= 1) divUpd.text(newVal);
		});
	</script>
	<!--quantity-->
	<script>
		$(document).ready(function (c) {
			$('.close1').on('click', function (c) {
				$('.rem1').fadeOut('slow', function (c) {
					$('.rem1').remove();
				});
			});
		});
	</script>
	<script>
		$(document).ready(function (c) {
			$('.close2').on('click', function (c) {
				$('.rem2').fadeOut('slow', function (c) {
					$('.rem2').remove();
				});
			});
		});
	</script>
	<script>
		$(document).ready(function (c) {
			$('.close3').on('click', function (c) {
				$('.rem3').fadeOut('slow', function (c) {
					$('.rem3').remove();
				});
			});
		});
	</script>
	<!-- //quantity -->

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

</html>