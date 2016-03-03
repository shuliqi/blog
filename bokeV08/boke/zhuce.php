
<?php
	header("Content-Type:text/html;charset=utf8");
	if (isset($_POST["sub"]) || $_POST["sub"] == "注册") {
		$user = $_POST["username"];
		$pass = $_POST["password"];
		$psw_confirm = $_POST["confirm"]; 
		if ($user == "" || $pass == "" ||$psw_confirm == "") {
			echo "<script>alert('请填写完信息!')</script>";
		}else{
			if ($pass == $psw_confirm) {
				mysql_connect("localhost","root","");//连接数据库
				mysql_select_db("blog");//查找数据库
				mysql_query("set names 'utf8'");//编辑字符集
				$result = mysql_query("select name from zhuce where name = '$user'");
				$num = mysql_num_rows($result);
				if ($num) {
					echo "<script>alert('用户名已存在!');<script/>";
				}else{
					$insert = mysql_query("insert into zhuce(name,pass) values('$user','$pass')");
					if ($insert) {
						 echo "<script>alert('注册成功！'); history.go(-1);</script>";  
					}else{
						echo "<script>alert('系统繁忙！'); history.go(-1);</script>";  
					}
				}

				
			}else{
				echo "<script>alert('两次输入的密码不一致');</script>";
			}
		}
	}else{
		echo "<script>alert('提交未成功');</script>";
	}
?>