
<html>
<head>
<meta charset="utf-8" />
<title></title>
<style type="text/css">
html,body{
  width: 100%;
  height: 100%;
  font: 16px/1.8 "Microsoft Yahei",verdana;
}
#search{
  width:50%;
  height: 50px;
  margin:225px auto;
}
#button{
  width: 80%;
  height: 50px;
  float: left;
  outline: none;
  border:none;
}
#submit{
  width:20%;
  height: 50px;
  float: left;
  border:none;
  outline: none;
}
#searchsuggest{
  width: 40%;
  margin: -223px 25%;
  background: red;
}
#search-suggest a{
  width: 100%;
  background: white;
}
#search-suggest a{
  width: 98%;
  height:50px;
  float: left;
  padding-left: 2%;
  font-size: 20px;
  line-height:50px;
  border-bottom: 1px solid #ccc;
  letter-spacing:5px;
}
#search-suggest a:hover{
  border:1px solid #F6454E; 
  text-decoration: none;
}
#kaiguan{
  width: 50px;
  height: 50px;
  float: right;
  margin-top: -200px !important;
  margin-right: 20px;
  cursor:pointer;
  background: url(images/shousou.gif);
}
</style>
</head>
<body>
<div class="container">
  <div class="tr-container">
  <div id="kaiguan"></div>
    <form id="search" >
      <input id="button" type="text" />
      <input id="submit" type="submit" value="搜索"/>
    </form>
  </div>
</div>
<div id="searchsuggest">
    <div id="search-suggest" >
    </div>
</div>
</body>
</html>