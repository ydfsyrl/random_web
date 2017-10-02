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
	
	<?php
		session_start();
		$conf = parse_ini_file(__DIR__.'/conf/db.ini');
		
		$flag = 0;

		if(isset($_POST['username'])&&(isset($_POST['password']))) {
			try {
				$db = new PDO($conf['dsn'], $conf['user'], $conf['password']);
			//	echo "OK";
				$password = $_POST['password'];
				$username = $_POST['username'];
				
				$query = "SELECT id, username from user WHERE username = '".$username."' AND password ='".$password."'";
				$result = $db->query($query);
					$result->setFetchMode(PDO::FETCH_ASSOC);
					$row = $result->fetch();
					
					
				if(!empty($row)) {
				//	echo "result";
				//	echo $result->fetchColumn();
				//	echo $result;
				//	print_r($result->fetchColumn());	
					


					$_SESSION['userid'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$result = null;
				//	echo '<p align="right">欢迎你，'.$_SESSION['username'].'。如果不是本人，请<a href = "signout.php">重新登录</a><br/>';

				} else {
					$flag = 1;
					// echo "密码或者用户名错误";

				}
				
				$db = null;			
			
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
				exit;	
			}			
			} 		
		
		
		if(isset($_SESSION['userid'])) {
			require_once('test.php');
		} else {
			
			echo "<body><form action='index.php' method='post'>";
			
			echo "<div class='ex'>";
			echo "<h2>欢迎登录</h2>";
			echo "<label><span>用户名  </span><input type='text' name='username'/></label>";
			echo "<br/><br/>";
			echo "<label><span>密码    </span><input type='password' name='password'/></label>";
			echo "<br/>";
			if($flag==1){
				echo "<span1>密码或者用户名错误</span1>";
			}			
			echo "<br/><br/>";
			echo "<input type='submit' value='登录'/>";
			echo "<br/><br/>";
			echo "</form>";
			echo "<a href='signup.php'>注册账号</a>";	
			echo "</div></body>";

			
		}

	?>

	
</html>