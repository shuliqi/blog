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


$anlisql = "select * from anli order by id desc limit 6";
$anliresult = mysql_query($anlisql);
if ($jishuresult && mysql_num_rows($anliresult)) {
  while ($anlirow = mysql_fetch_assoc($anliresult)) {
    $anlidata[]= $anlirow;
  }
}
?>
<?php include 'header.php';?>
<div class="photowall">
  <ul class="wall_a">
   <article>  
<div class="blog">
  <h3><p>最新文章<span>New Blog</span></p></h3>
  <?php 
      if (empty($webdata)) {
           echo "当前没有文章";
      }else{
          foreach ($webdata as $key => $value) {                             
  ?>    
  <div class="bloglist">
      <h2><a href="article.show.php?id=<?php echo $value['id']; ?>&type=<?php echo  $value['type'] ;?>"><?php echo $value['title'];?></a></h2>
      <p class="datetime"><?php echo $value['timer'];?></p>
      <ul class="topimg">
       <img src="admin/<?php echo $value['pic'];?>" alt="img14"/>
      </ul>
       <ul class="content">
         <p><?php echo $value['description'];?></p>
      </ul>
      <p class="read"><a href="article.show.php?id=<?php echo $value['id']; ?>&type=<?php echo  $value['type'] ;?>">阅读>></a></p>
   </div> 
<?php
      }
    }
 ?>       
</div>    
     
<aside class="aside"> 
    <section class="show_left">
        <div class="box1">
          <h3><p>前端&nbsp<span>web文章</span></p></h3>
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
         <h3><p>web&nbsp<span>技术文章</span></p></h3>
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
<!-- <h2>友情链接</h2>
<ul>
  <li><a href="http://www.yangqq.com">杨青个人博客</a></li>
</ul> -->
</aside>  
</article>
  </ul>
</div>
<?php include 'footer.php';?>

