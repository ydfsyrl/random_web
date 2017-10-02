<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-Hans" lang="zh-Hans">
<html>
	<head>
		<title>历史成绩</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="mystyle.css" />
	</head>
	<body>


<?php
header('Content-type:text/html;charset = utf-8');
//include_once ('index.html');
session_start();

echo '<p align="right">欢迎你，'.$_SESSION['username'].'。如果不是本人，请<a href = "signout.php">重新登录</a></p><br/>';
echo '<h1 align="center">你的历史成绩</h1>';

$conf = parse_ini_file(__DIR__.'/conf/db.ini');
try {
    $db = new PDO($conf['dsn'], $conf['user'], $conf['password']);
//	echo "OK";
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$sql = 'SELECT history FROM user where username="'.$_SESSION['username'].'";';
//$sql = 'SELECT `id`, `question`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `answer` FROM `TEST` LIMIT 10';

$history = $db->query($sql);
$history->setFetchMode(PDO::FETCH_ASSOC);
$history_arr = $history->fetchAll();

$history_dealed_arr = explode(',', $history_arr[0]['history']);

echo "<div class='teststyle'>";

foreach($history_dealed_arr as $k=>$v)
{
	if($v==null) continue;
	$temp = $k+1;
	echo "<p align='center'>第".$temp."次成绩：".$v;
	echo "</p><br/>";
}
$sum = $_POST['score'];
$arr_to_string = $_POST['arr_to_str'];
echo '<form name="t" method="post" action = "back.php">';
echo '<input type="hidden" name="score" value="'.$sum.'" />';
echo '<input type="hidden" name="arr_to_string" value="'.$arr_to_string.'" />';
echo '<p align="center"><input type = "submit" value = "返回">';
echo '</p></form>';


echo '</div>';

//$try = 90;
//$a = $history_arr[0]['history'].$try.',';

//$sql_update = 'update user set history ="'.$a.'" where username="'.$_SESSION['username'].'";';
//$history_new = $db->query($sql_update);




?>
</body>
</html>