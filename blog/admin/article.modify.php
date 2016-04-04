<?php
  require_once('connect.php');
  $id = $_GET['id'];
  $type=  $_GET['type'];
  $query = mysql_query("select * from $type where id=$id");
  $data = mysql_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title>舒丽琦的博客后台</title>
  <link rel="stylesheet" type="text/css" href="css/modify.handle.css">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"> </script>
  <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
  <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
  <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
<?php
     session_start();
    if(isset($_SESSION['user'])) {
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
      <div id="webtian">
        <div class="content">
          <form action="article.modify.handle.php" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="key" value="<?php echo $data['type'];?>" />
            <input type="hidden" name="id" value="<?php echo $data['id'];?>" />
            <input id ="title" name="title" value="<?php echo $data['title'];?>" />
            <input id ="author" name="author" value="<?php echo $data['author'];?>" />
            <input id ="tips" name="tips" value="<?php echo $data['description'];?>" />
            <div class="pic">
              <label>图片：</label>
              <input  type="file" id="mypic" name="mypic" value="<?php echo $data['pic'];?>" />
            </div>
            <textarea id="editor" type="text/plain" name="content"style="height:500px;">
              <?php echo $data['content'];?>
            </textarea>
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
      echo "<div id='check'>";
      echo "你没有权限添加文章，点击下方的链接进行验证<br>";
      echo "<a class='again'href='index.php'>点击验证</a>";
      echo "</div>";
    }
?>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('editor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
        alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }
</script>
</body>
</html>