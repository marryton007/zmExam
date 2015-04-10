<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="base.css" type="text/css">
<title>上海大众汽车30周年知识竞赛</title>
<body >
<div class="box">
<label style="font-size:1.2em">个人信息：</label>

<br/><br/>
<form action="" method="post">
<br/><br/>
<label style="font-size:1.1em">姓名:</label>&nbsp;&nbsp;<input type="text" name="name"></input>
<br/><br/>
<label style="font-size:1.1em">手机:</label>&nbsp;&nbsp;<input type="text" name="phone"></input>
<br/><br/>
<label style="font-size:1.1em">工号:</label>&nbsp;&nbsp;<input type="text" name="department"></input>
<br/><br/>
<div class="btn2"><input type='submit' style="width: 40%; height: 35px; font-size:16px"  value='提&nbsp;&nbsp;交'></div>
</form>
<?php
require 'vendor/autoload.php';
require 'db.php';

if(!empty($_POST)){
	try {
		$name = trim($_POST['name']);
		$phone = trim($_POST['phone']);
		$department = trim($_POST['department']);
		if(empty($name) || empty($phone) || empty($department)){
			echo "<b><font color='red'>请填写完整信息!</font>";
		}else{
			$data = array(
					'name'  => $name,
					'phone' => $phone,
					'depart' => $department,
					'score' => $_SESSION['score'],
					'starttime' => $_SESSION['starttime'],
					'endtime' => date('Y-m-d H:i:s'),
					);
			$db = new ExamDB();
			$res = $db->insertUser($data);
			if($res){
				//echo "您的成绩已提交!";
				$url = "http://zmexam.sinaapp.com/exam/over.php"; 
				echo "<script language=\"javascript\">"; 
				echo "location.href=\"$url\""; 
				echo "</script>";
				exit();
			}else{
				echo "<b><font color='red'>出错了".$res."</font>";
			}
		}
	} catch (Exception $e) {
		echo "<b><font color='red'>出错了，电话号码冲突！</font>";			
        //echo $e;
	}
}
?>
</div>
</body>
</html>
