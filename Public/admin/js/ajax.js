// JavaScript Document
var xmlHttp0="";
function CreateXmlHttp0()
{
	if(window.XMLHttpRequest){  
	xmlHttp0=new XMLHttpRequest() ; 
	}else if(window.ActiveXObject){  
	/*不能写成axtivexobject否则会出错*/
	xmlHttp0=new ActiveXObject("Microsoft.XMLHTTP");
	} 
	return  xmlHttp0;
}
function CreateXmlHttp_()
{
	var xmlHttp_=null;
	if(window.XMLHttpRequest){  
	xmlHttp_=new XMLHttpRequest() ; 
	}else if(window.ActiveXObject){  
	/*不能写成axtivexobject否则会出错*/
	xmlHttp_=new ActiveXObject("Microsoft.XMLHTTP");
	} 
	return  xmlHttp_;
}

function Ajax(option){
 var xmlHttp=null;
 //创建ajax对象
 if(window.XMLHttpRequest){  
  xmlHttp=new XMLHttpRequest() ; 
 }else if(window.ActiveXObject){  
 /*不能写成axtivexobject否则会出错*/
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
 } 
 option.type=option.type.toUpperCase(); //转为大写
 if(option.type=="GET"){
     xmlHttp.open(option.type,option.url+"?"+option.addstr,true);
      //alert(option.url+"?"+option.addstr);
 }else{
     xmlHttp.open(option.type,option.url,true);
 } 
 xmlHttp.onreadystatechange=function(){
if(xmlHttp.readyState==4){
  var str1=xmlHttp.responseText.replace(/[\r\n]/g, "");
  if (xmlHttp.status == 200) {  
  if(option.func){
	 option.func(str1);//运行回调函数
  }
  if(option.success){
	 option.success(str1);//运行回调函数
  }
  }else{
	 if(option.error){
		 option.error();
	 }
  }
}
 };
 xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
 if(option.type=="GET"){ 
   xmlHttp.send("");
 } else{
   xmlHttp.send(option.addstr);//这个是POST方式的
 } 
 return xmlHttp;
}