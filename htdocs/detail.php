<? session_start();
	$code = intval($_GET['code']);
	
	include "./config/dbconn.php";	
	mysql_query("set names utf8");
	
	$sql = " select * from program where pr_code  = $code ";
	$result = mysql_query($sql);
	$row = mysql_fetch_object($result);
	//$filename = $row->pr_explanation;
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?=$code?> detail</title>
    <link type="text/css" rel="stylesheet" href="css/set_main.css" />
</head>

<body>
	<div>
    <table width="1000" border="1" cellpadding="0">
  		<tr>
    		<th scope="row" width="200px">프로그램 번호</th>
    		<td width="500px"><?=$pr_code?></td>
  		</tr>
  		<tr>
    		<th scope="row">프로그램 이름</th>
    		<td><?=$row->pr_name?></td>
  		</tr>
  		<tr>
    		<th scope="row">비상연락망</th>
    		<td><?=$row->pr_emergency?></td>
  		</tr>
  		<tr>
    		<th scope="row">투어 진행언어</th>
    		<td><?=$row->pr_langauge?></td>
  		</tr>
  		<tr>
    		<th scope="row">등록일시</th>
    		<td><?=$row->pr_enrolldatetime?></td>
  		</tr>
  		<tr>
    		<th scope="row">여행 카테고리 대분류</th>
   			<td><?=$row->pr_categorygroup?></td>
  		</tr>
  		<tr>
    		<th scope="row">여행 카테고리 컨셉</th>
    		<td><?=$row->pr_categoryconcept?></td>
  		</tr>
  		<tr>
    		<th scope="row">대륙 구분</th>
    		<td><?=$row->pr_region?></td>
  		</tr>
  		<tr>
    		<th scope="row">국가명</th>
    		<td><?=$row->pr_country?></td>
  		</tr>
  		<tr>
    		<th scope="row">주명</th>
    		<td><?=$row->pr_province?></td>
  		</tr>
  		<tr>
    		<th scope="row">도시명</th>
    		<td><?=$row->pr_city?></td>
  		</tr>
  		<tr>
    		<th scope="row">타운명</th>
    		<td><?=$row->pr_town?></td>
  		</tr>
  		<tr>
    		<th scope="row">항공편</th>
    		<td><?=$row->pr_air?></td>
  		</tr>
  		<tr>
    		<th scope="row">호텔</th>
    		<td><?=$row->pr_hotel?></td>
  		</tr>
  		<tr>
    		<th scope="row">이동수단</th>
    		<td><?=$row->pr_vehicle?></td>
  		</tr>
  		<tr>
    		<th scope="row">반나절/하후/2일이상/맞춤시간</th>
    		<td><?=$row->pr_duration?></td>
  		</tr>
  		<tr>
    		<th scope="row">기본가격1</th>
    		<td><?=$row->pr_price?></td>
  		</tr>
  		<tr>
    		<th scope="row">특별가격2</th>
    		<td><?=$row->pr_price2?></td>
  		</tr>
  		<tr>
    		<th scope="row">특별가격3</th>
    		<td><?=$row->pr_price3?></td>
  		</tr>
  		<tr>
    		<th scope="row">통화(원)</th>
    		<td><?=$row->pr_currency?></td>
  		</tr>
  		<tr>
    		<th scope="row">가격 기준 사람수</th>
    		<td><?=$row->pr_priceunit?></td>
  		</tr>
  		<tr>
    		<th scope="row">최소가능인원</th>
    		<td><?=$row->pr_minpeopleno?></td>
 		</tr>
  		<tr>
    		<th scope="row">최대가능인원</th>
    		<td><?=$row->pr_maxpeopleno?></td>
  		</tr>
 		<tr>
    		<th scope="row">현재까지 신청자 수</th>
    		<td><?=$row->pr_appliedno?></td>
  		</tr>
  		<tr>
    		<th scope="row">미팅장소 설명</th>
    		<td><?=$row->pr_meetingpoint?></td>
 		</tr>
  		<tr>
    		<th scope="row">미팅장소 구글맵 좌표</th>
    		<td><?=$row->pr_meetingpointmap?></td>
  		</tr>
  		<tr>
    		<th scope="row">해산위치</th>
    		<td><?=$row->pr_finishpoint?></td>
  		</tr>
  		<tr>
    		<th scope="row">프로그램저자 일련번호</th>
    		<td><?=$row->pr_authorno?></td>
  		</tr>
  		<tr>
    		<th scope="row">저자 프로파일 일련번호</th>
   			<td><?=$row->pr_authorprofileno?></td>
  		</tr>
  		<tr>
   		<th scope="row">프로그램 소개 파일명</th>
    		<td><?=$row->pr_explanation?></td>
  		</tr>
  		<tr>
    		<th scope="row">일정표</th>
    		<td><?=$row->pr_itinery?></td>
  		</tr>
  		<tr>
    		<th scope="row">상품특전</th>
    		<td><?=$row->pr_characteristics?></td>
  		</tr>
  		<tr>
    		<th scope="row">옵션상품</th>
    		<td><?=$row->pr_option?></td>
  		</tr>
  		<tr>
    		<th scope="row">포함사항</th>
    		<td><?=$row->pr_included?></td>
  		</tr>
  		<tr>
    		<th scope="row">불포함사항</th>
    		<td><?=$row->pr_excluded?></td>
  		</tr>
  		<tr>
    		<th scope="row">준비사항</th>
    		<td><?=$row->pr_preparation?></td>
  		</tr>
  		<tr>
    		<th scope="row">주의사항</th>
    		<td><?=$row->pr_notice?></td>
  		</tr>
  		<tr>
    		<th scope="row">고객평가점수</th>
    		<td><?=$row->row->pr_evaluationvalue?></td>
  		</tr>
  		<tr>
    		<th scope="row">고객평가 총인원수</th>
    		<td><?=$row->pr_evaluationno?></td>
  		</tr>
	</table>
    <button onClick="history.back()">돌아가기</button>
    </div>
</body>
</html>
