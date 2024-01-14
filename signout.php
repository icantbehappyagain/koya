<?php 
session_start();
// add product to the cart
if (isset($_SESSION['user']))
{ 
    unset($_SESSION['user']);
	header('location: login.php');
}
