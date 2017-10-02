<!doctype html>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-Hans" lang="zh-Hans">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" type="text/css" href="mystyle.css" />
	</head>
	<div class='ex'>

	<?php
		session_start();
		if(isset($_SESSION['userid'])) {
			session_destroy();
			echo '<p align="center">退出成功</p>';
		} else {
			echo '<p align="center">还没登录<br/></p>';
		}
		echo "<br/><br/>";
		echo "<p align='center'><a href='index.php'>登录</a></p>";
	?>
	</div>
</html>