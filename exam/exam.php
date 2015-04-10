<?php
session_start();
// Autoload library with Composer
require 'vendor/autoload.php';
require 'db.php';
// Use library
use Fcosrno\Exam\Exam;
// Create your exam
$exam = '';
if(!empty($_POST)){
	$num_test=6;
	$s = $_SESSION['exam'];
	$exam = unserialize($s);
}else{
	$num_test=1;
	$exam = new Exam();
	$db  = new ExamDB();
	$questions = $db->selRandRows(5, "question");
	//$questions = $db->getAllQuestion();
	foreach($questions as $ques){
		$exam->ask($ques['desc'])->setChoices(explode("###", $ques['choices']))->setAnswer($ques['answer']);
	}
	$s = serialize($exam);
	$_SESSION['exam'] = $s;
}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="base.css" type="text/css">
<title>上海大众汽车30周年知识竞赛</title>
<script language="javascript">
function changeBody(index){
	//alert("xx");
	var id_per = "iDBody";

	for(i=0;i<=7;i++)
	{
		var id=id_per+i.toString();
		if(i==index)
		{
			document.getElementById(id).style.display = "";
		}
		else
		{
			document.getElementById(id).style.display = "none";
		} 
	}
}
var Num_test = <?php echo $num_test; ?>;
function change()
{
	//alert("change num_test"+Num_test);
	Num_test++;
	window.setTimeout("changeBody(Num_test)",500); 
}

function subAndChange(){
	document.getElementById("qus_form").submit();
	Num_test++;
	changeBody(Num_test);
}
function load()
{
	send("starttime.php", "status=start", false);
	changeBody(Num_test);
}

function start(){
	change();
}

function send(url, data, cb){
	var xmlhttp;
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	if(cb){
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			cb(xmlhttp.responseText);
			}
		}
	}
	xmlhttp.open("GET", url+"?"+data, true);
	xmlhttp.send();
}

</script>

<style type="text/css">
</style>
</head>


<body onLoad="load()" >
<div class="box">
<div class="head">
<span>上海大众汽车30周年知识竞赛</span>
<span></span>
<span></span>
</div>


<div id="iDBody0" style="display:none" >
	<p>活动规则</p>
	<button type="button" onClick="start();">开始答题</button>
</div>
<form id="qus_form" action="" method="post"><?php
echo $exam->generateHtml();
?>
<br/>

</form>

<?php
if(!empty($_POST)){
	?>
<h2><font color='red'><strong>答案结果</strong>：</h2>
<?php
		// Grade the exam
		try {
			$myAnswers = array_values($_POST);
			$score = $exam->grade($myAnswers)->asPercentage(); 
			// save score to session.
			$_SESSION['score'] = $score;
			// dispaly right answers.
?>
<div id="iDBody6" style="display:nono">
<?php
			//foreach($exam->getQuestions() as $qu){
			//	echo $qu->getStem() ."  正确答案:  ". $qu->getAnswer()."<br/>";
			//}
			if($score==100)
				echo "<br/>"."恭喜您，全对！" ; 
			if($score==80)
				echo "<br/>"."答对4道,答错1道.";
			if($score==60)
				echo "<br/>"."答对3道,答错2道.";
			if($score==40)
				echo "<br/>"."答对2道,答错3道.";
			if($score==20)
				echo "<br/>"."答对1道,答错4道.";
			if($score==0)
				echo "<br/>"."答对0道,答错5道.";
			//echo "分数".$score;
			//echo "<br/><a href='end.php'>下一步</a>";
			echo '<br/><br/><a href="end.php">';
			echo '<div class="btn2"><input type="button" style="width: 40%; height: 35px; font-size:16px" value="下&nbsp;一&nbsp;步"/></a></div>';
		} catch (Exception $e) {
			echo $e;			
		}
}
?>
</div>
</div>
</body>
</html>
