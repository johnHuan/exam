function myalert(str){
  if(layer){
  layer.msg(str,{time:1000});
  }else{
   alert(str);
  }
}
function tohtml(str){
	str=str.replace(new RegExp("&lt;","gm"),"<");
	str=str.replace(new RegExp("&gt;","gm"),">");
	str=str.replace(new RegExp("&quot;","gm"),"\"");
	return str;
}