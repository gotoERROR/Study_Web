<? session_start();
		
	include "./config/dbconn.php";	
	mysql_query("set names utf8");
	
	$email = $_SESSION['email'];
	
	$sql = " SELECT * FROM subscribe ";
	$sql .= " where m_email = '$email' ";
	$result = mysql_query($sql);	
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search</title>
    <link type="text/css" rel="stylesheet" href="css/set_main.css" />
    <style>
		form{
			text-align:center;
		}
		td{

			text-align:left;
		}
		textarea{
			overflow:hidden;
			width:300px;
		}
	</style>
</head>

<body>
    </div>
    <table width="800" border="1" cellpadding="0">
    	<tr>
        	<td>신청한 프로그램</td>
        	<td>신청자 이메일</td>
        	<td>신청인원</td>
        </tr>
	<?	
		if (mysql_num_rows($result) > 0) {
			while ($rows = mysql_fetch_object($result)){ 
			$code = $rows->pr_code;
			$email = $rows->m_email;
			$count = $rows->count;
	?>
    	<tr>
        	<td><?=$code?></td>	
        	<td><?=$email?></td>	
        	<td><?=$count?></td>	
        </tr>			
		<? } ?>
	<? } ?> 
	</table>
    <a href="page_main.php"><button>돌아가기</button></a>
    </div>    
</body>
</html>
