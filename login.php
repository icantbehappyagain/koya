<?php
session_start();
$success = "";
$login="";
// todo: get the user login from the session

if (
	isset($_POST['email'])
	&& isset($_POST['password'])
	&& isset($_POST['type'])
	&& $_POST['type'] == 'login'
) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	//todo :check if the user exists in the database
	$link=mysqli_connect('localhost','root','','ecommerce');
	$check="SELECT * FROM user where email= '$email' and password='$password'";
	$resultat = mysqli_query($link,$check);
	
	$user = $resultat->fetch_all(MYSQLI_ASSOC);
	if(count($user)>0){
		$_SESSION['user'] = $user;
		if($user[0]['is_admin'] == 1)
		{
			header('location: admin/index.php');die;
		}
		header('location: cart.php');
	}else{
		$login = "user not found";
	}
	//todo: create a new login session for the user
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
<div class="col-6">
					<form method="POST" action="" class="from-login">
						<div class="title">Login</div>
						<div class="subtitle">Login with your account!</div>
						<div class="input-container ic2">
							<input id="email" class="input" name="email" type="email" placeholder=" " />
							<div class="cut cut-short"></div>
							<label for="email" class="placeholder">Email</label>
						</div>
						<div class="input-container ic2">
							<input id="password" class="input" name="password" type="password" placeholder=" " />
							<div class="cut"></div>
							<label for="password" class="placeholder">password</label>
						</div>
						<input type="hidden" name="type" value="login">

						<button type="text" class="submit">Login</button>
							<strong><?= $login;?></strong>		
							<br>	
							<br>
							<a href="register.php">or sign-up now </a>			
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