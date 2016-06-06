<?
	session_start();
	include "./config/dbconn.php";	
	$admin = $_SESSION['admin'];
	
	//전체 멤버 수
	$sql = " SELECT count(*) as count FROM member ";
	$sql .= "";	
	$result = mysql_query($sql);	
	$rows = mysql_fetch_object($result);
	$member = intval($rows->count);
	
	//전체 가이드 수
	$sql = " SELECT count(*) as count FROM guide ";
	$sql .= "";	
	$result = mysql_query($sql);	
	$rows = mysql_fetch_object($result);
	$guide = intval($rows->count);
	
	//전체 프로그램 수	
	$sql = " SELECT count(*) as count FROM program ";
	$sql .= "";	
	$result = mysql_query($sql);	
	$rows = mysql_fetch_object($result);
	$program = intval($rows->count);
	
	//프로그램 신청 수
	$sql = " SELECT sum(count) as count FROM subscribe ";
	$sql .= "";	
	$result = mysql_query($sql);	
	$rows = mysql_fetch_object($result);
	$subscribe = intval($rows->count);		
	
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
	<h1 align="center">관리자 페이지</h1>
	<table width="1000" border="0" cellpadding="0">
  		<tr>
    		<td>
    			<h2> 전체 회원 : <?=$member?>명 </h2>
    			<h2> 순수 회원 : <?=$member-$guide?>명</h2>    
    			<h2> 회원 겸 가이드 : <?=$guide?>명</h2>
            </td>
    		<td>
    			<canvas id="memberCount1" width="700" height="50"></canvas><br/>
    			<canvas id="memberCount2" width="700" height="50"></canvas><br/>
    			<canvas id="memberCount3" width="700" height="50"></canvas><br/>       
            </td>
  		</tr>
	</table>

    <script>
		//전체 회원 그래프
		var canvas = document.getElementById('memberCount1');
		var context = canvas.getContext('2d');			
		var gradient = context.createLinearGradient(100, 0, 300, 0);
       	gradient.addColorStop(0, "white");
       	gradient.addColorStop(0.5, "red");
       	gradient.addColorStop(1, "black");
       	context.fillStyle = gradient;
       	context.fillRect(100, 10, 180, 50);
		//일반 회원 그래프
		var canvas = document.getElementById('memberCount2');
		var context = canvas.getContext('2d');			
		var gradient = context.createLinearGradient(100, 0, 300, 0);
       	gradient.addColorStop(0, "white");
       	gradient.addColorStop(0.5, "green");
       	gradient.addColorStop(1, "black");
       	context.fillStyle = gradient;
       	context.fillRect(100, 10, 180, 50);
		//가이드 회원 그래프
		var canvas = document.getElementById('memberCount3');
		var context = canvas.getContext('2d');			
		var gradient = context.createLinearGradient(100, 0, 300, 0);
       	gradient.addColorStop(0, "white");
       	gradient.addColorStop(0.5, "blue");
       	gradient.addColorStop(1, "black");
       	context.fillStyle = gradient;
       	context.fillRect(100, 10, 180, 50);		
	</script>
    <br/>
    <br/>
    <br/>
    <br/>
    <h2> 전체 프로그램 수 : <?=$program?>개</h2>
    <h2> 전체 신청인원 : <?=$subscribe?>명</h2>
    <h2> 프로그램 평균 신청자 수 (인원/프로그램) : <?=$subscribe/$program?></h2>
    <br/>
    <br/>
    <br/>
    <br/>
    <canvas id="memberCanvas" width="250" height="250"> </canvas>
    <script> 
		var canvas = document.getElementById('memberCanvas');
		var context = canvas.getContext('2d');
		
		<?
			$graph_member = (($member-$guide) / floatval($member))*2;
			$graph_guide = ($guide / floatval($member))*2;
		?>
		//arc : 중심가로, 중심세로, 반지름, 시작위치(도수*PI/180), 시계반대방향)
		//순수일반회원 그리기
		context.beginPath();	
		context.moveTo(125, 125);
		context.arc(125, 125, 125, 0*Math.PI, <?=$graph_member?>*Math.PI,false);
		context.lineTo(125, 125);
		context.strokeStyle = "green";
		context.fillStyle = "green";
		context.fill();
		context.fillText('일반회원',0,40);
		context.stroke();
		//가이드회원 그리기
		context.beginPath();
		context.moveTo(125, 125);		
		context.arc(125, 125, 125, <?=$graph_member?>*Math.PI, <?=$graph_guide?>*Math.PI/180,false);
		context.lineTo(125, 125);
		context.strokeStyle = "blue";
		context.fillStyle = "blue";
		context.fill();
		context.fillText('가이드회원',0,60);
		context.stroke();				
    </script>    
    
</body>
</html>
