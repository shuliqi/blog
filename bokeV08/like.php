<?php
  //error_reporting(0);屏蔽所有的错误
  $keyword = isset($_GET['keyword']) ?trim($_GET['keyword']):'';
  require_once('connect.php');
  mysql_select_db('web');
  mysql_query('set names utf8');
  $sql = "select web.id,web.type,web.title from web where web.title like '%{$keyword}%' union select jishu.id, jishu.type,jishu.title from jishu where jishu.title like '%{$keyword}%'union select anli.id, anli.type,anli.title from anli where anli.title like '%{$keyword}%'";
  // $sql =" select * from web where title like '%{$keyword}%'";
  $result = mysql_query($sql);
  if (!empty($keyword)) {
     while ($row = mysql_fetch_assoc($result)) {
        $title[] = $row;
      }
  }
echo json_encode($title);
  // print_r($title);

?>