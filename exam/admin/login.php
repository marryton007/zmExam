<html>
<head>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form id="login" action="" method="post">
<table align="center">
<tr>

<td>用户名:</td> <td>&nbsp;&nbsp;<input type="text" name="u_name"></input></td>
</tr>
<tr>
<td>密码:</td> <td>&nbsp;&nbsp;<input type="password" name="u_passwd"></input></td> 
</tr>
<tr>
</tr>
<tr>
<td><input type="submit" value="登录"></input></td>
</tr>
</form>
<?php
	require '../vendor/autoload.php';
	require '../db.php';

	function displayUsers(){
		$db = new ExamDB();
		$result = $db->getTopUser(200);
		if(!$result[0]){
			echo "<b><font color='red'>还没有数据！</font>";
		}else{
			echo '<table border="1">';
			echo "<tr>
					<th>排名</th>
					<th>姓名</th>
					<th>手机</th>
					<th>部门</th>
					<th>得分</th>
					<th>耗时(秒)</th>
					<th>结束时间</th>
				  </tr>";	
			$i = 1;
			foreach($result as $u){
				$name = $u['name'];
				$phone = $u['phone'];
				$depart = $u['depart'];
				$score = $u['score'];
				$cost = $u['cost'];
				$endtime = $u['endtime'];
				echo "<tr>
					<td>$i</td>
					<td>$name</td>
					<td>$phone</td>
					<td>$depart</td>
					<td>$score</td>
					<td>$cost</td>
					<td>$endtime</td>
					</tr>";	
				$i++;
			}	
			echo "</table>";
		}
	}

	if(!empty($_SESSION['user'])){
		displayUser();
	}

	if(!empty($_POST)){
		$db = new ExamDB();
		$ainfo = $db->getAdminInfo();
		$user = $_POST['u_name'];
		$pass = $_POST['u_passwd'];
		if(empty($user) || empty($pass) || $user != $ainfo['u_name'] || $pass != $ainfo['u_passwd']){
			echo "<b><font color='red'>用户名或密错误!</font>";
		}else{
			$_SESSION['user'] = $user;
			displayUsers();
		}
	}
?>
</body>
</html>
