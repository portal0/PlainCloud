<?php
session_start();
if (!session_is_registered('username')) {
	header("location: notloggedin.php");
}
?>

<html>
<head>
<title>Plaintech UK - User: <?php echo $_SESSION['username']; ?></title>
<link rel="stylesheet" href="css/main.css">
</head>

<body>
<div id="wrapper">
<div id="logout">
<a href="logout.php"> Loguit! </a>
</div>

<div id="welcome">
<?php
echo "<center>Welcome, " .$_SESSION['username']. "</center>";
echo "<br />";
?>
</div>

<br />

<div id="your">
<b>Your VMs:</b><br /><br />
<?php
$host = "localhost";
$sqluser = "root";
$sqlpass = "test1234";
$sqlconnect = mysql_connect($host, $sqluser, $sqlpass);
mysql_select_db("Plaintech", $sqlconnect);

$username = $_SESSION['username'];

$showuservm = "SELECT * FROM vm WHERE username = '$_SESSION[username]'";
$showuservm2 = mysql_query($showuservm);
$nr = mysql_num_rows($showuservm2);
if($nr == 0) {
echo "You have not created any VMs";
} else {

for($i = 0; $i < $nr; $i++) {
$results = mysql_result($showuservm2, $i, "vmname");
$results2 = mysql_result($showuservm2, $i, "os");
$results3 = mysql_result($showuservm2, $i, "ram");
$results4 = mysql_result($showuservm2, $i, "disk");
$results5 = mysql_result($showuservm2, $i, "vnc");
echo "Vm informatie:\n<br /><pre>";
echo "VM Name:  ".$results."<br />";
echo "OS:       ".$results2."<br />";
echo "RAM:      ".$results3." MB<br />";
echo "Disk:     ".$results4." GB<br />";
echo "Display:  ".$results5."<br />";
echo "</pre>";
echo "<a href=''>Access</a>";
echo "<form action='startvm.php' method='post'> <input type=hidden name=vm value=$results> <input type=hidden name=user value=$username> <input type='submit' name='start' value='Start'/></form>";
echo "<form action='stopvm.php' method='post'> <input type=hidden name=vm value=$results> <input type=hidden name=user value=$username> <input type='submit' name='stop' value='Stop'/></form>";
}

}

?>
</div>

<div id="createvm"> <!--createvm div begin-->
<table border="1" spacing=>
<tr>
<th>Create new VM:</th>
</tr>
<tr>
<td>
<form action="createvm.php" method="post">
<b>OS Type:</b><br />
<input type="radio" name="os" value="Windows"> Windows <br />
<input type="radio" name="os" value="Linux"> Linux <br /><br />

<b>VM Name:</b><br />
<input type="text" name="vmname" size="20"><br /><br />

<b>RAM:</b><br />
<input type="radio" name="ram" value="256">256 MB<br />
<input type="radio" name="ram" value="512">512 MB<br />
<input type="radio" name="ram" value="1024">1024 MB<br /><br />

<b>Disk size:</b><br />
<input type="text" name="disk" size="5"> GB <br /><br />

<input type="submit" name="create" value="Create">
</form>

</td>
</tr>
</table>
</div> <!--createvm div end-->
</div>


</body>

</html>
