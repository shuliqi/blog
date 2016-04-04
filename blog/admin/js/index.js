 window.onload=function(){
  var oUl=document.getElementById('ul');
  var aBtn=oUl.getElementsByTagName('li');
  var adiv=document.getElementsByTagName('section');
   aBtn[0].style.color = "#44a203";
  for (var i = 0; i < aBtn.length; i++) {
    aBtn[i].shu=i;
    aBtn[i].onclick=function(){
        for (var i = 0; i < aBtn.length; i++) {
          aBtn[i].style.color='#000';
          adiv[i].style.display='none';
        };
    this.style.color='#44a203';
    adiv[this.shu].style.display='block';
    }
  };

var oWebcon = document.getElementById('webcon');
var oWebBtn = document.getElementById('webbtn');
var oWebtian = document.getElementById('webtian');
myAddEvent(oWebBtn,"click",function() {
    document.getElementById('ul1').style.display="none";
    oWebtian.style.display="block";
    document.getElementById('page1').style.display = "none";

})
myAddEvent(oWebcon,"click",function() {
    document.getElementById('ul1').style.display="block";
    oWebtian.style.display="none";
    document.getElementById('page1').style.display = "block";

})

var ojishucon= document.getElementById('jishucon');
var ojishubtn = document.getElementById('jishubtn');
var ojishutian = document.getElementById('jishutian');
myAddEvent(ojishubtn,"click",function() {
    document.getElementById('ul2').style.display="none";
    ojishutian.style.display="block";
    document.getElementById('page2').style.display = "none";

})
myAddEvent(ojishucon,"click",function() {
    document.getElementById('ul2').style.display="block";
    ojishutian.style.display="none";
    document.getElementById('page2').style.display = "block";

})

var ocasecon= document.getElementById('casecon');
var ocasebtn = document.getElementById('casebtn');
var ocasetian = document.getElementById('casetian');
myAddEvent(ocasebtn,"click",function() {
    document.getElementById('ul3').style.display="none";
    ocasetian.style.display="block";
    document.getElementById('page3').style.display = "none";


})
myAddEvent(ocasecon,"click",function() {
    document.getElementById('ul3').style.display="block";
    ocasetian.style.display="none";
    document.getElementById('page3').style.display = "block";

})
function myAddEvent(obj,ev,fn){
    var el = obj || document;
  if (el.attachEvent) {
    el.attachEvent('on' + ev,fn);
  } else{
    el.addEventListener(ev,fn,false);
  }
}



 }
