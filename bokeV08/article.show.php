<?php 
    require_once('connect.php');
	$id = $_GET['id'];
	$type = $_GET['type'];
	$sql = "select * from $type where id = $id";
	$result = mysql_query($sql);
	if ($result && mysql_num_rows($result)) {
	 	$row = mysql_fetch_assoc($result);
	 }else{
	 	echo "这篇文章不存在";
		exit;
	 }

	 $websql = "select * from web order by id desc limit 10";
	 $webresult = mysql_query($websql);
	 if ($webresult && mysql_num_rows($webresult)) {
	 	while ($webrow = mysql_fetch_assoc($webresult)) {
	 		$data[] = $webrow;
	 	}
	 } else {
	 	    $data = array();
	 }
	 $jishusql = "select * from jishu order by id desc limit 5";
	 $jishuresult = mysql_query($jishusql);
	 if ($jishuresult && mysql_num_rows($jishuresult)) {
	 	while ($jishurow = mysql_fetch_assoc($jishuresult)) {
	 		$jishudata[] = $jishurow;
	 	}
	 } else {
	 	    $jishudata = array();
	 }
// 上一篇和下一篇
$banner = "";
$sql_former = "select * from $type where id<$id order by id desc "; //上一篇文章sql语句。注意是倒序，因为返回结果集时只用了第一篇文章，而不是最后一篇文章 
$sql_later = "select * from $type where id>$id "; //下一篇文章sql语句 
$queryset_former = mysql_query($sql_former); //执行sql语句 
if(mysql_num_rows($queryset_former)){ //返回记录数，并判断是否为真，以此为依据显示结果 
	$result = mysql_fetch_array($queryset_former); 
	$banner_former = "<a href='article.show.php?id=".$result['id']."&type=".$result['type']."'>{$result['title']}</a><br>";
} else {
	$banner_former = "亲!上一篇没有了泥<br>";
} 

$queryset_later = mysql_query($sql_later); 
	
if(mysql_num_rows($queryset_later)){ 
		$result = mysql_fetch_array($queryset_later); 
		$banner_later = "<a href='article.show.php?id=".$result['id']."&type=".$result['type']."'>{$result['title']}</a><br>";
} else {
	   $banner_later = "亲!下一篇没有了泥<br>";
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<script src="js/index.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="js/move2.js" type="text/javascript" charset="utf-8"></script>
 --><script type="text/javascript" src="scripts/shBrushXml.js"></script>
<script type="text/javascript" src="scripts/shCore.js"></script>
<script type="text/javascript" src="scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="scripts/shBrushCss.js"></script>
<script type="text/javascript" src="scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="scripts/shBrushXml.js"></script>
<link type="text/css" rel="stylesheet" href="styles/shCoreDefault.css"/>
<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
<link rel="stylesheet" type="text/css" href="css/index.css"/>
<script type="text/javascript">SyntaxHighlighter.all();</script>
<style type="text/css">
  html{
  	width: 100%;
  	height: auto;
  	background: #e6e6e6;
  }
  .zong{
  	height: auto;
  }
  .m_title {
  width: 100%;
  height: 75px;
}
</style>
</head>
<body>
<div class="zong">
		<nav id="menu">	
			<h1>
		    	<a href="index.php"><img src="images/logo.png"></a> 
		    </h1>	  	    
			<ul class="menue">
				<li><a href="index.php">首页</a></li>
				<li><a href="web.php">前端</a></li>
				<li><a href="technology.php">技术</a></li>
				<li><a href="case.php">案例</a></li>
				<li><a href="message.php">留言</a></li>
			</ul>
			<ol>
				<li id ="sigup"><a>注册</a></li>
				<li id="denglu"><a href="#">登录</a></li>
				<li id="search"><img src="images/shou2.png"></li>
			</ol>
		</nav>
		<div class="section section2">
		<section class="show_left">
		    <div class="box1">
		      <p class="class">推荐文章</p>
		      <ul>
		      <?php 
		      		if (empty($data)) {
		      			echo "当前没有推荐文章";
		      		}else{
		      				foreach ($data as $key => $value) {
		       ?>
		      	<li>
		      		<a href="article.show.php?id=<?php echo $value['id']; ?>&type=<?php echo  $value['type'] ;?>">
			      		<img src="admin/<?php echo $value['pic']; ?>">
			      		<div class="show_tui">
			      			<span class="sss"><?php echo $value['title']; ?></span>
			      			<p>作者：<?php echo $value['author']; ?></p>
			      		</div>
		      		</a>
		      	</li>
		      	<?php

		      				}
		      		}
		      	?>
		      </ul>
			</div>
			 <div class="box1 box2">
		      <p class="class">友情推荐</p>
		      <ul>
		      	<?php 
		      		if (empty($jishudata)) {
		      			echo "当前没有推荐文章";
		      		}else{
		      				foreach ($jishudata as $key => $value) {
		       ?>
		      		<li>
		      		<a href="article.show.php?id=<?php echo $value['id']; ?>&type=<?php echo  $value['type'] ;?>">
			      		<img src="admin/<?php echo $value['pic']; ?>">
			      		<div class="show_tui">
			      			<span class="sss"><?php echo $value['title']; ?></span>
			      			<p>作者：<?php echo $value['author']; ?></p>
			      		</div>
		      		</a>
		      	</li>
		      	<?php

		      				}
		      		}
		      	?>
		      </ul>
			</div>
		</section>
		<section class="show_right">
			<div class="box15">
		       <h1><?php echo $row['title'];?></h1>
		       <p class="da">发布日期：<?php echo $row['timer'];?></p> <p class="au">作者：<?php echo $row['author'];?></p> 
		        <div class="show_content">
						<?php echo $row['content']; ?>
				</div>

				<div class="former">
					上一篇：<?php echo $banner_former;?>
					下一篇：<?php echo $banner_later ;?>
                </div>
                <div class="pinlun">
					<!--高速版-->
					<div id="SOHUCS" sid = "<?php echo $row['id'];?><?php echo $row['type'];?>"></div>
					<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
					<script type="text/javascript">
					    window.changyan.api.config({
					        appid: 'cyrYf6oAq',
					        conf: 'prod_02eac54e137afd240e621f5de39c08f8'
					    });
					</script>  
                </div>
			</div>
		</section>

	</div>
</div>
</body>
</html>      
