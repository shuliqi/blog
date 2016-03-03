<!DOCTYPE html>
<html>
	<head>
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/zuce.css">
	</head>
	<body>
		<div class="box">
			<div class="mask_header">
				<div id="close"></div>
				<div class="kuai">
					<span>注册</span>
				</div>
			</div>
			<div class="mask_body" id="mmmm">
				<form action="zhuce.php" method="post" enctype="multipart/form-data" >
					<ul>
						<li>
							<label>你的名字：</label>
							<input type="text"name="username" placeholder="名字"><img src="images/xinhao.png">
							<p></p>
							<p>0个字符</p>
						</li>
						<li>
							<label>登录密码：</label>
							<input type="password"name="password" placeholder="密码"><img src="images/xinhao.png">
							<p></p>
							<p><em>弱</em><em>中</em><em>强</em></p>
						</li>
						<li>
							<label>确认密码：</label>
							<input type="password"name="confirm" placeholder="确认密码" disabled=""><img src="images/xinhao.png">
							<p>5-25个字符，一般一个汉字为两个字符</p>
						</li>
						<li>
							<label class="again">验证码：</label>
							<input class="check"type="text"  name="check"placeholder="验证码">
							<img src="images/bg84.png"><a href="#" title="重新获取验证码"><a href="#">重新获取</a></a><img src="images/xinhao.png">
						</li>
						<li>
							<input class="submit"type="submit" name="sub"  value="注册">
						</li>
					</ul>
				</form>
			</div>
		</div>
	</body>
</html>
