<?php
include 'includes/mysql.php';
include 'includes/functions.php';

if ($_POST["username"] && $_POST["password"] && $_POST["password2"]) {
	if ($_POST["password"] == $_POST["password2"]) {

	$username = $_POST["username"];
	$passnomd5 = $_POST["password"];
	$password = md5($passnomd5);

	mysqlLogin(); //login in de database
        $result =  query("SELECT username FROM users WHERE username = '$username'"); //voer query uit
        $nr = mysql_num_rows($result); //tel de results

	if($nr >= 1) {
		echo "<center><h1>User already exists..</h1></center>";
	} else {
		$result = query("INSERT INTO users (username, password) values ('$username','$password')");
		echo "You are now registered.";
		//fwrite for directory where user VMs will be stored:
	        mkdir('/vms/'.$username);
	}

	} else echo "<center><h1>passwords dont match..</h1></center>";

} else echo "<center><h1>type something</h1></center>";

?>
