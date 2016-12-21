<?PHP

$address = "172.31.11.107";
$port = 500;

if(($sock = socket_create(AF_INET, SOCK_STREAM, 0)) < 0)
	echo "create() failed: reason:" .socket_strerror($sock) ."<br>";
if(($ret = socket_bind($sock, $address, $port)) < 0)
	echo "bind() failed: reason:" .strerror($ret) ."<br>";
if(($ret = socket_listen($sock, 0)) < 0)
	echo "listen() failed: reason:" .strerror($ret) ."<br>";
if(($msgsock = socket_accept($sock)) < 0)
while(1){
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
//echo "Send data : $talkback <br>";
}
socket_close($msgsock);
socket_close($sock);

?>
