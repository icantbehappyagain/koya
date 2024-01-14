<?php
session_start();
$cart_products = "";
$cart_total = 0;
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
	$cart_products = implode(",", $_SESSION['cart']);

	$products = [];
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";

	// Create connection
	$conn = mysqli_connect($db_servername, $db_username, $db_password, "ecommerce");

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM product where id in ($cart_products)";

	$resultat = mysqli_query($conn, $sql);

	$products = $resultat->fetch_all(MYSQLI_ASSOC);


	// add new order to database 
	if (isset($_POST['cart']) && isset($_SESSION['user'])) {
		$user_id = $_SESSION['user'][0]['id'];
		$order = "INSERT INTO orders (id_user,datep) value ($user_id,NOW())";
		if (mysqli_query($conn, $order)) {
			$cart_array = explode(",",$cart_products);
			foreach ($cart_array as $key => $value) {
				# code...
			}
			$_SESSION['cart'] = [];
		} else {
			die("error: " . mysqli_error($conn));
		}
	}
	// remove an item from the cart
	if(isset($_GET['remove'])){
		unset($_SESSION['cart'][$_GET['remove']]);
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/first.css">
	<script src="https://kit.fontawesome.com/985aa39e17.js" crossorigin="anonymous"></script>
	<title>first</title>
</head>

<body>

	<header class="abcdef">
		<div class="cont">
			<div class="navbar">
				<div class="logo">
					<h1>KOYA<span style="color:#F182DD;">Doll</span>.store</h1>
				</div>
				<nav>
					<ul class="menu">
						<li><a href="first.html"> Home</a></li>
						<li><a href="gifts.php"> Gifts</a> </li>
						<li><a href="about.html"> About</a></li>
						<?php 
							if (!isset($_SESSION['user'])) {?>
							   	<li><a href="login.php"> Login</a></li>
							
							<?php } else { ?>
								<li> <a href="signout.php">Sign out</a></li>
                         <?php 
							}

							?>
						<li><a href="cart.php" class="bot"><i class="fa-solid fa-cart-plus"></i>SHOP NOW</a></li>
					</ul>
				</nav>
			</div>

		</div>
		<!-----------cart----------->


		<div class="smallcont cartp">

			<?php if (isset($products) && count($products) > 0) { ?>
				<form action="" method="post">
					<table>
						<tr>
							<th>Product</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
						<?php
						foreach ($products as $product) { ?>
							<tr>
								<td>
									<div class="cartinfo">
										<img src="<?= $product['image_path'] ?>">
										<div>
											<p><?= $product['name'] ?> </p>

											<small> <?= $product['price'] ?> DA</small><br>
											<a href="?remove=<?= $product['id'] ?>" class="btn">Remove</a>
										</div>
									</div>
								</td>
								<td><input type="number" name=""></td>
								<td><?= $product['price'] ?> DA</td>
							</tr>
						<?php
						$cart_total = $cart_total + $product['price'];
						}
						?>
					</table>
					<div class="total">
						<table>
							<tr>
								<td>Total</td>
								<td><?= $cart_total ?></td>
							</tr>
						</table>
					</div>
					<input type="hidden" name="cart" value="<?= $cart_products ?> ">
					<?php if (isset($_SESSION['user'])) { ?>
						<button type="submit" class="btn" style="float: right;"> checkout </button>
					<?php } else { ?>
						<a href="login.php" class="btn"style="float: right;"> login </a>
					<?php } ?>
				</form>
			<?php
			} else {
				echo "
				<center>
				<h1>Your cart is empty </h1></center>
				";
			}
			?>
		</div>
	</header>
	<!-- FOOTER-->
	<footer>
		<div class="container">
			<div class="row">
				<div class="foot1">
					<h2>KOYA<span style="color:#F182DD;">Doll</span>.store</h2>
				</div>

				<div class="foot2">
					<h3>Useful Links</h3><br>
					<ul>
						<li><a href="">About Us</a></li><br>
						<li><a href="">How to order</a></li><br>
						<li><a href="">My cart</a></li><br>
						<li><a href="">Contect Us</a></li>
					</ul>
				</div>

				<div class="foot3">
					<h3>Follow KoyaDOLL</h3>
					<a href=""><i class="fa fa-facebook"></i></a>
					<a href=""><i class="fa fa-instagram"></i></a>
					<a href=""><i class="fa fa-twitter"></i></a>
					<a href=""><i class="fa-brands fa-whatsapp"></i></a>
				</div>
			</div>
			<hr>
			<p class="copy">Copyright All rights reserved &copy;2022 </p><br>
			<center>
				<p>Made With <i class="fa-solid fa-heart"></i> By KoyaDOLL</p>
			</center>
		</div>


	</footer>


</body>

</html>