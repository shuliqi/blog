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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>叮当猫-前端爱好者</title>
<meta name="Keywords"  >
<meta name="Description" >
<link href="css/index.css" rel="stylesheet">
<script type="text/javascript" src="scripts/shBrushXml.js"></script>
<script type="text/javascript" src="scripts/shCore.js"></script>
<script type="text/javascript" src="scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="scripts/shBrushCss.js"></script>
<script type="text/javascript" src="scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="scripts/shBrushXml.js"></script>
<link type="text/css" rel="stylesheet" href="styles/shCoreDefault.css"/>
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/index.css"/>
<link rel="stylesheet" type="text/css" href="css/pic.css"/>
<script type="text/javascript" src="js/move2.js"></script>
<script type="text/javascript">SyntaxHighlighter.all();</script>
<style type="text/css">
	.jj:after{
		display: block;
		content: " ";
		clear: both;
	}
	.jj{
		zoom:1;
	}
</style>
</head>
<body>
<header>
  <div class="quotes">
      <div id="slq_play" class="slq_playsess">
        <ol>
            <li style="background:#259CC7;"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
         </ol>
         <ul>
           <li style="z-index:1;"><img src="images/1.jpg"></li>
           <li><img src="images/2.jpg"></li>
           <li><img src="images/3.jpg"></li>
           <li><img src="images/4.jpg"></li>
           <li><img src="images/5.jpg"></li>
         </ul>
      </div>
    <!-- <div class="flower"><img src="images/t02.jpg"></div> -->
  </div>
  <div id="nav">
    <ul>
      <li><a href="index.php">首页</a></li>
      <li><a href="web.php">前端</a></li>
      <li><a href="technology.php">技术</a></li>
      <li><a href="case.php">案例</a></li>
      <li><a href="my.php">个人</a></li>
    </ul>
    <form id="search" >
        <input id="button" type="text" />
        <input id="submit" type="submit" value="搜索"/>
      </form>
      <div id="searchsuggest">
        <div id="search-suggest" > </div>
      </div>
  </div>
</header>
<div class="jj">
<section class="left">
		    <div class="boxxx">
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
			 <div class="boxxx box2">
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
		<section class="right">
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
			</div>
		</section>
</div>
<?php include 'footer.php';?>