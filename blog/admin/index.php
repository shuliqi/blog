<?php
	require_once('connect.php');
	// 开始会话
	session_start();
	// 注册会话
	if (isset($_POST['user']) && isset($_POST['pass'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$sql = "select * from login where user = '$user' and pass = '$pass' ";
		$result = mysql_query($sql);
		if (mysql_num_rows($result)) {
			$_SESSION['user']  = $user;
			echo "保存成功";
	        echo $_SESSION['user'];
		}

	}
?>
<?php
    require_once('connect.php');
 	$data = page("web");
 	$web_banner = $data['banner'];
 	$webdata = $data['data'];

    $data = page("jishu");
 	$jishu_banner = $data['banner'];
 	$jishudata = $data['data'];

    $data = page("anli");
 	$anli_banner = $data['banner'];
 	$anlidata = $data['data'];
function page($type){
	 	/** 传入页码 **/
	 if (isset($_GET['p1'])) {
	 	$p1 =  intval($_GET['p1']);
	 }else{
	 	$p1 = 1;
	 }
	 // 查询的起始位置
	 $position1 = ($p1-1)*3;
	 // 每页显示的条数
	 $pagesize1 = 3;
	 /**根据页码取出数据：php mysql处理**/
	// 编写sql获取分页数据 "select form 表名 limit".起始位置，显示的条数
	 $sql1 = "select * from $type limit $position1, $pagesize1";
	 $webresult = mysql_query($sql1);
	 if ($webresult && mysql_num_rows($webresult)) {
	 	while ($webrow = mysql_fetch_assoc($webresult)) {
	 		$data[] = $webrow;
	 	}
	 } else {
	 	    $data = array();
	 }
	 /**获取数据总数 计算总页数**/
	 $total_sql1 = "select count(*) from $type";
	 $total_result1 = mysql_fetch_array( mysql_query($total_sql1));
	 $total1 =  $total_result1[0];
	 // 总页数
	 $total_pages1 =  ceil($total1/$pagesize1);
	 /** 显示页码 **/
	 // 显示页码数
	 $showpage1 = 5;
	 // 计算偏移量 就是当前页前面有多少页 后面有多少页
	 $pageoffet1 = ($showpage1 -1)/2;
	// 初始化数据
	 $start1 =1;
	 $end1 = $total_pages1;
	 /**显示数据 + 分页条**/
	 $page_banner1 = "";
	 if ($p1 >1) {
	 	 $page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1=1'>首页</a>";
	 	 $page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1=".($p1-1)."'><上一页</a>";
	 }else{
	 	 $page_banner1 .= "<a class='disable'>首页</a>";
	 	 $page_banner1 .= "<a class='disable'><上一页</a>";
	 }
	/**显示页码**/
	// 总页数大于我们要显示的页数
	if ($total_pages1 > $showpage1 ) {
		// 当前页大于偏移量+1 也就是当前页 大于 3 就出现省略号
		if ($p1 >  $pageoffet1 + 1) {
			 $page_banner1 .= "<a class='sheng'>...</a>";
		}
		// 当前页大于偏移量
		if ($p1 > $pageoffet1) {
			$start1 =  $p1 - $pageoffet1;
			$end1 = $total_pages1 > $p1 + $pageoffet1 ? $p1 + $pageoffet1:$total_pages1;
		}else{
			$start1 =  1;
			$end1 = $total_pages1 > $showpage1 ? $showpage1:$total_pages1;
		}
		if ($p1 + $pageoffet1 > $total_pages1) {
			$start1 =  $start1 - ($p1 + $pageoffet1 - $end1);
		}
	}
	// 显示页码
	for ($i=$start1; $i <= $end1; $i++) {
		if ($p1 == $i) {
		 	$page_banner1 .= "<a class='current'>{$i}</a>";
		 }else{
		 	$page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1=".$i."'>{$i}</a>";
		 }
	}
	// 尾部省略
	if ($total_pages1 > $showpage1 && $total_pages1 > $p1 + $pageoffet1) {
		 $page_banner1 .= "<a class='sheng'>...</a>";
	}
	if ($p1 < $total_pages1) {
	 	$page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1=".($p1+1)."'>下一页></a>";
	 	$page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1= $total_pages1 '>尾页</a>";
	}else{
		$page_banner1 .= "<a class='disable'>下一页></a>";
	 	$page_banner1 .= "<a class='disable'>尾页</a>";
	}
	$page_banner1 .="<a>共".$total_pages1."页</a>";
	$page_banner1.="<form action='index.php' method='get'>";
	$page_banner1.="到<input type='text' size='2' class='text'  name='p1'>页";
	$page_banner1.="<input type='submit' class='text'value='确定'>";
	$page_banner1.="</form>";
	$arry = array('banner' =>$page_banner1,'data' =>$data);
	return $arry;
 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>舒丽琦的博客后台</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/index.js"></script>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
    <?php
    	if (isset($_SESSION['user'])) {
        ?>
			<div class="all">
				<header>
					<nav>
						<ul id="ul">
							<li>前端</li>
							<li>技术</li>
							<li>案例</li>
							<a class="out"href="logout.php">退出</a>
						</ul>

					</nav>
				</header>
				<section id="web">
					<div class="top">
						<p id="webcon">前端文章</p>
						<span id="webbtn">添加文章</span>
					</div>
					<ul id="ul1">
					    <li class="border">
					        <span class="big">文章编号</span>
					        <span class="middle">文章标题</span>
					        <span class="right">文章操作</span>
					    </li>
						<?php 
							if (empty($webdata)) {
								echo "当前没有文章";
							} else {
								foreach ($webdata as $key => $value) {	
						 ?>
						<li>
							<span class="big"><?php echo $value['id'];?></p></span>
							<span class="middle1"><?php echo $value['title'];?></span>
							<div onclick = "del(<?php echo $value['id'];?>,<?php echo $value['type'];?>)">删除</div>
							<a href="article.modify.php?type=<?php echo $value['type'];?>&id=<?php echo $value['id']?>">修改</a>
						<?php
					            }
					      }
						?>
					</ul>
					<div class="page" id="page1"><?php echo $web_banner;?></div>
					<div id="webtian">
						<div class="content">
							<form action="article.add.handle.php" method="post" enctype="multipart/form-data" >
							    <input type="hidden" name="key" value="web" />
								<input id ="title" name="title" placeholder="文章的标题" />
								<input id ="author" name="author" placeholder="文章的作者" />
								<input id ="tips" name="tips" placeholder="文章的概要" />
								<div class="pic">
									<label>图片：</label>
									<input  type="file" id="mypic" name="mypic" />
								</div>
								<textarea id="febweb" type="text/plain" name="content"style="height:500px;"></textarea>
								<div class="sub">
									<input  id="tijiao"class="submit submit1" type="submit" name="sub" value="提交">
									<input  id="chongzhi"class="submit submit2" type="submit" name="ok" value="重置">
							    </div>
							 </form>
						</div>
					</div>
				</section>
				<section id="jishu">
					<div class="top">
						<p id="jishucon">技术文章</p>
						<span id="jishubtn">添加文章</span>
					</div>
					<ul id="ul2">
					    <li class="border">
					        <span class="big">文章编号</span>
					        <span class="middle">文章标题</span>
					        <span class="right">文章操作</span>
					    </li>
						<?php 
							if (empty($jishudata)) {
								echo "当前没有文章";
							} else {
								foreach ($jishudata as $key => $value) {	
						 ?>
						<li>
							<span class="big"><?php echo $value['id'];?></p></span>
							<span class="middle1"><?php echo $value['title'];?></span>
							<div onclick = "del(<?php echo $value['id'];?>,<?php echo $value['type'];?>)">删除</div>
							<a href="article.modify.php?type=<?php echo $value['type'];?>&id=<?php echo $value['id']?>">修改</a>
						<?php
					            }
					      }
						?>
					</ul>
					<div class="page" id="page2"><?php echo $jishu_banner;?></div>
					<div id="jishutian">
						<div class="content">
							<form action="article.add.handle.php" method="post" enctype="multipart/form-data" >
							    <input type="hidden" name="key" value="jishu" />
								<input id ="title" name="title" placeholder="文章的标题" />
								<input id ="author" name="author" placeholder="文章的作者" />
								<input id ="tips" name="tips" placeholder="文章的概要" />
								<div class="pic">
									<label>图片：</label>
									<input  type="file" id="mypic" name="mypic" />
								</div>
							   <textarea id="techo" type="text/plain" name="content"style="height:500px;"></textarea>
								<div class="sub">
									<input  id="tijiao"class="submit submit1" type="submit" name="sub" value="提交">
									<input  id="chongzhi"class="submit submit2" type="submit" name="ok" value="重置">
							    </div>
							 </form>
						</div>
					</div>
				</section>
				<section id="anli">
					<div class="top">
						<p id="casecon">案例文章</p>
						<span id="casebtn">添加文章</span>
					</div>
					<ul id="ul3">
					    <li class="border">
					        <span class="big">文章编号</span>
					        <span class="middle">文章标题</span>
					        <span class="right">文章操作</span>
					    </li>
						<?php 
							if (empty($anlidata)) {
								echo "当前没有文章";
							} else {
								foreach ($anlidata as $key => $value) {	
						 ?>
						<li>
							<span class="big"><?php echo $value['id'];?></p></span>
							<span class="middle1"><?php echo $value['title'];?></span>
							<div onclick = "del(<?php echo $value['id'];?>,<?php echo $value['type'];?>)">删除</div>
							<a href="article.modify.php?type=<?php echo $value['type'];?>&id=<?php echo $value['id']?>">修改</a>
						<?php
					            }
					      }
						?>
					</ul>
					<div class="page" id="page3"><?php echo $anli_banner;?></div>
					<div id="casetian">
						<div class="content">
							<form action="article.add.handle.php" method="post" enctype="multipart/form-data" >
								<input type="hidden" name="key" value="anli" />
								<input id ="title" name="title" placeholder="文章的标题" />
								<input id ="author" name="author" placeholder="文章的作者" />
								<input id ="tips" name="tips" placeholder="文章的概要" />
								<div class="pic">
									<label>图片：</label>
									<input  type="file" id="mypic" name="mypic" />
								</div>
								<textarea id="case" type="text/plain" name="content"style="height:500px;"></textarea>
								<div class="sub">
									<input  id="tijiao"class="submit submit1" type="submit" name="sub" value="提交">
									<input  id="chongzhi"class="submit submit2" type="submit" name="ok" value="重置">
							    </div>
							 </form>
						</div>
					</div>
				</section>
			</div>
        <?php
    	}else{
    		if (isset($user)) {
    			echo "<div class='check'>您的身份验证失败，无法进入后台</div>";
    		}else{
    			echo "<div class='check'>请您进行身份验证</div>";
    		}
    		?>
    		<div class="from">
	    		<form method="post" action="index.php">
	    			用户名：<br>
	    			<input type="text" name="user"><br>
	    			 密码：<br>
	    			 <input class="pass"type="password" name="pass"><br>
	    			<input type="submit" value="login">
	    		</form>
    		</div>
	    	<?php
    	}
    ?>
<script type="text/javascript">
	function del (id,type) {
		alert(id + type);
		//创建Ajax
		if (window.XMLHttpRequest) {
			var oAjax = new XMLHttpRequest();//兼容IE6
		}else{
			var oAjax = new ActiveXObject("Microsoft.XMLHTTP");
		}
		//打开
	    oAjax.open("POST","article.del.handle.php");
		//编码（很重要的）
	    oAjax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		//数据
		var data = "id=" + id + "&type=" + type;
		//发送
		oAjax.send(data);
		oAjax.onreadystatechange = function(){
			if (oAjax.readyState == 4) {
				if (oAjax.status == 200) {
					alert("信息POST成功")
					window.location.href = "index.php";
	    		}else{
	    		alert("发生错误" + oAjax.status );
	    	    }
			}
		}
	}


    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue1 = UE.getEditor('febweb');
    function createEditor() {
        enableBtn();
        UE.getEditor('febweb');
    }
    var ue = UE.getEditor('techo');
    function createEditor() {
        enableBtn();
        UE.getEditor('techo');
    }
    var ue = UE.getEditor('case');
    function createEditor() {
        enableBtn();
        UE.getEditor('case');
    }

</script>
</body>
</html>