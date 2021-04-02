<?php
	header("Content-Type:text/html;charset=utf-8");
	$responseData = array("code" => 0,"message" => "");
  $username = $_POST["username"];
  $password = $_POST["password"];
  // 简单的验证
  if(!$username){
    $responseData["code"] = 1;
    $responseData["message"] = "用户名不能为空";
    echo json_encode($responseData);
    exit;
  }
  if(!$password){
    $responseData["code"] = 2;
    $responseData["message"] = "密码不能为空";
    echo json_encode($responseData);
    exit;
  }
    //连接数据库
  $link = mysql_connect("127.0.0.1","root","root");
  //判断是否连接成功
  if(!$link){
    $responseData["code"] = 3;
    $responseData["message"] = "数据库连接失败";
    echo json_encode($responseData);
    exit;
  }

  //设置字符集
  mysql_set_charset("utf8");
  //选择数据库
  mysql_select_db("myplane");
  //md5加密
  $str = md5(md5($password)."xxx")."yyy";
  //登陆,准备sql语句
  $sql = "SELECT * FROM guanliusers WHERE username='{$username}' AND password='{$str}'";
  $res = mysql_query($sql);
  //取出第一行数据
  $row = mysql_fetch_assoc($res);
  if(!$row){
    // echo "链接失败";
    $responseData["code"] = 4;
    $responseData["message"] = "用户名或密码错误";
    echo json_encode($responseData);
    exit;
  }else{
    $responseData["message"] = "登陆成功";
    echo json_encode($responseData);
  }
  mysql_close($link);
?>