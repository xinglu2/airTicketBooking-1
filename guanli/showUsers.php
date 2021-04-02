<?php
	header("Content-Type:text/html;charset=utf-8");
  $link = mysql_connect("127.0.0.1","root","root");
  if(!$link){
    echo "数据库链接失败";
    exit;
  }
  mysql_set_charset("utf8");
  mysql_select_db("myplane");
  $sql = "SELECT * FROM users";
  $res = mysql_query($sql);
  $arr = array();
  while($row = mysql_fetch_assoc($res)){
    array_push($arr,$row);
  }
  echo json_encode($arr);
  mysql_close($link);
?>