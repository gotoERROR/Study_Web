<?php
	$dbconn = mysql_connect("localhost","root","apmsetup");
	if (!$dbconn)
	{
		echo("#001. Database Connection Error !!!");
		exit;	
	}
	$status = mysql_select_db("member2", $dbconn);
	if (!$status)
	{
		echo("#002. Database Select Error !!!");
		exit;	
	}
?>