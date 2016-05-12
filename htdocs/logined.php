<?php
	session_start();
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$pw = $_SESSION['pw'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>logined</title>
    <link type="text/css" rel="stylesheet" href="css/set_main.css" />
    <style>
		th{
			text-align:left;
		}
	</style>
</head>

<body>
	<div style="margin:5%">
    <div>
    	<p>
        	<?php	echo "$name";	?> 님
            환영합니다!
        </p>
        <form action="login.php">
        	<input type="hidden" name="out" value="out" />
        	<input type="submit" value="로그아웃"/>
        </form>
    </div>
    </div>
    <script> 
  	</script>
</body>
</html>
