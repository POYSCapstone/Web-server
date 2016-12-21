<?php

//--------------아두이노와 통신--------------------------------------------
$address = "";
$port = 500;
$flag =1;



while(1){
	if(($sock = socket_create(AF_INET, SOCK_STREAM, 0)) < 0)
	echo "create() failed: reason:" .socket_strerror($sock) ."<br>";
	if(($ret = socket_bind($sock, $address, $port)) < 0)
	echo "bind() failed: reason:" .strerror($ret) ."<br>";
	if(($ret = socket_listen($sock, 0)) < 0)
	echo "listen() failed: reason:" .strerror($ret) ."<br>";
	if(($msgsock = socket_accept($sock)) < 0)
	echo "accpet() failed: reason:" .strerror($msgsock) ."<br>";

	$buf = '';
	$ret = '';
	$talkback = '';
	$ret = socket_read($msgsock, 2048);
	echo "Receive data : $ret <br>";

	$temp = preg_split("/\s+/", $ret);	
	sort($temp);

	for($i = count($temp) - 1; $i >= 0; $i--)
		{
			$talkback .= $temp[$i]." ";
	}

	socket_write($msgsock, $talkback, strlen($talkback));





//--------------db와의 접속 및 데이터 업데이트-----------------------------
	$hostname = "127.0.0.1";
	$username = "root";
	$password = "kongbak0100";
	$dbname = "hoon";

	$connect = mysql_connect($hostname, $username, $password) or die("mysql server연결에  실패!");
	$status = mysql_select_db($dbname, $connect);

	if($status){

		if($ret==2 && $flag==0){
			mysql_query("UPDATE ajou SET STATE='EMPTY' WHERE TRASHCAN='paldal'");

			if(mysql_query){
				echo("update 성공!");
			}
			else{
				echo("update 실패");
			}

			$flag =1;
		}

	else if($ret==1 && $flag==1){
		mysql_query("UPDATE ajou SET STATE='FULL' WHERE TRASHCAN='paldal'");

			if(mysql_query){
				echo("update 성공!");
			}
			else{
				echo("update 실패");
			}

			$flag =0;
		}

		else{

		}


	}
	else{
		echo("mysql connect 실패");
	}

	mysql_close($connect);

}



socket_close($msgsock);
socket_close($sock);

?>
