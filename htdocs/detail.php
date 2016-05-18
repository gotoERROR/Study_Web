<? session_start();
	$code = intval($_GET['code']);
	
	/*	
	include "./config/dbconn.php";	
	mysql_query("set names utf8");
	
	$sql = " select * from program where pr_code  = $code ";
	$result = mysql_query($sql);
	$row = mysql_fetch_object($result);
	$filename = $row->pr_explanation;
	*/
	$filename = "./" .$code . ".html";
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>무제 문서</title>
    <link type="text/css" rel="stylesheet" href="css/set_main.css" />
</head>

<body>
	<? include_once($filename); ?>
</body>
</html>
