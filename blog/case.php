<?php
require_once('connect.php');
$websql = "select * from web order by id desc limit 4";
$webresult = mysql_query($websql);
if ($webresult && mysql_num_rows($webresult)) {
  while ($webrow = mysql_fetch_assoc($webresult)) {
    $webdata[]= $webrow;
  }
}
$jishusql = "select * from jishu order by id desc limit 7";
$jishuresult = mysql_query($jishusql);
if ($jishuresult && mysql_num_rows($jishuresult)) {
  while ($jishurow = mysql_fetch_assoc($jishuresult)) {
    $jishudata[]= $jishurow;
  }
}
?>
<?php 
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
     $page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1=1'>|<</a>";
     $page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1=".($p1-1)."'><pre</a>";
   }else{
     $page_banner1 .= "<a class='disable'>|<</a>";
     $page_banner1 .= "<a class='disable'><pre</a>";
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
    $page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1=".($p1+1)."'>next>></a>";
    $page_banner1 .= "<a href='".$_SERVER['PHP_SELF']."?p1= $total_pages1 '>>|</a>";
  }else{
    $page_banner1 .= "<a class='disable'>next></a>";
    $page_banner1 .= "<a class='disable'>>|</a>";
  }
  // $page_banner1 .="<a>共".$total_pages1."页</a>";
  // $page_banner1.="<form action='case.php' method='get'>";
  // $page_banner1.="到<input type='text' size='2' class='text'  name='p1'>页";
  // $page_banner1.="<input type='submit' class='text'value='确定'>";
  // $page_banner1.="</form>";
  $arry = array('banner' =>$page_banner1,'data' =>$data);
  return $arry;
 }
 ?>
<?php include 'header.php';?>
<div class="photowall">
  <ul class="wall_a">
   <article>  
<div class="blog">
  <h3><p>最新文章<span>New Blog</span></p></h3>
  <?php 
      if (empty($anlidata)) {
           echo "当前没有文章";
      }else{
          foreach ($anlidata as $key => $value) {                             
  ?>    
  <div class="bloglist">
      <h2>  <a href="article.show.php?id=<?php echo $value['id']; ?>&type=<?php echo  $value['type'] ;?>"><?php echo $value['title'];?></a></h2>
      <p class="datetime"><?php echo $value['timer'];?></p>
      <ul class="topimg">
       <img src="admin/<?php echo $value['pic'];?>" alt="img14"/>
      </ul>
       <ul class="content">
         <p><?php echo $value['description'];?></p>
      </ul>
      <p class="read">  <a href="article.show.php?id=<?php echo $value['id']; ?>&type=<?php echo  $value['type'] ;?>">阅读>></a></p>
   </div> 
<?php
      }
    }
 ?>
<div class="page" id="page1"><?php echo $anli_banner;?></div>       
</div>    
     
<aside class="aside"> 
    <section class="show_left">
        <div class="box1">
          <h3><p>前端&nbsp<span>案例文章</span></p></h3>
          <ul>
          <?php 
              if (empty($anlidata)) {
                echo "当前没有推荐文章";
              }else{
                  foreach ($anlidata as $key => $value) {
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
         <h3><p>web&nbsp<span>友情链接</span></p></h3>
          <ul>
              <li>
              <a href="http://www.bizhongbio.com/">
                <img src="images/boy.jpg">
                <div class="show_tui">
                  <span class="sss">双鱼bizhongbio-渡人渡己</span>
                  <p>博主：兰必钟</p>
                </div>
              </a>
            </li>
             <li>
              <a href="http://greenfavo.com/">
                <img src="images/girl.jpg">
                <div class="show_tui">
                  <span class="sss">greenfavo-前端学习笔记</span>
                  <p>博主：石佳楠</p>
                </div>
              </a>
            </li>
            <li>
              <a href="http://www.niices.com/">
                <img src="images/jiang.jpg">
                <div class="show_tui">
                  <span class="sss">蓝色栗子</span>
                  <p>博主：蒋恩涛</p>
                </div>
              </a>
            </li>
             <li>
              <a href="http://petite-dd.com/">
                <img src="images/wang.jpg">
                <div class="show_tui">
                  <span class="sss">文艺的聚集地</span>
                  <p>博主：王一帆</p>
                </div>
              </a>
            </li>
             <li>
              <a href="http://petite-dd.com/">
                <img src="images/xuan.jpg">
                <div class="show_tui">
                  <span class="sss">轩枫阁</span>
                  <p>博主：农航亮</p>
                </div>
              </a>
            </li>
            <li>
              <a href="http://www.new-thread.com/">
                <img src="images/new.jpg">
                <div class="show_tui">
                  <span class="sss">新思路团队网站</span>
                  <p>NewThread团队</p>
                </div>
              </a>
            </li>
             <li>
              <a href="http://www.duanliang920.com/">
                <img src="images/s6.jpg">
                <div class="show_tui">
                  <span class="sss">分享web前端和技术</span>
                  <p>博主：段亮</p>
                </div>
              </a>
            </li>
          </ul>
      </div>
    </section>
</aside>  
</article>
  </ul>
</div>
<?php include 'footer.php';?>

