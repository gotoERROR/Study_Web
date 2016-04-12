<?
	include "./config/dbconn.php";
	mysql_query("set names utf8");
	
	$id = $_POST['id'];		
	$pw1 = $_POST['pw1'];	
	$pw2 = $_POST['pw2'];	
	$email = $_POST['email'];
	$tel = $_POST['tel'];
	$url = $_POST['url'];
	$gender =$_POST['gender'];
	$year = $_POST['year'];
	$photo = $_POST['photo'];
	$hab1 = $_POST['hab1'];
	$hab2 = $_POST['hab2'];
	$hab3 = $_POST['hab3'];
	$hab4 = $_POST['hab4'];
	
	$sql = "insert into member_info (m2_id, m2_pwd, m2_pwd2, m2_email, m2_tel, m2_url, m2_gender, m2_year, m2_photo, m2_hab1, m2_hab2, m2_hab3, m2_hab4)";
	$sql .= " values ('$id','$pw1','$pw2','$email','$tel','$url','$gender','$year','$photo','$hab1','$hab2','$hab3','$hab4')";
	
	echo "*sql : " . $sql . "<br>";
	$result = mysql_query($sql);
	
	if (!$result)
	{
		$msg = "DB에 데이터 입력 오류 !!!";
		echo ("<script>
					alert('$msg');
					history.back();
				</script>");
	}
	else
	{
		$_SESSION['ss_user_id'] = $id;
		$_SESSION['ss_user_pwd'] = $pwd;
		$msg = "[" . $id . "님] 저장 완료";
		$page = "./join2.php";
		echo ("<script>
					alert('$msg');
				</script>");
		echo ("parent.location.replace('$page');");
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>무제 문서</title>
</head>

<body>
	<table width="85%" border="1">
  <tr>
    <th scope="row">아이디</th>
    <td><? echo $id;?>	</td>
  </tr>
  <tr>
    <th scope="row">비밀번호</th>
    <td><? echo  $pw1;?></td>
  </tr>
  <tr>
    <th scope="row">비밀번호확인</th>
    <td><? echo  $pw2;?></td>
  </tr>
  <tr>
    <th scope="row">이메일</th>
    <td><? echo $email;?></td>
  </tr>
  <tr>
    <th scope="row">전화번호</th>
    <td><? echo $tel;?></td>
  </tr>
  <tr>
    <th scope="row">홈페이지</th>
    <td><? echo $url;?></td>
  </tr>
  <tr>
    <th scope="row">성별</th>
    <td><? echo $gender;?></td>
  </tr>
  <tr>
    <th scope="row">출생년도</th>
    <td><? echo $year;?></td>
  </tr>
  <tr>
    <th scope="row">사진</th>
    <td><img src=".\img\<? echo  $photo;?>" width="50%" heiht="25%"></td>
  </tr>
  <tr>
    <th scope="row">취미</th>
    <td> <? echo  $hab1; ?><br/><? echo  $hab2; ?><br/><? echo  $hab3; ?><br/><? echo  $hab4; ?></td>
  </tr>
</table>

</body>
</html>
