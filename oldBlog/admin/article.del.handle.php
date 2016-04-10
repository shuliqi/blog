<?php
require_once('connect.php');
session_start();
if (isset($_SESSION['user'])) {
	$id = $_POST['id'];
  	$type= $_POST['type'];
  	if ($type = "canli") {
	  $delete = "delete from anli where id=$id";
	  if (mysql_query($delete)) {
	  	echo "<script>alert('删除web文章成功');window.location.href='index.php';</script>";
	  } else {
	  	echo "<script>alert('删除web文章失败');window.location.href='index.php';</script>";
	  }
   	} if ($type = "jishu") {
	  $delete = "delete from jishu where id=$id";
	  if (mysql_query($delete)) {
	  	echo "<script>alert('删除tech文章成功');window.location.href='index.php';</script>";
	  } else {
	  	echo "<script>alert('删除tech文章失败');window.location.href='index.php';</script>";
	  }
  	} if($type = "web"){
  	  $delete = "delete from web where id=$id";
	  if (mysql_query($delete)) {
	  	echo "<script>alert('删除案例文章成功');window.location.href='index.php';</script>";
	  } else {
	  	echo "<script>alert('删除案例文章失败');window.location.href='index.php';</script>";
	  }
  	}else{
  		echo "<script>alert('出现错误');window.location.href='index.php';</script";
  	}
	
}else{
	  echo "无法删除";
	  echo "<div id='check'>";
      echo "你没有权限删除文章，点击下方的链接进行验证<br>";
      echo "<a class='again'href='index.php'>点击验证</a>";
      echo "</div>";
}

  
  
?>
