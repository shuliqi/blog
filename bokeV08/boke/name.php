<?php
	header("Content-Type:text/html;charset=utf8");
	mysql_connect("localhost","root","");//连接数据库
	mysql_select_db("zhuce");//查找数据库
	mysql_query("set names 'utf8'");//编辑字符集
	$number = $_GET["number"];
	$result = mysql_query("select name from zhuce where name = '$number'");
	$num = mysql_num_rows($result);
	if ($num) {
			echo "<script>alert('用户名已存在!');<script/>"; 
	}
 ?>