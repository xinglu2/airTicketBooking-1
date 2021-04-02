<?php
	header("Content-Type:text/html;charset=utf-8");
	//1.连接数据库
	$link = mysql_connect("127.0.0.1","root","root");
	//2.判断是否连接成功
	if(!$link){
		echo "数据库连接失败";
		exit;
	}
	//3.设置字符集
	mysql_query("set names 'utf8' "); 
    mysql_query("set character_set_client=utf8"); 
    mysql_query("set character_set_results=utf8");

	// 4.选择数据库
	mysql_select_db("myplane");
	// 5.准备sql语句
	$sql = "SELECT * FROM ticket";
	//6.发送sql语句
	$res = mysql_query($sql);
	$arr = array();
	//7.处理结果
	while($row = mysql_fetch_assoc($res)){
		array_push($arr,$row);
	}
	// json_encode() 将数据结构转成字符串
    // json_decode() 将字符串转成数据结构
    echo json_encode($arr);
    // 8.关闭数据库
    mysql_close($link);
?>