<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-Hans" lang="zh-Hans">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="mystyle.css" />
        <title>参考答案</title>
    </head>
    <body>

<?php
header('Content-type:text/html;charset = utf-8');
//include_once ('index.html');

session_start();
//echo '<a href = "signout.php">登出</a><br/>';
//echo '<br/><a href = "back.php">返回</a><br/>';

echo '<p align="right">欢迎你，'.$_SESSION['username'].'。如果不是本人，请<a href = "signout.php">重新登录</a></p><br/>';
echo "<h1 align='center'>参考答案</h1>";

$arr_to_string = $_POST['arr_to_str'];
$randow_array_key = unserialize($arr_to_string);




$conf = parse_ini_file(__DIR__.'/conf/db.ini');
try {
    $db = new PDO($conf['dsn'], $conf['user'], $conf['password']);
//	echo "OK";
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$sql = 'SELECT `id`, `question`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `answer` FROM `TEST` LIMIT 20';

$stmt = $db->query($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$test = $stmt->fetchAll();

$temp_db = array();

foreach($randow_array_key as $k=>$v){
	$temp_db[] = $test[$v];
}
 
$count = 0;
echo '<div class="teststyle">';
foreach($temp_db as $k=>$v){
	$count += 1;
	echo '<p>'.$count.'、'.$v['question']."&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
	$answer_choice = 'choice'.$v['answer'];
	
	echo '<br/>'.$v['answer'].'、'.$v[$answer_choice].'</p>';
	
}
$sum = $_POST['score'];
echo '<form name="t" method="post" action = "back.php">';
echo '<input type="hidden" name="score" value="'.$sum.'" />';
echo '<input type="hidden" name="arr_to_string" value="'.$arr_to_string.'" />';
echo '<input type = "submit" value = "返回">';
echo '</form>';
echo '</div>';
// echo '<form name="t" method="post" action = "checkanswer.php">';
// echo '<input type="hidden" name="new_array" value="'.$new_array.'" />';
// echo '<input type = "submit" value = "查看答案">';
// echo '</form>';

?>
    </body>
</html>