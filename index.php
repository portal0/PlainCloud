<?php
session_start();
?>
<html>

<head>
</head>

<body>

<center><h2>Plaintech UK</h2></center>
<br />

<center>
<table border="1" width="600" >
<tr>
<th>New users register here:</th>
<th>Existing users login here:</th>
</tr>

<tr>
<td>
<br />
<form action="register.php" method="post" >
Username: <input type="text" size="15" name="username"/> <br />
Password: <input type="password" size="15" name="password"/> <br />
Repeat password: <input type="password" size="15" name="password2"/> <br /><br />
<input type="submit" name="submitregister" value="Register"/>
</form>
</td>

<td>
<form action="login.php" method="post" >
Username: <input type="text" size="15" name="username"> <br />
Password: <input type="password" size="15" name="password"> <br /><br /><br />
<input type="submit" name="submitlogin" value="Login"/>
</form>
</td>

</table>
</center>

</body>

</html>
