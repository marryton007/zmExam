<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上海大众</title>


</head>


<body bgcolor="#D6D6D6">


<div id="Layer1" style="position:absolute; width:90%; height:90%; z-index:-1">   
<TABLE cellSpacing=0 cellPadding=0 width="100%" height  align="center" border=0>
<tr>
	<td> <img src="http://zmexam.sinaapp.com/exam/start.jpg" alt="" width="100%" align="center"></td>
</tr>
</TABLE>
<p>&nbsp;&nbsp;&nbsp;&nbsp;三十而立，时光荏苒，上海大众经历了三十个岁月。三十年来，从零开始，铸造了一次又一次的辉煌篇章。逢此契机，邀您共同参与大众30年知识竞赛。回顾往昔，共同创造新的美丽篇章。<br /> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="http://zmexam.sinaapp.com/exam/zx2.bmp" alt="" width="100%" height=18%><br /> 
    &nbsp;&nbsp;&nbsp;&nbsp;请点击<a href="http://zmexam.sinaapp.com/exam/exam.php"><strong>阅读原文</strong></a>
    进行答题（共五道题目）并在回答完后输入个人信息，我们将于12月30日截止并于12月31日（下周五）公布获奖名单。我们将为正确率最高，最先完成答题的200名亲们，颁发30周年活动组委会送出的精美奖品。<br /> <br /> 

&nbsp;&nbsp;&nbsp;&nbsp;亲们，速度要快噢！<br /> 
<br />    
<br />
<span style="float:right;">上海大众30周年系列活动组委会</span><br />
<span style="float:right;">2014-12</span><br />   
<?php 
	require 'vendor/autoload.php';
	require 'db.php';
	$db = new ExamDB();
	$cnt = $db->getUserCount();
?>
<span>已有<?php echo $cnt ?>人参与答题!</span>
</p>
</div>
</body>
</html>
