<?php
session_start();
// add product to the cart
if (isset($_POST['product_id'])) {
	if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
	$_SESSION['cart'][$_POST['product_id']] = $_POST['product_id'];
	echo '<script>alert("Product added succesfully!!");</script>';
}

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

$sql = "SELECT * FROM product ";

$resultat = mysqli_query($conn, $sql);

$products = $resultat->fetch_all(MYSQLI_ASSOC);

if (!$products)
	die("Er" . mysqli_error($conn));


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/first.css">
	<script src="https://kit.fontawesome.com/985aa39e17.js" crossorigin="anonymous"></script>
	<title>gifts</title>
</head>

<body>
	<section class="abc">
		<header>
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
			</div>
		</header>
	</section>
	<div class="small-cont">
		<div class="row">
			<h2 class="tit">Gifts For You</h2>
			
		</div>
		<div class="row">

			<?php

			foreach ($products as $product) { ?>
				<div class="col4">
					<form action="" method="post">
						<img src="<?= $product['image_path'] ?>">
						<h4><?= $product['name'] ?> </h4>
						<div class="rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<input type="hidden" name="product_id" value="<?= $product['id'] ?>">
						<p><?= $product['price'] ?> Da</p> <button type="submit" class="btn1"> add to cart</button>
					</form>
				</div>
			<?php
			}
			?>
		</div>
	</div>



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
			<p class="copy">Copyright All rights reserved &copy;2022 </p>
			<center>
				<p>Made With <i class="fa-solid fa-heart"></i> By KoyaDOLL</p>
			</center>
		</div>
	</footer>
</body>

</html>