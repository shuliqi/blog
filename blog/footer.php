<footer>
  <p>Design by <a href="/" target="_blank">shuliqi</a></p>
</footer>
<script>
window.onload = function  () {
   var oDiv = document.getElementById('slq_play');
   var oOl= oDiv.getElementsByTagName('ol')[0];
   var aLi = oOl.getElementsByTagName('li');
   var  oUl = oDiv.getElementsByTagName('ul')[0];
   var aIagLi =  oUl.getElementsByTagName('li');
   var now = 0;
   for (var i = 0; i < aLi.length; i++) {
     aLi[i].index = i;
     aLi[i].onclick = function(){
      now = this.index;
      hanshu ();
    };
  }
  function hanshu () {
    for (var i = 0; i < aLi.length; i++) {
        aLi[i].style.background = '#76D1F2';
    };
    aLi[now].style.background= '#259CC7';
    startMove(oUl,{top:-550 * now});
  }
  function next () {
    now ++
    if (now == aLi.length){
        now = 0;
    };
    hanshu()
  }
  var timer = setInterval(next,2000);
  oDiv.onmouseover = function () {
    clearInterval(timer);
  }
 oDiv.onmouseout = function () {
    timer = setInterval(next,2000);
  }

}
</script>
</body>
</html>