<?php

// 网站计数器（图片数字方式）

session_start();

define('MAX_DIGITS', 10);

$num = file_get_contents('count.txt');
$len = strlen($num);
$fillLen = MAX_DIGITS - $len;

// 前面填充的 0
for($i = 0; $i < $fillLen; ++$i){
	echo "<img src='img/0.gif' />\n";
}

// 输出后续的数字
for($i = 0; $i < $len; ++$i){
	echo "<img src='img/". $num[$i] .".gif' />\n";
}

// session 变量为空时，才会增加访问量，避免用户刷新。每次访问增加一次访问量
if(is_null($_SESSION['visit'])){

	if(!($fp = fopen('count.txt', 'r'))){
		exit('打开文件失败!');
	} 

	$count = fgets($fp, 200);
	fclose($fp);

	// 为空时置0
	$count = $count ?: 0;
	++$count;

	$fp = fopen('count.txt', 'w');
	fputs($fp, $count);
	fclose($fp);

	$_SESSION['visit'] = true;

}