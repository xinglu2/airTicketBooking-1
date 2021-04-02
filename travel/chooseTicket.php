<?php
  header("Content-Type:text/html;charset=utf-8");
  //统一的返回格式
  $responseData = array("code" => 0,"message" => "");
  $startplace = $_POST['出发地'];
  $overplace = $_POST['目的地'];
  $startday = $_POST['出发日期'];
  $tickettype = $_POST['机票类型'];
  // echo "<script>alert($startplace);</script>";
  // echo "<script>alert($overplace);</script>";
  // echo "<script>alert($startday);</script>";
  // echo "<script>alert($tickettype);</script>";
  // if(!$startplace){
  // 	$responseData["code"] = 1;
  // 	$responseData["msssage"] = "出发地不能为空";
  // 	echo json_encode("$responseData");
  // 	exit;
  // }
  // if(!$overplace){
  // 	$responseData["code"] = 2;
  // 	$responseData["msssage"] = "目的地不能为空";
  // 	echo json_encode("$responseData");
  // 	exit;
  // }
  // if(!$startday){
  // 	$responseData["code"] = 3;
  // 	$responseData["msssage"] = "出发日期不能为空";
  // 	echo json_encode("$responseData");
  // 	exit;
  // }
  // if(!$startday){
  // 	$responseData["code"] = 4;
  // 	$responseData["msssage"] = "机票类型不能为空";
  // 	echo json_encode("$responseData");
  // 	exit;
  // }
  $link = mysql_connect("127.0.0.1","root","root");
	if(!$link){
		$responseData['code'] = 5;
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
  	$sql = "INSERT INTO ticket1 (SELECT * FROM ticket WHERE 出发地 = '{$startplace}' AND 目的地 = '{$overplace}' AND 出发日期 = '{$startday}' AND 机票类型 = '{$tickettype}')";
	//发送sql语句
  $res = mysql_query($sql);
  $row = mysql_fetch_assoc($res);
  // var_dump($res);
	if(!$row){
		$responseData['code'] = 6;
		$responseData['message'] = "所选机票的类型不存在";
		//将错误返回到前台页面
		echo json_encode($responseData);
	}else{
		$responseData['message'] = json_encode($row);
		echo json_encode($responseData);
	}
	mysql_close($link);
?>