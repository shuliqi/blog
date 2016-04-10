<?php 
	require_once('connect.php');
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
	 $position1 = ($p1-1)*8;
	 // 每页显示的条数
	 $pagesize1 = 8;
	 /**根据页码取出数据：php mysql处理**/
	// 编写sql获取分页数据 "select form 表名 limit".起始位置，显示的条数
	 $sql1 = "select * from $type order by id desc limit $position1, $pagesize1";
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
	$page_banner1.="<form action='case.php' method='get'>";
	$page_banner1.="到<input type='text' size='2' class='text'  name='p1'>页";
	$page_banner1.="<input type='submit' class='text'value='确定'>";
	$page_banner1.="</form>";
	$arry = array('banner' =>$page_banner1,'data' =>$data);
	return $arry;
 }
 ?>
<?php include 'header.php';?>
	<div class="section section2">
		<div class="m_title"></div>
		<div class="grid">
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
						<p class="kkk"><?php echo $value['title'];?></p>
					</figcaption>			
				</figure>
			</a>
			<?php
				   }
		    	}
			?>		
		</div>
		<div class="page" id="page1"><?php echo $anli_banner;?></div>
	</div>
<?php include 'footer.php';?>