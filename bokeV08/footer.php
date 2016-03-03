<?php
require_once('connect.php');
$websql = "select * from web order by id desc limit 4";
$webresult = mysql_query($websql);
if ($webresult && mysql_num_rows($webresult)) {
	while ($webrow = mysql_fetch_assoc($webresult)) {
		$webdata[]= $webrow;
	}
}
$jishusql = "select * from jishu order by id desc limit 4";
$jishuresult = mysql_query($jishusql);
if ($jishuresult && mysql_num_rows($jishuresult)) {
	while ($jishurow = mysql_fetch_assoc($jishuresult)) {
		$jishudata[]= $jishurow;
	}
}


$anlisql = "select * from anli order by id desc limit 4";
$anliresult = mysql_query($anlisql);
if ($jishuresult && mysql_num_rows($anliresult)) {
	while ($anlirow = mysql_fetch_assoc($anliresult)) {
		$anlidata[]= $anlirow;
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
			            if (empty($webdata)) {
			            	echo "当前没有文章";
			            }else{
			            	foreach ($webdata as $key => $value) {	            			         
	            	?>
					<li><a href="article.show.php?id = <?php echo $value['id'];?>&type = <?php echo $value['type'];?>"><?php echo $value['title'];?></a></li>
					<?php
							}
			   			}
					?>
				</ul>
				<ul>
					<?php 
			            if (empty($jishudata)) {
			            	echo "当前没有文章";
			            }else{
			            	foreach ($jishudata as $key => $value) {	            			         
	            	?>
					<li><a href="article.show.php?id = <?php echo $value['id'];?>&type = <?php echo $value['type'];?>"><?php echo $value['title'];?></a></li>
					<?php
							}
			   			}
					?>
				</ul>
				<ul>
					<?php 
			            if (empty($anlidata)) {
			            	echo "当前没有文章";
			            }else{
			            	foreach ($anlidata as $key => $value) {	            			         
	            	?>
					<li><a href="article.show.php?id = <?php echo $value['id'];?>&type = <?php echo $value['type'];?>"><?php echo $value['title'];?></a></li>
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

</body>
</html>