<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-Hans" lang="zh-Hans">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="mystyle.css" />
        <title>成绩</title>
    </head>
    <body>

<?php
header('Content-type:text/html;charset = utf-8');
//include_once ('index.html');
session_start();
//echo '<a href = "signout.php">登出</a><br/>';
echo '<p align="right">欢迎你，'.$_SESSION['username'].'。如果不是本人，请<a href = "signout.php">重新登录</a></p><br/>';

$sum = 0;
$number = $_POST['counter'];
$one_question_score = 100/$number;
for($i=1;$i<=$number;$i++){
	$t_name = 't'.$i;
	$ans_name = 'ans'.$i;
	if(!empty($_POST[$t_name])){
		if($_POST[$t_name]==$_POST[$ans_name]){
		$sum += $one_question_score;
	}
	}

}

echo '<p align="center"><bigcharacter> 你的分数为：'.$sum.'</bigcharacter></p><br/>';
$str = $_POST['array'];
//echo $str;
//$new_array = unserialize($str);
//$new_array = json_decode($str,true);

// print_r($new_array);

echo '<form name="t" method="post" action = "checkanswer.php">';
echo '<input type="hidden" name="score" value="'.$sum.'" />';
echo '<input type="hidden" name="arr_to_str" value="'.$str.'" />';
echo '<p align="center"><input type = "submit" value = "查看答案"></p>';
echo '</form>';


echo '<form name="t2" method="post" action = "history.php">';
echo '<input type="hidden" name="score" value="'.$sum.'" />';
echo '<input type="hidden" name="arr_to_str" value="'.$str.'" />';
echo '<p align="center"><input type = "submit" value = "查看历史成绩"></p>';
echo '</form>';

echo '<p align="center"><a href = "test.php">重新测试</a><br/></p>';

//$sql = "UPDATE `information`.`user` SET `sorce` = '$t' WHERE `user`.`username` = '".$_COOKIE['user']."';";

//mysql_query($sql);
//$num = mysql_affected_rows();
// if($num>=0)
// {
	// echo "<script>alert('你的分数为：$t');location='index.php';</script>";
// }
// else
// {
	// echo "<script>alert('系统出错！');location='login.php';</script>";
// }
//require_once __DIR__ . '/output.html';


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

$new_history = $history_arr[0]['history'].$sum.',';

$sql_update = 'update user set history ="'.$new_history.'" where username="'.$_SESSION['username'].'";';
$history_new = $db->query($sql_update);



?>
    </body>
</html>
