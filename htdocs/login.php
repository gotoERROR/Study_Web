<?php
	session_start();
	//로그아웃 hidden 값 out 이면 세션 디스트로이
	$out = $_GET['out'];
	if ($out != NULL)
		session_destroy();
	//세션값(이메일)이 있으면 로그인상태전환
	if ($_SESSION['email'] != NULL) echo "<script>document.location.href='logined.php'</script>";
	
	//스스로 호출한 값
	$email = $_GET['email'];
	$pw = $_GET['pw'];
	$name = $_GET['name'];
	$btn = $_GET['sign'];
	
	//hidden 값 in (로그인)
	if ($email != NULL && $btn == "in"){
		include "./config/dbconn.php";	
		mysql_query("set names utf8");
		
		//중복 체크
		$sql = "select m_email as same_email, m_pw as same_pw, m_name as same_name";
		$sql .= " from member";
		$sql .= " where m_email = '$email' limit 1";
				
		$result = mysql_query($sql);
		$row = mysql_fetch_object($result);
		$same_email = $row->same_email;
		$same_pw = $row->same_pw;
		$same_name = $row->same_name;
		
		if ($email==$same_email && $pw==$same_pw){
			$_SESSION['email'] = $same_email;
			$_SESSION['pw'] = $same_pw;
			$_SESSION['name'] = $same_name;
			echo "<script>parent.location.reload()</script>";
		} 
		else if ($email != $same_email) { echo "<script> alert('등록되지 않은 이메일 입니다.'); </script>";}
		else if ($pw != $same_pw) {	echo "<script> alert('비밀번호가 틀렸습니다.'); </script>";}
	} else if ($email != NULL && $btn == "up"){//hidden 값 up (회원가입)
		include "./config/dbconn.php";	
		mysql_query("set names utf8");
		//회원테이블에 입력
		$sql = "insert into member ( m_email, m_pw, m_name )";
		$sql .= " values( '$email', '$pw', '$name' )";		
		mysql_query($sql);		
		echo "<script> alert('가입 완료!'); </script>";
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Sign in</title>
    <link type="text/css" rel="stylesheet" href="css/set_main.css" />
    <style>
		th{
			text-align:left;
		}
	</style>
</head>

<body>
	<div style="margin:5%">
   	<form action="login.php" method="get">
    	<table border="0" cellpadding="0">
  			<tr>
    			<th width="5px" scope="row">Email</th>
    			<td width="5px" align="center">
                	<input type="email" id="email" name="email" />
                </td>
      		</tr>
      		<tr>
        		<th scope="row">PW</th>
        		<td align="center">
                <input type="password" id="pw" name="pw" />
            </td>
      		</tr>
      		<tr>
        		<th scope="row">Name</th>
        		<td align="center">
                <input type="text" id="name" name="name" />
            </td>
      		</tr>
      		<tr>
        		<td colspan="3" align="center">
                	<input type="hidden" value="" id="sign" name="sign" />
                	<input type="submit" value="로그인" onClick="signIn()" />
                    <input type="submit" value="회원가입" onClick="return signUp()" />
                </td>
      		</tr>
    	</table>
    </form>
    </div>
    <script>
		function signIn(){
			//hidden 값 구분 (로그인)
			var button = document.getElementById("sign");
			button.value ="in";
		}
		function signUp(){
			//hidden 값 구분 (회원가입)
			var button = document.getElementById("sign");
			button.value = "up";
		}
	</script>
</body>
</html>
