<?php
require_once('connect.php');
$websql = "select * from web order by id desc limit 4";
$webresult = mysql_query($websql);
if ($webresult && mysql_num_rows($webresult)) {
	while ($webrow = mysql_fetch_assoc($webresult)) {
		$webdata1[]= $webrow;
	}
}
$jishusql = "select * from jishu order by id desc limit 4";
$jishuresult = mysql_query($jishusql);
if ($jishuresult && mysql_num_rows($jishuresult)) {
	while ($jishurow = mysql_fetch_assoc($jishuresult)) {
		$jishudata1[]= $jishurow;
	}
}


$anlisql = "select * from anli order by id desc limit 4";
$anliresult = mysql_query($anlisql);
if ($jishuresult && mysql_num_rows($anliresult)) {
	while ($anlirow = mysql_fetch_assoc($anliresult)) {
		$anlidata1[]= $anlirow;
	}
}
?>
	<div class="section section3">
		<div class="m_title">最新推荐</div>
		<div class="recommend">

			<div class="con_conmend">
			    <span>友情推荐</span>
				<ul>
					<?php 
			            if (empty($webdata1)) {
			            	echo "当前没有文章";
			            }else{
			            	foreach ($webdata1 as $key => $value) {	            			         
	            	?>
					<li><a href="article.show.php?id=<?php echo $value['id'];?>&type=<?php echo $value['type'];?>"><?php echo $value['title'];?></a></li>
					<?php
							}
			   			}
					?>
				</ul>
				<ul>
					<?php 
			            if (empty($jishudata1)) {
			            	echo "当前没有文章";
			            }else{
			            	foreach ($jishudata1 as $key => $value) {	            			         
	            	?>
					<li><a href="article.show.php?id=<?php echo $value['id'];?>&type=<?php echo $value['type'];?>"><?php echo $value['title'];?></a></li>
					<?php
							}
			   			}
					?>
				</ul>
				<ul>
					<?php 
			            if (empty($anlidata1)) {
			            	echo "当前没有文章";
			            }else{
			            	foreach ($anlidata1 as $key => $value) {	            			         
	            	?>
					<li><a href="article.show.php?id=<?php echo $value['id'];?>&type=<?php echo $value['type'];?>"><?php echo $value['title'];?></a></li>
					<?php
							}
			   			}
					?>
				</ul>
			</div>
			<div class="cha_conmend">
				<span>友情链接</span>
				<ul>
					<li><a href="http://www.bizhongbio.com/">双鱼bizhongbio-渡人渡己</a></li>
					<li><a href="http://greenfavo.com/">greenfavo-前端学习笔记</a></li>
				</ul>
			</div>
		</div>
	</div>
	<span class="foter">
			<p>Copyright © Aaron All Rights Reserved</p>
	</span>
	
</div>
<script type="text/javascript">
	$(function(){
	$("a").hover(function(){
		$('.effect-zoe',this).stop().animate({"bottom":"30px"},400);	
		$(".x",this).stop().css({'left':'50px'}).animate({'left':"80px"},400).show();
		$(".y",this).stop().css({'right':'50px'}).animate({'right':"80px"},400).show();
		$('.fire',this).show();
	},function(){
		$('.effect-zoe',this).stop().animate({"bottom":"14px"},400);
		$('.fire, .x, .y',this).hide();
	});	
});
</script>
</body>
</html>