<?php
session_start();
$success = "";
$login = "";
// todo: get the user login from the session

if (
	!empty($_POST['email'])
	&& !empty($_POST['password'])
	&& !empty($_POST['firstname'])
	&& !empty($_POST['type'])
	&& $_POST['type'] == 'register'
) {
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";

	// Create connection
	$conn = mysqli_connect($db_servername, $db_username, $db_password, "ecommerce");

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$email = $_POST['email'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];

	// Insert data into table
	$sql = "INSERT INTO user (email,fullname,password) 
		VALUES ('$email','$firstname','$password')";
	if (mysqli_query($conn, $sql)) {
		$success = "New record created successfully";

	} else {
		$success = "There was an error : ". mysqli_error($conn);
	}	header('location:gifts.php');
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/first.css">
	<script src="https://kit.fontawesome.com/985aa39e17.js" crossorigin="anonymous"></script>
	<title>contect</title>
</head>

<body>
	<div class="abcde">
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
		</header>
		<section class="contact">
			<div class="row">
				<div class="col-auto"></div>
				<div class="col-auto"></div>
				<div class="col-6">
					<form method="POST" action="" class="from-login">
						<div class="title">Register</div>
						<div class="subtitle">Let's create your account!</div>
						<div class="input-container ic1">
							<input require id="firstname" class="input" name="firstname" type="text" placeholder=" " />
							<div class="cut"></div>
							<label for="firstname" class="placeholder">First name</label>
						</div>
						<div class="input-container ic2">
							<input id="email" name="email" class="input" type="email" placeholder=" " require />
							<div class="cut cut-short"></div>
							<label for="email" class="placeholder">Email</label>
						</div>
						<div class="input-container ic2">
							<input require id="password" name="password" class="input" type="password" placeholder=" " />
							<div class="cut"></div>
							<label for="password" class="placeholder">password</label>
						</div>

						<input type="hidden" name="type" value="register">

						<button type="text" class="submit">register</button>
						<?= $success ?>
						<a href="login.php">or Already a member</a>
					</form>
				</div>
				<div class="col-auto"></div>

			</div>
		</section>

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