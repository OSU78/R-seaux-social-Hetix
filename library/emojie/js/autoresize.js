var textarea = document.getElementById("text-custom-trigger");

textarea.addEventListener('keydown', autosize);
             
function autosize(){
  var el = this;
  var field=document.getElementsByClassName("field");
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    el.style.cssText = 'height:auto; padding:0';
    // for box-sizing other than "content-box" use:
    // el.style.cssText = '-moz-box-sizing:content-box';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}