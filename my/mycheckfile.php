<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

<style type="text/css">
table.clock {
	  text-align: center;
	    border: thin dotted blue;
		      padding: 5px;
			         margin: auto;
}

td, input.clock2 {
	  text-align: center;
	    border: none;
		      font: bold .9em verdana, helvetica, arial, sans-serif;
			      padding-bottom: .5em;
}

.clock3 {
	  text-align: center;
	    font: .7em verdana, arial, helvetica, ms sans serif;
}


</style>
<script type="text/javascript" src="timeFormat.js"></script>
<script language="javascript" src="xp_progress.js"></script>
</head>

<body>
<script type="text/javascript">
var bar1= createBar(300,15,'white',1,'black','blue',85,7,3,"");
</script>

<?php
extract($_GET);
#print $hvacsystem;
#exit();
$filename = "./flagfile.txt";

if (file_exists($filename)) 
{
	#header("Location: result.php?userid=$userid");
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
		fputs ($fp, "delete");
		$msg=fgets($fp,17);
		echo "message from server.c is $msg <br>";
		if($msg!="")
		{
			echo "redirecting";
			echo("<meta http-equiv=\"refresh\" content=\"4;URL=mydisplay.php\">");
		}
		close($fp);
		die();
	}
}

echo("<meta http-equiv=\"refresh\" content=\"5;URL=mycheckfile.php\">");
echo("Simulating Base and other window models<br><br> ");
?>
This may take about 2 minutes, please wait..
</body>

</html>
