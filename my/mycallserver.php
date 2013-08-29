<?php

session_start();

$host="localhost";
$port =5432;  //port number
$fp = fsockopen($host, $port, $errno, $errstr);
if( !$fp)
{
	die ("couldnot connect to server");
}
socket_set_timeout($fp, 300);
if (!$fp)
{
	$result = "Error: could not open socket connection";
	echo $result;
}
else
{
	fputs ($fp, "execute");
	$msg="";
	$msg=fgets($fp,17);
	sleep(5);
	echo "message from server.c is $msg <br>";
	if($msg!="")
	{
		header("Location: mycheckfile.php");
	}
	
	close($fp);
}

?>

