<? session_start();
// db 연결
	include "./config/dbconn.php";
	mysql_query("set names utf8");
	
	$emailid = trim($_POST['email']);
	$emailid = $emailid."%";
	
	$sql = "select * from member where m_email like '$emailid'  order by m_email asc   limit 5";
	
	$result = mysql_query($sql);
	
	$emailids = array();
	
	$ndx = 0;
	while ($row=mysql_fetch_object($result)) {
		$emailids[$ndx] = $row->m_name.",";
		$emailids[$ndx] .= $row->m_pw.",";
		$emailids[$ndx] .= $row->m_email."/";
		echo $emailids[$ndx];
		$ndx++;	
	}
?>