<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="mystyle.css" />
		<meta CHARSET='utf-8'>
		<title>注册账号</title>
	</head>
	<body>
	
	<?php
		session_start();
		if(isset($_SESSION['userid'])) {
			require_once('test.php');
		} else {
			if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password-confirm'])){
				if($_POST['password'] == $_POST['password-confirm']) {
					$conf = parse_ini_file(__DIR__.'/conf/db.ini');
					try {
						$db = new PDO($conf['dsn'], $conf['user'], $conf['password']);
					//	echo "OK";

						$username = $_POST['username'];
						$password = $_POST['password'];
						$query = "INSERT INTO user VALUES(NULL,'".$username."', '".$password."', null)";
						$result = $db->query($query);
						
				$query2 = "SELECT id, username from user WHERE username = '".$username."' AND password ='".$password."'";
				$result2 = $db->query($query2);						
						$result2->setFetchMode(PDO::FETCH_ASSOC);
						$row = $result2->fetch();	
						if(!empty($row)) {

							$_SESSION['userid'] = $row['id'];
							$_SESSION['username'] = $row['username'];
							require_once('test.php');
						} else {
							echo "登录失败";
						}						
						// if($result) {
							// $_SESSION['userid'] = $db->insert_id; 
							// require_once('test.php');
						// } else {
							// echo "登录未成功";
						// }
						$db = null;					
					} catch (PDOException $e) {
						echo 'Connection failed: ' . $e->getMessage();
						exit;	
					}	
					 
				} else {
					echo "<div class='ex'>";
					echo "<h1 align='center'>注册账号</h1>";
					
					echo "<form action='signup.php' method='post'>";
					echo "<label><span>用户名</span><input type='text' name='username'/></label><br>";
					echo "<br/>";
					echo "<label><span>密码</span><input type='password' name='password'/></label><br>";
					echo "<br/>";
					echo "<label><span>确认密码</span><input type='password' name='password-confirm'/></label><br>";
					echo "<br/>";
					echo "<span1>确认密码不正确</span1><br/>";
					echo "<input type='submit' value='注册'/>";
					echo "</form>";
					echo "<br/>";					
					echo "<a href='index.php'>已有账号</a>";
					echo "</div>";
				}
			} else {
				echo "<div class='ex'>";
				echo "<h1 align='center'>注册账号</h1>";
				echo "<form action='signup.php' method='post'>";
				echo "<label><span>用户名</span><input type='text' name='username'/></label><br>";
				echo "<br/>";
				echo "<label><span>密码</span><input type='password' name='password'/></label><br>";
				echo "<br/>";
				echo "<label><span>确认密码</span><input type='password' name='password-confirm'/></label><br>";
				echo "<br/>";
				echo "<input type='submit' value='注册'/>";
				echo "</form>";
				echo "<br/>";
				echo "<a href='index.php'>已有账号</a>";
				echo "</div>";
			}			
		}

	?>
</body>
</html>