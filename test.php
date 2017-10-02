<?php

// $dsn = 'mysql:host=localhost; dbname=reader;charset=utf8';
// $user = 'root';
// $password = '12345';

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

$exam_question_num = 5;

$random_keys=array_rand($test,$exam_question_num);
shuffle($random_keys);
//print_r($random_keys);
$db = array();
$temp_db = array();
foreach($random_keys as $k=>$v){
	$temp_db[] = $test[$v];
}
$db['test'] = $temp_db;

require_once __DIR__ . '/test.html';
