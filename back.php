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


$sum = $_POST['score'];
$arr_to_string = $_POST['arr_to_string'];

echo '<p align="center"><bigcharacter> 你的分数为：'.$sum.'</bigcharacter></p><br/>';



echo '<form name="t" method="post" action = "checkanswer.php">';
echo '<input type="hidden" name="score" value="'.$sum.'" />';
echo '<input type="hidden" name="arr_to_str" value="'.$arr_to_string.'" />';
echo '<p align="center"><input type = "submit" value = "查看答案"></p>';
echo '</form>';

echo '<form name="t2" method="post" action = "history.php">';
echo '<input type="hidden" name="score" value="'.$sum.'" />';
echo '<input type="hidden" name="arr_to_str" value="'.$arr_to_string.'" />';
echo '<p align="center"><input type = "submit" value = "查看历史成绩"></p>';
echo '</form>';


echo '<p align="center"><a href = "test.php">重新测试</a><br/></p>';

?>
    </body>
</html>