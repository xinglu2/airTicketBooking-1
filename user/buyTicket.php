<?php
  header("Content-Type:text/html;charset=utf-8");
  //统一的返回格式
  $responseData = array("code" => 0,"message" => "");
  //删除的数据
  $ID = $_GET["ID"];
  if(!$ID){
  	$responseData["code"] = 1;
  	$responseData["msssage"] = "没有要购买票的信息";
  	echo json_encode("$responseData");
  	exit;
  }
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
  	$sql = "SELECT * FROM ticket WHERE ID = {$ID}";
	//发送sql语句
	$res = mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	// var_dump($res);
	if(!$row){
		$responseData['code'] = 3;
		$responseData['message'] = "所选票的数据不存在";
		//将错误返回到前台页面
		echo json_encode($responseData);
	}else{
		$responseData['message'] = json_encode($row);
		echo json_encode($responseData);
	}
	mysql_close($link);
?>