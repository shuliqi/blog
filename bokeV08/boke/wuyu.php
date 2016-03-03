<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/zuce.css"/>
	</head>
	<body>
	   <div class="box" id="lina">
			<div class="mask_header">
				<div id="guanbi"></div>
				<div class="kuai">
					<span>登录</span>
				</div>
			</div>
			<div class="mask_body_sigin">
				<form action="denglu.php" method="post" id="form" enctype="multipart/form-data">
					<ul>
						<li>
							<label>你的名字：</label>
							<input type="text"name="name" placeholder="名字"><img src="images/xinhao.png">
							<p>请输入用户名</p>
							<p>0个字符</p>
						</li>
						<li>
							<label>登录密码：</label>
							<input type="password"name="password" placeholder="密码"><img src="images/xinhao.png">
							<p></p>
						</li>
						<li>
							<label class="again">验证码：</label>
							<input class="check" type="text" name="check" placeholder="验证码">
							<img src="images/bg84.png"><a href="#" title="重新获取验证码"><a href="#">重新获取</a></a><img src="images/xinhao.png">
						</li>
						<li>
							<input class="submit"type="submit" name="submit" value="登陆">
						</li>
					</ul>
				</form>
			</div>
	    </div>
	</body>
</html>
