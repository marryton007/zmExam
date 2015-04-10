<?php
	session_start();
?>

<html>
<head></head>
<body>
<?php
	if(!empty($_GET)){
		$sts = $_GET['status'];
		if($sts === "start"){
			$now = date('Y-m-d H:i:s');
			$_SESSION['starttime'] = $now;
		}
	}
?>
</body>
</html>
