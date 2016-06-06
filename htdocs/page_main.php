<?
	session_start();	
	$email = $_SESSION['email'];
	$guide = $_SESSION['guide_no'];
	if ($_SESSION['admin'] == "admin_mode"){
		echo "<script>document.location.href='page_admin.php'</script>";
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>main page</title>
    <link type="text/css" rel="stylesheet" href="css/set_main.css" />
	
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
	
    <style>
		form{
			text-align:center;
		}
	</style>
</head>

<body>
	<div>
		<h1 align="center">Main Page</h1>    
        <br /><br /><br /><br /><br />
        <form action="page_search.php" method="get">
        	<input type="submit" value="프로그램 검색" onClick="return userChk()"/>
        </form>
        <form action="page_member.php" method="get">
        	<input type="submit" value="회원정보" onClick="return userChk()"/>
        </form>
        <form action="page_subscribe.php" method="get">
        	<input type="submit" value="신청현황" onClick="return userChk()"/>
        </form>
        <form action="page_create_program.php" method="get">
        	<input type="submit" value="프로그램 등록하기" onClick="return guideChk()"/>
        </form>    
        
	</div>
    <script>
		function userChk(){
			//권한 - 회원
			var email = "<? echo $email?>";
			if (email == "") {
				alert("로그인 후 이용가능");
				return false;
			}
		}
		function guideChk(){
			//권한 - 가이드
			var guide = Number(<? echo $guide?>);
			if (guide == 0) {
				alert("가이드 신청 후 이용가능");
				return false;
			}
		}
	</script>
</body>
</html>
