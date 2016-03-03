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
}