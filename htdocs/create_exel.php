<?
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
											 ->setTitle("MyRealTrip")
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
				$title = "MyRealTrip";
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