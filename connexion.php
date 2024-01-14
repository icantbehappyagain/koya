<?php

$link=mysqli_connect('localhost','root','','') or die('error');
$req='CREATE DATABASE IF NOT EXISTS expertone';
if (mysqli_query($link,$req)) {
     echo('database is create').('<br>');
} else echo mysqli_error($link);

$link=mysqli_connect('localhost','root','','expertone') or die('error');
$tab='CREATE TABLE IF NOT EXISTS order ( 
	id int PRIMARY KEY AUTO_INCREMENT,
	id_user int not null ,
	datep date NOT NULL
)';
if (mysqli_query($link,$tab)) {
     echo('table order is create');
} else echo mysqli_error($link);

$tab='CREATE TABLE IF NOT EXISTS order_has_product ( 
	id_product int not null,
	id_order int not null ,
	quantity int NOT NULL
)';
if (mysqli_query($link,$tab)) {
     echo('table order_has_product is create');
} else echo mysqli_error($link);

$tab="CREATE TABLE IF NOT EXISTS `user` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`fullname` varchar(50) NOT NULL,
	`email` varchar(100) NOT NULL,
	`password` varchar(50) NOT NULL,
	`is_admin` int(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE KEY `email` (`email`)
  )";
if (mysqli_query($link,$tab)) {
     echo('table user is create');
	 // Add the first user 
	$user ="INSERT IGNORE INTO `user` 
		(`fullname`, `email`, `password`, `is_admin`) VALUES
		('admin', 'admin@gmail.com', 'admin', 1);";
	if (mysqli_query($link,$user)) {
		echo('first user create');
	} else echo mysqli_error($link);
} else echo mysqli_error($link);
// create table product

$tab="CREATE TABLE IF NOT EXISTS `product` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`price` int(11) NOT NULL,
	`description` text NOT NULL,
	`rating` decimal(1,0) NOT NULL DEFAULT '5',
	`image_path` varchar(200) NOT NULL,
	PRIMARY KEY (`id`)
  )";

if (mysqli_query($link,$tab)) {
	echo('table product is create');
} else echo mysqli_error($link);
?>