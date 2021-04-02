<?php
	header("Content-Type:text/html;charset=utf-8");
  //同一的返回格式
  $responseData = array("code" => 0,"message" => "");
  $startplace = $_POST['出发地'];
  $overplace = $_POST['目的地'];
  $startday = $_POST['出发日期'];
  $starttime = $_POST['起飞时间'];
  $overtime = $_POST['到达时间'];
  $money = $_POST['票价'];
  $tickettype = $_POST['机票类型'];
  $company = $_POST['所属公司'];
  $code = $_POST['航班号'];
  $other = $_POST['备注'];
  //连接数据库
  $link = mysql_connect("127.0.0.1","root","root");
  //判断是否连接成功
  if(!$link){
  	$responseData['code'] = 1;
  	$responseData['message'] = "数据库连接失败";
  	//将错误返回到前台页面
  	echo json_encode($responseData);
  	exit;
  }
  //设置字符集
  mysql_set_charset("utf8");
  //选择数据库
  mysql_select_db("myplane");
  //准备sql语句进行插入操作
  $sql = "INSERT INTO ticket(出发地,目的地,出发日期,起飞时间,到达时间,票价,机票类型,所属公司,航班号,备注) VALUES('{$startplace}','{$overplace}','{$startday}','{$starttime}','{$overtime}','{$money}','{$tickettype}','{$company}','{$code}','{$other}')";
  //发送SQL语句
  $res = mysql_query($sql);
  if(!$res){
  	$responseData['code'] = 2;
  	$responseData['message'] = "新增航班信息失败";
  	echo json_encode($responseData);
  	exit;
  }else{
  	$responseData['message'] = "添加航班信息成功";
	echo json_encode($responseData);
  }
  mysql_close($link);

?>