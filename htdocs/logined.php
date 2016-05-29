<?php
	session_start();	
	include "./config/dbconn.php";	
	
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$pw = $_SESSION['pw'];
	
	//가이드 확인
	$sql = " SELECT * FROM guide ";
	$sql .= " WHERE g_email = '$email' ";	
	$result = mysql_query($sql);	
	if (mysql_num_rows($result) > 0) {
		$rows = mysql_fetch_object($result);
		$_SESSION['guide_no'] = $rows->g_no;
	}
	
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
            <br/>
            <?
				if ($_SESSION['guide_no'] == NULL){ 
					echo "일반회원";
				}
				else if ( $_SESSION['guide_no'] != NULL){ 
					echo "가이드번호 : ";
					echo $_SESSION['guide_no'];
				}
			?>
        </p>
        <form action="login.php">
        	<input type="hidden" name="out" value="out" />
        	<input type="submit" value="로그아웃"/>
        </form>
    </div>
    </div>
    <script> 		
		parent.page.location.reload();
  	</script>
</body>
</html>
