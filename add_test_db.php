<?php
$conf = parse_ini_file(__DIR__.'/conf/db.ini');
// $dsn = 'mysql:host=localhost; dbname=reader;charset=utf8';
// $user = 'root';
// $password = '12345';
try {
    $db = new PDO($conf['dsn'], $conf['user'], $conf['password']);
	echo "OK".'<br>';

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

//$sql = 'SELECT `id`, `question`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `answer` FROM `TEST` LIMIT 10';

$idarr =array("11","12","13","14","15","16","17","18","19","20"); 
$questionarr =array("吉林省抚松县被人们称为是哪种药材之乡?","“山城”是我国哪座城市的雅号?","世界石油储量最多是哪一个国家?","下列著名宫殿哪个位于英国?","下列我国哪个古迹被誉为“世界八大奇迹”:","我国古代项羽“破釜沉舟”战胜秦军是在哪次战役?","史书《汉书》是哪位史学家所著?","下列我国军事家中哪位不是“十大元帅”之一?","比喻变被动为主动是“三十六计”中的哪一计?","洲际导弹的射程一般在多少公里以上?"); 
$choiceAarr =array("当归","洛阳","伊拉克","故宫","万里长城","牧野之战","司马迁","叶剑英","声东击西","一百"); 
$choiceBarr =array("枸杞","西安","伊朗","凡尔赛宫","乐山大佛","巨鹿之战","司马光","林彪","李代桃僵","一千"); 
$choiceCarr =array("人参","重庆","科威特","白金汉宫","秦始皇兵马俑","官渡之战","左丘明","罗荣桓","欲擒故纵","一万"); 
$choiceDarr =array("田七","福州","沙特阿拉伯","克里姆林宫","敦煌莫高窟","淝水之战","班固","邓小平","反客为主","十万"); 
$answerarr =array("C","C","D","C","C","B","D","D","D","C");

foreach($idarr as $k=>$v){
	$id = $v;
	$question = $questionarr[$k];
	$choiceA = $choiceAarr[$k];
	$choiceB = $choiceBarr[$k];
	$choiceC = $choiceCarr[$k];
	$choiceD = $choiceDarr[$k];
	$answer = $answerarr[$k];
	$sql = 'INSERT INTO test VALUES (' . '\''. $id. '\',\'' .$question. '\',\'' .$choiceA. '\',\'' . $choiceB. '\',\'' . $choiceC. '\',\'' . $choiceD. '\',\'' .$answer . '\');';

	$db->exec($sql);
	echo $sql."新记录插入成功".'<br>';	
}

	
$db = null;

