<?php
  header("Content-Type:text/html;charset=utf-8");
  //统一的返回格式
  $responseData = array("code" => 0,"message" => "");
  //删除的数据
  $id = $_GET["id"];
  $link = mysql_connect("127.0.0.1","root","root");
	if(!$link){
		$responseData['code'] = 1;
		$responseData['message'] = "数据库连接失败";
		//将错误返回到前台页面
		echo json_encode($responseData);
		exit;
	}
	//设置字符集
	mysql_set_charset("utf8");
	// 选择数据库
	mysql_select_db("myplane");
	// 准备sql语句进行删除操作
  $sql = "DELETE FROM users WHERE id = {$id}";
	//发送sql语句
	$res = mysql_query($sql);
	// var_dump($res);
	if(!$res){
		$responseData['code'] = 2;
		$responseData['message'] = "删除用户数据失败";
		//将错误返回到前台页面
		echo json_encode($responseData);
	}else{
		$responseData['message'] = "删除用户数据成功";
		echo json_encode($responseData);
	}
	mysql_close($link);
?>