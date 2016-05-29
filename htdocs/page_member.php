<? session_start();		
	include "./config/dbconn.php";	
	mysql_query("set names utf8");
	
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$pw = $_SESSION['pw'];
	
	//가이드 신청 처리
	$guide = intval($_GET['g_no_submit']);
	if ($guide != NULL){
		$sql = " SELECT * FROM guide ";
		$sql .= " WHERE g_no = '$guide' ";
		$result = mysql_query($sql);
		if (mysql_num_rows($result) == 0) {
			$sql = " INSERT INTO guide ( g_no, g_email) ";
			$sql .= " values ( $guide, '$email')";
			mysql_query($sql);			
			echo "<script> alert('가이드 신청을 완료했습니다!');</script>";	
		}
		else echo "<script> alert('이미 같은 가이드번호가 존재합니다!');</script>";		
	}
	//로그인 아이디가 가이드 신청 되어있을 경우
	$g_no = NULL;
	$sql = " SELECT * ";
	$sql .= " FROM guide ";
	$sql .= " WHERE g_email = '$email' ";		
	$result = mysql_query($sql);	
	if (mysql_num_rows($result) > 0) {
		$rows = mysql_fetch_object($result);
		$g_no = $rows->g_no;
	}	
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
		<table width="1000" border="1" cellpadding="0">
  			<tr>
    			<th scope="row">회원 이메일</th>
    			<td><?=$email?></td>
  			</tr>
  			<tr>
    			<th scope="row">회원 이름</th>
    			<td><?=$name?></td>
  			</tr>
  			<tr>
    			<th scope="row">회원 비밀번호</th>
    			<td><?=$pw?></td>
  			</tr>
  			<tr>
    			<th scope="row">가이드 신청</th>
    			<td>
				<?
					if ($g_no != NULL){ 
						echo "이미 가이드입니다.";
					}
					else {
						echo "<form action='page_member.php' method='get'>
								<input type='text' name='g_no_submit' />
								<input type='submit' value='가이드 신청(정수)' />
							</form>";
					}
                ?>
                </td>
  			</tr>
		</table>
    	<a href="page_main.php"><button>돌아가기</button></a>
    </div>    
</body>
</html>
