<?
	session_start();
	
	$pid = $_POST['pid'];
	
	if ($pid != NULL) {
		$pname = $_POST['pname'];
		$emergency = $_POST['emergency'];
		$language = $_POST['language'];
		$enrolldatetime = $_POST['enrolldatetime'];
		$categorygroup = $_POST['categorygroup'];
		$categoryconcept = $_POST['categoryconcept'];
		$region = $_POST['region'];
		$country = $_POST['country'];
		$province = $_POST['province'];
		$city = $_POST['city'];
		$town = $_POST['town'];
		$air = $_POST['air'];
		$hotel = $_POST['hotel'];
		$vehicle = $_POST['vehicle'];
		$durationtype = $_POST['durationtype'];
		$price = $_POST['price'];
		$price2 = $_POST['price2'];
		$price3 = $_POST['price3'];
		$currency = $_POST['currency'];
		$priceunit = $_POST['priceunit'];
		$minpeopleno = $_POST['minpeopleno'];
		$maxpeopleno = $_POST['maxpeopleno'];
		$appliedno = $_POST['appliedno'];
		$meetingpoint = $_POST['meetingpoint'];
		$meetingpointmap = $_POST['meetingpointmap'];
		$finishpoint = $_POST['finishpoint'];
		$authorno = $_POST['authorno'];
		$authorprofileno = $_POST['authorprofileno'];
		$explanation = $_POST['explanation'];
		$itinery = $_POST['itinery'];
		$characteristics = $_POST['characteristics'];
		$option = $_POST['option'];
		$included = $_POST['included'];
		$excluded = $_POST['excluded'];
		$preparation = $_POST['preparation'];
		$notice = $_POST['notice'];
		$evaluationvalue = $_POST['evaluationvalue'];
		$evaluationno = $_POST['evaluationno'];
		
		$insert = "pr_code, pr_name, pr_emergency, pr_langauge, pr_enrolldatetime, 
					pr_categorygroup, pr_categoryconcept, pr_region, pr_country, pr_province, 
					pr_city, pr_town, pr_air, pr_hotel, pr_vehicle, 
					pr_duration, pr_price, pr_price2, pr_price3, pr_currency,
					pr_priceunit, pr_minpeopleno, pr_maxpeopleno, pr_appliedno, pr_meetingpoint,
					pr_meetingpointmap, pr_finishpoint, pr_authorno, pr_authorprofileno, pr_explanation,
					pr_itinery, pr_characteristics, pr_option, pr_included, pr_excluded,
					pr_preparation, pr_notice, pr_evaluationvalue, pr_evaluationno";
					
		$value = "'$pid','$pname','$emergency','$language','$enrolldatetime',
					'$categorygroup','$categoryconcept','$region','$country','$province',
					'$city','$town','$air','$hotel','$vehicle',
					'$durationtype','$price','$price2','$price3','$currency',
					'$priceunit','$minpeopleno','$maxpeopleno','$appliedno','$meetingpoint',
					'$meetingpointmap','$finishpoint','$authorno','$authorprofileno','$explanation',
					'$itinery','$characteristics','$option','$included','$excluded',
					'$preparation','$notice','$evaluationvalue','$evaluationno'";
		
		$sql = "insert into program ( ". $insert ." )";
		$sql .= " values ( " . $value . " )";
		
		
		include "./config/dbconn.php";	
		mysql_query("set names utf8");
		
		$result = mysql_query($sql);
		
		echo "<script> alert('프로그램 입력 완료!'); </script>";
	}
	
?>
<?
$count;
for ($count=1; $count<=4; $count++)
{
	$filename = "fileToUpload" . $count;
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES[$filename]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES[$filename]["tmp_name"]);
echo "<script> alert('$check');</script>";
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	else if ($_FILES[$filename]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	else if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES[$filename]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES[$filename]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Create Program</title>
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
    <form action="page_create_program.php" method="post" enctype="multipart/form-data">
    <table width="75%" border="0" cellpadding="0">
  		<tr>
    		<th scope="row" width="250px">프로그램 번호</th>
    		<td width="300px"><input type="text" name="pid" /></td>
  		</tr>
  		<tr>
    		<th scope="row">프로그램 이름</th>
    		<td><input type="text" name="pname" /></td>
  		</tr>
  		<tr>
    		<th scope="row">비상연락망</th>
    		<td><input type="text" name="emergency" /></td>
  		</tr>
  		<tr>
    		<th scope="row">투어 진행언어</th>
    		<td><input type="text" name="language" /></td>
  		</tr>
  		<tr>
    		<th scope="row">등록일시</th>
    		<td><input type="text" name="enrolldatetime" /></td>
  		</tr>
  		<tr>
    		<th scope="row">여행 카테고리 대분류</th>
   			<td><input type="text" name="categorygroup" /></td>
  		</tr>
  		<tr>
    		<th scope="row">여행 카테고리 컨셉</th>
    		<td><input type="text" name="categoryconcept" /></td>
  		</tr>
  		<tr>
    		<th scope="row">대륙 구분</th>
    		<td><input type="text" name="region" /></td>
  		</tr>
  		<tr>
    		<th scope="row">국가명</th>
    		<td><input type="text" name="country" /></td>
  		</tr>
  		<tr>
    		<th scope="row">주명</th>
    		<td><input type="text" name="province" /></td>
  		</tr>
  		<tr>
    		<th scope="row">도시명</th>
    		<td><input type="text" name="city" /></td>
  		</tr>
  		<tr>
    		<th scope="row">타운명</th>
    		<td><input type="text" name="town" /></td>
  		</tr>
  		<tr>
    		<th scope="row">항공편</th>
    		<td><input type="text" name="air" /></td>
  		</tr>
  		<tr>
    		<th scope="row">호텔</th>
    		<td><input type="text" name="hotel" /></td>
  		</tr>
  		<tr>
    		<th scope="row">이동수단</th>
    		<td><input type="text" name="vehicle" /></td>
  		</tr>
  		<tr>
    		<th scope="row">반나절/하후/2일이상/맞춤시간</th>
    		<td><input type="text" name="durationtype" /></td>
  		</tr>
  		<tr>
    		<th scope="row">기본가격1</th>
    		<td><input type="text" name="price" /></td>
  		</tr>
  		<tr>
    		<th scope="row">특별가격2</th>
    		<td><input type="text" name="price2" /></td>
  		</tr>
  		<tr>
    		<th scope="row">특별가격3</th>
    		<td><input type="text" name="price3" /></td>
  		</tr>
  		<tr>
    		<th scope="row">통화(원)</th>
    		<td><input type="text" name="currency" /></td>
  		</tr>
  		<tr>
    		<th scope="row">가격 기준 사람수</th>
    		<td><input type="text" name="priceunit" /></td>
  		</tr>
  		<tr>
    		<th scope="row">최소가능인원</th>
    		<td><input type="text" name="minpeopleno" /></td>
 		</tr>
  		<tr>
    		<th scope="row">최대가능인원</th>
    		<td><input type="text" name="maxpeopleno" /></td>
  		</tr>
 		<tr>
    		<th scope="row">현재까지 신청자 수</th>
    		<td><input type="text" name="appliedno" /></td>
  		</tr>
  		<tr>
    		<th scope="row">미팅장소 설명</th>
    		<td><input type="text" name="meetingpoint" /></td>
 		</tr>
  		<tr>
    		<th scope="row">미팅장소 구글맵 좌표</th>
    		<td><input type="text" name="meetingpointmap" /></td>
  		</tr>
  		<tr>
    		<th scope="row">해산위치</th>
    		<td><input type="text" name="finishpoint" /></td>
  		</tr>
  		<tr>
    		<th scope="row">프로그램저자 일련번호</th>
    		<td><input type="text" name="authorno" /></td>
  		</tr>
  		<tr>
    		<th scope="row">저자 프로파일 일련번호</th>
   			<td><input type="text" name="authorprofileno" /></td>
  		</tr>
  		<tr>
   		<th scope="row">프로그램 소개 파일명</th>
    		<td><input type="text" name="explanation" /></td>
  		</tr>
  		<tr>
    		<th scope="row">일정표</th>
    		<td><textarea rows="4" name="itinery" ></textarea></td>
  		</tr>
  		<tr>
    		<th scope="row">상품특전</th>
    		<td><textarea rows="4" name="characteristics"></textarea></td>
  		</tr>
  		<tr>
    		<th scope="row">옵션상품</th>
    		<td><textarea rows="4" name="option" ></textarea></td>
  		</tr>
  		<tr>
    		<th scope="row">포함사항</th>
    		<td><textarea rows="4" name="included" ></textarea></td>
  		</tr>
  		<tr>
    		<th scope="row">불포함사항</th>
    		<td><textarea rows="4" name="excluded" ></textarea></td>
  		</tr>
  		<tr>
    		<th scope="row">준비사항</th>
    		<td><textarea rows="4" name="preparation" ></textarea></td>
  		</tr>
  		<tr>
    		<th scope="row">주의사항</th>
    		<td><textarea rows="4" name="notice" ></textarea></td>
  		</tr>
  		<tr>
    		<th scope="row">고객평가점수</th>
    		<td><input type="text" name="evaluationvalue" /></td>
  		</tr>
  		<tr>
    		<th scope="row">고객평가 총인원수</th>
    		<td><input type="text" name="evaluationno" /></td>
  		</tr>
  		<tr>
    		<th scope="row">이미지 파일1</th>
    		<td><input type="file" name="fileToUpload1" id="fileToUpload1" /></td>
  		</tr>
  		<tr>
    		<th scope="row">이미지 파일2</th>
    		<td><input type="file" name="fileToUpload2" id="fileToUpload2" /></td>
  		</tr>
  		<tr>
    		<th scope="row">이미지 파일3</th>
    		<td><input type="file" name="fileToUpload3" id="fileToUpload3" /></td>
  		</tr>
  		<tr>
    		<th scope="row">이미지 파일4</th>
    		<td><input type="file" name="fileToUpload4" id="fileToUpload4" /></td>
  		</tr>
        <tr>
        	<td colspan="2">
            <div align="center">
            	<input type="submit" value="등록" name="submit" />
            </div>
            </td>
        </tr>
	</table>
    </form>    
    <a href="page_main.php"><button>돌아가기</button></a>
	</div>
</body>
</html>
