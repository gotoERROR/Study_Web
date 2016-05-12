<? session_start();
		
	include "./config/dbconn.php";	
	mysql_query("set names utf8");
		
	$area1 = $_GET['area1'];
	$area2 = $_GET['area2'];
	$area3 = $_GET['area3'];
	$pricelow = intval($_GET['pricelow']);
	$pricehigh = intval($_GET['pricehigh']);
	$theme = $_GET['theme'];
	$duration = $_GET['duration'];	
	
	$sql = " select pr_code, pr_name, pr_price, pr_categoryconcept, pr_duration, pr_region, pr_country, pr_city ";
	
	$sql = "select * ";
	$sql .= " from program where pr_code > 0 ";
	$sql .= " and pr_price >= $pricelow and pr_price <= $pricehigh "; 
	$sql .= " and pr_duration = '$duration' ";
	if ($area1 != "모든대륙") $sql .= " and pr_region = '$area1' ";
	if ($area2 != "모든국가") $sql .= " and pr_country = '$area2' ";
	if ($area3 != "모든도시") $sql .= " and pr_city = '$area3' ";	
	
	$result = mysql_query($sql);
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	<div>
    <form action="page_search.php" method="get">
    	<table width="85%" border="1">
  			<tr>
    			<th scope="row">1. 지역</th>
    			<td>
                <select name="area1">
        			<option value="모든대륙">모든대륙</option>
        			<option value="아시아">아시아</option>
        		</select>  
                <select name="area2">
        			<option value="모든국가">모든국가</option>
        			<option value="한국">한국</option>
        		</select>
                <select name="area3">
        			<option value="모든도시">모든도시</option>
        			<option value="부산">부산</option>
        			<option value="서울">서울</option>
        		</select>            
            	</td>
  			</tr>
  			<tr>
    			<th scope="row">2. 가이드 비용</th>
    			<td>                
        		<select name="pricelow">
        			<option value="10000">10,000</option>
        		</select>
                ~
                <select name="pricehigh">
        			<option value="100000">100,000</option>
        		</select>
                </td>
  			</tr>
  			<tr>
    			<th scope="row">3. 여행 테마</th>
    			<td>                
        		<select name="theme">
        			<option value="여행테마">여행테마</option>
        			<option value="여행테마">테스트</option>
        		</select>                
                </td>
  			</tr>
  			<tr>
    			<th scope="row">4. 여행 기간</th>
    			<td>                
        		<select name="duration">
        			<option value="반일">반일(half day)</option>
        		</select>                
                </td>
  			</tr>
		</table>
        <input type="submit" value="검색하기" />
        </form>
    </div>
    
    <div>
		<?
			if (mysql_num_rows($result) > 0) {
		?>
        <table border="1">
        	<tr>
            	<th> 상품번호 	</th>
            	<th> 상품명   	</th>
            	<th> 대륙		</th>
            	<th> 국가		</th>
            	<th> 도시		</th>
            	<th> 가이드비용	</th>
            	<th> 여행테마	</th>
            	<th> 여행기간	</th>
                <th>선택</th>
            </tr>
        	<?
				while ($rows = mysql_fetch_object($result)){
					$code = $rows->pr_code;
					$name = $rows->pr_name;
					$area1 = $rows->pr_region;
					$area2 = $rows->pr_country;
					$area3 = $rows->pr_city;
					$price = $rows->pr_price;
					$theme = $rows->pr_categoryconcept;
					$duration = $rows->pr_duration;
			?>
            <tr>
            	<td> <?=$code?> </td>
            	<td> <?=$name?></td>
            	<td> <?=$area1?></td>
            	<td> <?=$area2?></td>
            	<td> <?=$area3?></td>
                <td> <?=$price?></td>
                <td> <?=$theme?></td>
                <td> <?=$duration?></td>
                <td> <button>선택</button></td>
            </tr>
            <? } ?>
        </table>
        <? } ?>
    </div>    
</body>
</html>
