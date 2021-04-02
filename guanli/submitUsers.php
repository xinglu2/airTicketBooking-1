<?php
	header("Content-Type:text/html;charset=utf-8");
  $responseData = array("code" => 0,"message" => "");
  $username = $_POST["username"];
  $password = $_POST["password"];
  $id = $_POST["id"];
  $str = md5(md5($password)."xxx")."yyy";
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

  if(!$id){
    $responseData["code"] = 3;
    $responseData["message"] = "修改的用户不存在";
    echo json_encode($responseData);
    exit;
  }

  //连接数据库
  $link = mysql_connect("127.0.0.1","root","root");
  //判断是否连接成功
  if(!$link){
    $responseData["code"] = 4;
    $responseData["message"] = "数据库连接失败";
    echo json_encode($responseData);
    exit;
  }

  //设置字符集
  mysql_set_charset("utf8");
  //选择数据库
  mysql_select_db("myplane");
  //准备sql语句，验证用户名是否重名
  $sql1 = "SELECT * FROM users WHERE username = '{$username}' AND id!={$id}";
  //拿到sql语句的结果
  $res = mysql_query($sql1);
  //是否能取出一行数据
  $row = mysql_fetch_assoc($res);
  if($row){
    $responseData["code"] = 5;
    $responseData["message"] = "用户名已存在，无法修改";
    echo json_encode($responseData);
    exit;
  }

  $sql2 = "UPDATE users SET username = '{$username}',password = '{$str}' WHERE id = {$id}";
  $res2 = mysql_query($sql2); 
  if($res2){
    $responseData["message"] = "修改成功";
    echo json_encode($responseData);
  }else{
    $responseData["code"] = 6;
    $responseData["message"] = "修改失败，请重试";
    echo json_encode($responseData);
    exit;
  }
  //关闭数据库
  mysql_close($link);
?>