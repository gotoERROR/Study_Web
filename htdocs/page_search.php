<? session_start();
		
	include "./config/dbconn.php";	
	mysql_query("set names utf8");
		
	$php_select = $_GET['php_select'];
	
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
		
	//echo "row_no : ".mysql_num_rows($result_high_diabetsrisk);
	//-----
	
	if ($php_select == "exel"){
		
				//========================
				// 엑셀파일로 저장
				//========================
				/** PHPExcel */
				require_once("./Classes/PHPExcel.php");
				/* PHPExcel.php 파일의 경로를 정확하게 지정해준다. */
				
				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();
				
				// Set properties
				// Excel 문서 속성을 지정해주는 부분이다. 적당히 수정하면 된다.
				$objPHPExcel->getProperties()->setCreator("MyRealTrip")
											 ->setLastModifiedBy("관리자")
											 ->setTitle("MyRealTrip 프로그램")
											 ->setSubject("MyRealTrip 프로그램")
											 ->setDescription("MyRealTrip 프로그램")
											 ->setKeywords("MyRealTrip 프로그램")
											 ->setCategory("MyRealTrip 프로그램");
				
				
				// Add some data
				// Excel 파일의 각 셀의 타이틀을 정해준다.
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue("A1", "상품번호")
							->setCellValue("B1", "상품명")
							->setCellValue("C1", "대륙")
							->setCellValue("D1", "국가")
							->setCellValue("E1", "도시")
							->setCellValue("F1", "가이드비용")
							->setCellValue("G1", "여행테마")
							->setCellValue("H1", "여행기간");
				
				// for 문을 이용해 DB에서 가져온 데이터를 순차적으로 입력한다.
				// 변수 i의 값은 2부터 시작하도록 해야한다.
				$i = 2;
				while ($rows = mysql_fetch_object($result)) {
					
					$code = $rows->pr_code;
					$name = $rows->pr_name;
					$region = $rows->pr_region;
					$country = $rows->pr_country;
					$city = $rows->pr_city;
					$price = $rows->pr_price;
					$theme = $rows->pr_categoryconcept;					
					$duration = $rows->pr_duration;
					
					
					// Add some data
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue("A$i", "$code")
								->setCellValue("B$i", "$name")
								->setCellValue("C$i", "$region")
								->setCellValue("D$i", "$country")
								->setCellValue("E$i", "$city")
								->setCellValue("F$i", "$price")
								->setCellValue("G$i", "$theme")
								->setCellValue("H$i", "$duration");
								
								$i++;
				} // while
				
				// Rename sheet
				$title = "MyRealTrip 프로그램";
				//$objPHPExcel->getActiveSheet()->setTitle("개인별 혈당 데이터");
				$objPHPExcel->getActiveSheet()->setTitle($title);
				
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
				
				// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.
				//$filename = iconv("UTF-8", "EUC-KR", "개인별 혈당 데이터");
				$filename = iconv("UTF-8", "EUC-KR", $title);
				
				// Redirect output to a client's web browser (Excel5)
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="' .$filename.'.xls"');
				header('Cache-Control: max-age=0');
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');			
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
        <input type="hidden" value="default" id="php_select" name="php_select" />
        <input type="submit" onClick="document.getElementById('php_select').value = 'search'" value="검색하기" />
        <input type="submit" onClick="document.getElementById('php_select').value = 'exel'" value="엑셀파일생성" />
        </form>
    </div>
    
    <div>
    <?	if ($php_select == "search"){ ?>
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
                <td> <a href="detail.php?code=<?=$code?>"><button>선택</button></a></td>
            </tr>
            <? } ?>
        </table>
        <? } ?>
    <? } ?>       
    	<a href="page_main.php"><button>돌아가기</button></a>
    </div>    
</body>
</html>
