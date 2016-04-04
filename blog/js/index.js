window.onload = function  () {
  var oLogo = document.getElementById('menu');
        //鼠标滑轮菜单事件
  window.onmousewheel=document.onmousewheel=function(ev){
      var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      var oEvent = ev || oevent;
      if(oEvent.wheelDelta== -120 && scrollTop >200 ){ 
         //向下滚动事件 
        startMove(oLogo,{height:0,opacity:0})//传递给缓冲效果
     
      }else{  //向上滚动事件
        startMove(oLogo,{height:70,opacity:100})//传递给缓冲效果
        
      } 
  }
  var oMask = null;
  var oSearch = document.getElementById('search');
  var oZhuce = document.getElementById('sigup');
  var oDenglu = document.getElementById('denglu');
  //注册部分
  myAddEvent(oZhuce,"click",function  () {
      var oScrollWidth = document.documentElement.clientWidth || document.body.clientWidth;
      var oScrollHeight = document.documentElement.clientHeight || document.body.clientHeight;
      var oscrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      oMask = document.createElement("div");
      oMask = document.createElement("div");
      oMask.id = "mask";
      oMask.style.width = oScrollWidth + "px";
      oMask.style.height = oScrollHeight + "px";
      oMask.style.top = oscrollTop +"px";
      document.body.appendChild(oMask);
      $.ajax({
            url:'nihao.php',
            success:function(data){
                document.getElementById("mask").innerHTML=data;
                var oInput = document.getElementById('mmmm').getElementsByTagName('input');
                var oName = oInput[0];
                var oPass = oInput[1];
                var oPassAgain = oInput[2];
                var oP = document.getElementById('mmmm').getElementsByTagName('p');
                var oPname1 = oP[0];
                var oPname2 = oP[1];
                var oPpass = oP[2];
                var oPpassEm = oP[3];
                var oPpassAgain = oP[4];
                var name_length = 0;
                var oEm = document.getElementById('mmmm').getElementsByTagName('em');
                var oImg = document.getElementById('mmmm').getElementsByTagName('img');
                var oImgName = oImg[0];
                var oImgPass = oImg[1];
                var oImgPassAgain = oImg[2];
                var oImgCheck = oImg[3];
                myAddEvent(oName,"focus",function(){
                     oPname2.style.display = "none"
                     oPname1.style.display = "block";
                     oPname1.innerHTML = '5-25个字符，一般一个汉字为两个字符，推荐使用中文会员名'
                })
                myAddEvent(oName,"keyup",function(){
                      oPname1.style.display = "none";
                      oPname2.style.display = "block";
                      name_length = nameLength(oName.value);
                      oPname2.innerHTML = name_length + "个字符";
                      if (name_length == 0) {
                        oPname1.style.display = "block";
                        oPname2.style.display = "none";
                      };
                })
                myAddEvent(oName,"blur",function(){
                      oPname2.style.display = "none";                    
                      var re = /[^\w\u4e00-\u9fa5]/g;
                      if (re.test(oName.value)) {
                        oImgName.src = 'images/error.gif';
                        oPname1.style.display = "block"
                        oPname1.innerHTML = '含有非法字符!';
                      }
                      else if(oName.value ==""){
                        oImgName.src = 'images/error.gif';
                        oPname1.style.display = "block"
                        oPname1.innerHTML = '不能为空!';
                      }
                      else if(name_length > 25){
                         oImgName.src = 'images/error.gif';
                         oPname1.style.display = "block"
                         oPname1.innerHTML = '长度不能超过25个字符！';
                      }
                      else if(name_length < 6){
                         oImgName.src = 'images/error.gif';
                         oPname1.style.display = "block"
                         oPname1.innerHTML = '长度不能小于6个字符！';
                      }
                      else{
                        oImgName.src = 'images/dagou.png';
                      }
                })
                myAddEvent(oPass,"focus",function(){  
                     oPpass.style.display = "block";            
                     oPpass.innerHTML = '推荐使用数字和字符作为密码'
                })
                myAddEvent(oPass,"keyup",function(){
                      oPpass.style.display = "none";
                      oPpassEm.style.display = "block";
                      oEm[0].style.background = "#009df5";
                     if (oPass.value.length > 5) {
                        oPassAgain.removeAttribute("disabled");
                        oPpassAgain.style.display = "block";
                        oPpassAgain.innerHTML = "请再输入一次";
                        oEm[1].style.background = "#009df5";
                      }
                      else{
                        // oPassAgain.setAttribute("disabled");
                        oEm[1].style.background = "#ccc";
                      }
                      if (oPass.value.length > 10  ) {
                        oEm[2].style.background = "#009df5";
                      }
                      else{
                        oEm[2].style.background = "#ccc";
                      }
                      if (oPass.value.length ==0) {
                          oPpass.style.display = "block";
                          oPpassEm.style.display = "none";
                      }
                })
                myAddEvent(oPass,"blur",function(){
                     var sum = FindStr(oPass.value,oPass.value[0]);
                     var re_n = /[^\d]/g;
                     var re_t = /[^a-zA-Z]/g;
                     if(oPass.value == ""){
                        oPpass.style.display = "block";
                        oImgPass.src = 'images/error.gif';
                        oPpass.innerHTML = '不能为空';
                     }
                     else if(sum == oPass.value.length){
                         oImgPass.src = 'images/error.gif';
                         oPpassEm.style.display = "none";
                         oPpass.style.display = "block";
                         oPpass.innerHTML = '不能使用相同字符'; 
                     }
                     else if(this.value.length<6 || this.value.length>16){
                         oImgPass.src = 'images/error.gif';
                         oPpassEm.style.display = "none";
                         oPpass.style.display = "block";
                         oPpass.innerHTML = '长度应为6—16个字符'; 
                     }

                     else if (!re_n.test(this.value)){
                         oImgPass.src = 'images/error.gif';
                         oPpassEm.style.display = "none";
                         oPpass.style.display = "block";
                         oPpass.innerHTML = '不能全为数字'; 
                     }
                      else if (!re_t.test(this.value)){
                         oImgPass.src = 'images/error.gif';
                         oPpassEm.style.display = "none";
                         oPpass.style.display = "block";
                         oPpass.innerHTML = '不能全为字母'; 
                     }
                     else{
                         oImgPass.src = 'images/dagou.png';
                         oPpassEm.style.display = "none";
                         oPpass.style.display = "block";
                         oPpass.innerHTML = 'OK!'; 
                     }
                })        
                myAddEvent(oPassAgain,"blur",function(){ 
                    if(this.value === oPass.value) {
                      oPpassAgain.innerHTML = "OK!";
                    }
                    else{
                      oPpassAgain.innerHTML = "两次输入的密码不一致!";
                    }
                })
                 
                 $('body').on('click','#close',function(){
                    document.body.removeChild(oMask);
                 })
                  stopBubble(this);
               },
            error:function(){
                alert('此页面没有相关数据!');   
            }   
        })
        stopBubble(this);  
    })
// 搜索
  myAddEvent(oSearch,"click",function  () {
      var oScrollWidth = document.documentElement.clientWidth || document.body.clientWidth;
      var oScrollHeight = document.documentElement.clientHeight || document.body.clientHeight;
      var oscrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      oMask = document.createElement("div");
      oMask = document.createElement("div");
      oMask.id = "mask";
      oMask.style.width = oScrollWidth + "px";
      oMask.style.height = oScrollHeight + "px";
      oMask.style.top = oscrollTop +"px";
      document.body.appendChild(oMask);
      $.ajax({
            url:'search.php',
            success:function(data){
                document.getElementById("mask").innerHTML=data;
                oButton = document.getElementById('button');
                myAddEvent(oButton,"keyup",function  () {
                    $.ajax({
                        type:"GET",
                        url:"like.php?keyword=" + $("#button").val(),
                        success:function(data){
                            eval('data='+data);                   
                            var html = '';
                            for (var i = 0; i < data.length; i++) {
                              html +='<a href="article.show.php?id='+data[i].id+'&type='+data[i].type+'">'+data[i].title+'</a>';
                            }
                            document.getElementById('search-suggest').innerHTML=html;
        
                           
                        },
                        error:function(){
                            alert('此页面没有相关数据!');   
                        }
                    })
                })
                oSubmit = document.getElementById('submit');
                $('body').on('click','#kaiguan',function(){
                    document.body.removeChild(oMask);
                })
            },
            error:function(){
                alert('此页面没有相关数据!');   
            }
        })
        stopBubble(this);  
    }) 

 //登录部分
   myAddEvent(oDenglu,"click",function  () {
      var oScrollWidth = document.documentElement.clientWidth || document.body.clientWidth;
      var oScrollHeight = document.documentElement.clientHeight || document.body.clientHeight;
      var oscrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      oMask = document.createElement("div");
      oMask = document.createElement("div");
      oMask.id = "mask";
      oMask.style.width = oScrollWidth + "px";
      oMask.style.height = oScrollHeight + "px";
      oMask.style.top = oscrollTop +"px";
      document.body.appendChild(oMask);
      $.ajax({
            url:'wuyu.php',
            success:function(data){
                document.getElementById("mask").innerHTML=data;
                 $('body').on('click','#guanbi',function(){
                    document.body.removeChild(oMask);
                 })
                 var aInput = document.getElementById('form').getElementsByTagName('input');
                 var oNameInput = aInput[0];
                 var oPassInput = aInput[1];
                 var oCheckInput = aInput[2];
                  stopBubble(this);
            },
            error:function(){
                alert('此页面没有相关数据!');   
            }
        })
        stopBubble(this);  
    }) 
}

function myAddEvent(obj,ev,fn){
    var el = obj || document;
	if (el.attachEvent) {
		el.attachEvent('on' + ev,fn);
	} else{
		el.addEventListener(ev,fn,false);
	}
}
function nameLength(str){
  return str.replace(/[^x00-xff]/g,"xx").length;
}
function FindStr(str,n){
  var tmp = 0;
  for (var i = 0; i < str.length; i++) {
    if (str.charAt(i) == n) {
      tmp++;
    }
  }
  return tmp;
}
function stopBubble(e){
  //一般用在鼠标或键盘事件上
  if(e && e.stopPropagation){
    //W3C取消冒泡事件
    e.stopPropagation();
  }else{

  //IE取消冒泡事件
    window.event.cancelBubble = true;
  }
}
