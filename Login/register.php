<?php
	header("Content-Type:text/html;charset=utf-8");
  $responseData = array("code" => 0,"message" => "");
  $username = $_POST["username"];
  $sex = $_POST["sex"];
  $number = $_POST["number"];
  $worksp = $_POST["worksp"];
  $password = $_POST["password"];
  $addTime = $_POST["addTime"];
  //简单的验证
  if(!$username){
    $responseData["code"] = 1;
    $responseData["message"] = "用户名不能为空";
    echo json_encode($responseData);
    exit;
  }
  if(!$number){
    $responseData["code"] = 6;
    $responseData["message"] = "身份证号不能为空";
    echo json_encode($responseData);
    exit;
  }
  if(!$worksp){
    $responseData["code"] = 7;
    $responseData["message"] = "工作单位不能为空";
    echo json_encode($responseData);
    exit;
  }
  if(strlen($number)!=18){
    $responseData["code"] = 7;
    $responseData["message"] = "请输入正确的18位身份证号";
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
  if(!$link){
    $responseData["code"] = 3;
    $responseData["message"] = "数据库链接失败";
    echo json_encode($responseData);
    exit;
  }
  mysql_set_charset("utf8");
  mysql_select_db("myplane");
  $sql1 = "SELECT * FROM users WHERE username = '{$username}'";
  $res = mysql_query($sql1);
  $row = mysql_fetch_assoc($res);
  if($row){
    $responseData["code"] = 4;
    $responseData["message"] = "该用户已存在";
    echo json_encode($responseData);
    exit;
  }
  //md5加密
  $str = md5(md5($password)."xxx")."yyy";
  $sql2 = "INSERT INTO users(username,sex,number,worksp,password,create_time) VALUES('{$username}','{$sex}','{$number}','{$worksp}','{$str}','{$addTime}')";
  $res = mysql_query($sql2);
  if(!$res){
    $responseData["code"] = 5;
    $responseData["message"] = "注册失败";
    echo json_encode($responseData);
    exit;
  }else{
    $responseData["message"] = "注册成功";
    echo json_encode($responseData);
  }
  mysql_close($link);
?>