<?php

$hostname = "127.0.0.1";
$username = "root";
$password = "kongbak0100";
$dbname = "hoon";

$connect = mysql_connect($hostname, $username, $password) or die("mysql server연결에  실패!");
$status = mysql_select_db($dbname, $connect);

if($status){



mysql_query("INSERT INTO test(can,posiotion,full,tiemstamp) VALUES(7,7,7,7)");

if(mysql_query){
	echo("insert 성공!");
}
else{
	echo("insert 실패");
}
}
else{
	echo("mysql connect 실패");
}

mysql_close($connect);

?>