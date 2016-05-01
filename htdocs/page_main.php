<?
	session_start();	
	$email = $_SESSION['email'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>main page</title>
    <link type="text/css" rel="stylesheet" href="css/set_main.css" />
    <style>
		form{
			text-align:center;
		}
	</style>
</head>

<body>
	<div>
		<h1 align="center">Main Page</h1>
        <br /><br /><br /><br /><br /><br />
        <form action="page_create_program.php" method="get">
        	<input type="submit" value="프로그램 등록하기" onClick="return createProgram()"/>
        </form>
	</div>
    <script>
		function createProgram(){
			var email = "<? echo $email?>";
			if (email == "") {
				alert("로그인 후 이용가능");
				return false;
			}
		}
	</script>
</body>
</html>
