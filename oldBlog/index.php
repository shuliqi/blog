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
<?php include 'indexHeader.php';?>
	<div class="section section2" id="div">
		<div class="m_title">最新文章</div>
		<div class="grid">
			<?php 
	            if (empty($webdata)) {
	            	echo "当前没有文章";
	            }else{
	            	foreach ($webdata as $key => $value) {	            			         
            ?>
            <a href="article.show.php?id=<?php echo $value['id'];?>&type=<?php echo $value['type'];?>">
				<figure class="effect-zoe">
					<img src="admin/<?php echo $value['pic'];?>" alt="img14"/>
					<figcaption>
						<p><?php echo $value['title'];?></p>
						<span>时间：<?php echo $value['timer'];?>作者：<?php echo $value['author'];?></span>
					</figcaption>			
				</figure>
			</a>
			<?php
					}
			   }
			?>
			<!-- 案例类 -->
			<?php 
	            if (empty($anlidata)) {
	            	echo "当前没有文章";
	            }else{
	            	foreach ($anlidata as $key => $value) {	            			         
            ?>
            <a href="article.show.php?id=<?php echo $value['id'];?>&type=<?php echo $value['type'];?>">
				<figure class="effect-zoe">
					<img src="admin/<?php echo $value['pic'];?>" alt="img14"/>
					<figcaption>
						<p><?php echo $value['title'];?></p>
						<span>时间：<?php echo $value['timer'];?>作者：<?php echo $value['author'];?></span>
				</figure>
			</a>
			<?php
					}
			   }
			?>
			<!-- 技术类 -->
			<?php 
	            if (empty($jishudata)) {
	            	echo "当前没有文章";
	            }else{
	            	foreach ($jishudata as $key => $value) {	            			         
            ?>
            <a href="article.show.php?id=<?php echo $value['id'];?>&type=<?php echo $value['type'];?>">
				<figure class="effect-zoe">
					<img src="admin/<?php echo $value['pic'];?>" alt="img14"/>
					<figcaption>
						<p><?php echo $value['title'];?></p>
						<span>时间：<?php echo $value['timer'];?>作者：<?php echo $value['author'];?></span>
					</figcaption>			
				</figure>
			</a>
			<?php
					}
			   }
			?>
		</div>
	</div>
<?php include 'footer.php';?>