<?php
include 'includes/mysql.php';
include 'includes/functions.php';

if ($_POST["username"] && $_POST["password"]) {

	$username = $_POST["username"];
	$passNoMd5 = $_POST["password"];
	$password = md5($passNoMd5);
//test
	mysqlLogin(); //login in de database
	$result =  query("SELECT * FROM users WHERE username = '$username' AND password = '$password'"); //voer query uit
	$nr = mysql_num_rows($result); //tel de results

	if ($nr == 1) {
		session_register("username");
		session_register("password");
		header("location: home.php");
	} else echo "<center><h1>Username/password wrong</h1></center>";
} else echo "<center>computer says no</center>";
