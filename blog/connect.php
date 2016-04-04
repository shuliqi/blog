
<?php
   header("Content-Type: application/json;charset = utf-8");
  require_once('config.php');
  //连库
  if($con = mysql_connect(HOST,USERNAME,PASSWORD)){
  }else{
  	echo mysql_error();
  
  }
  //选库
  if (mysql_select_db("db144240081000")) {
  } else {
  	echo mysql_error();
  }
  //字符集
  mysql_query("set names utf8");
?>