<?php
function mysqlLogin() {
	$host = "localhost";
	$sqluser = "root";
	$sqlpass = "test1234";
	$sqlconnect = mysql_connect($host, $sqluser, $sqlpass);
	mysql_select_db("Plaintech", $sqlconnect);
}

function query($_query) {
	$loginUserQuery = mysql_query($_query);
	return $loginUserQuery;
}
