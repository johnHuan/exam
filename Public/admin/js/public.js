function showimg(imgstr,index){
   window.parent.show_lightbox({imgstr:imgstr,index:parseInt(index)});
   return false;
}
function initshowbigimg(){
  if(window.parent!=window.self){
    $(".bigimglink").each(function(){
	      $(this).removeAttr("data-lightbox");
	      $(this).click(function(){
		      var index= $(this).attr("img_index");
			  var imgstr= $(this).attr("img_str");
		      window.parent.show_lightbox({imgstr:imgstr,index:parseInt(index)});
			  return false;
		  });
	});
   }
  if(window.parent){
    $(".bigvideolink").each(function(){
	      $(this).removeAttr("data-lightbox");
	      $(this).click(function(){
		      var index= $(this).attr("img_index");
			  var imgstr= $(this).attr("img_str");
			  var titlestr="视频";
			  var htmlstr="<video src=\"../"+imgstr+"\" controls=\"controls\" style=\"width:100%;height:300px;\">您的浏览器不支持 video 标签。</video>";
			  if(window.parent==window.self){
			  
				var h=400;
				var w=600;
				
				var htmlstr="<div style='text-align:left; color:#999; overflow-y:auto; height:"+(h-80)+"px;'><div style='height:1px;overflow:hidden;'></div><div style='margin:10px;'>"+htmlstr+"</div></div>";
				duihuakuang.init({height:h,width:w,title:titlestr,html:htmlstr,bts:[{text:"关闭",classname:"btline",click:function(opt){opt.t.close();}}]});
			  }else{
				 window.parent.show_table({title:titlestr,html:htmlstr});
			 }
			  return false;
		  });
	});
   }
   
}
function show(id){
          var obj=document.getElementById(id);
          var titlestr=obj.getAttribute("mytitle");
		  var htmlstr=obj.innerHTML;
		  if(!window.parent){
	       
			var h=400;
			var w=600;
			var htmlstr="<div style='text-align:left; color:#999; overflow-y:auto; height:"+(h-80)+"px;'><div style='height:1px;overflow:hidden;'></div><div style='margin:10px;'>"+htmlstr+"</div></div>";
			duihuakuang.init({height:h,width:w,title:titlestr,html:htmlstr,bts:[{text:"关闭",classname:"btline",click:function(opt){opt.t.close();}}]});
		  }else{
			 window.parent.show_table({title:titlestr,html:htmlstr});
		 }
}
function get_checkbox_ids(name,type){
	var cks=document.getElementsByName(name);
	var ids="";
	var arr=new Array();
	for(var i=0;i<cks.length;i++){
		if(cks[i].checked){
		    if(ids!=""){
				ids+=","+cks[i].value;
			}else{
				ids+=cks[i].value;
			}
			arr.push(cks[i].value);
			
		}
	}
	if(typeof(type)!="undefined"&&type==1){
	    return arr;
	}else{
		return ids;
	}
}
function Del(obj){
	var cururl=String(window.location),arr=cururl.split("?"),listurl=arr[0];

	var ids=get_checkbox_ids("ck",0);
    var url=$(obj).attr("data-url");

	if(typeof(url)!="undefined"){
		listurl=url;
	}
	if(ids==""){
		  alert("请选择!");
	}else{
		if(confirm("确定要删除?")){
		   window.location=listurl+"&ids="+ids;
		}
	}
}
// JavaScript Document
function urlcanshu(name,value){
	      var cururl=String(window.location);
		  var arr=cururl.split("?");
		  var str="";
		  if(arr.length>1){
		      var items=arr[1].split("&");
			  for(var i=0;i<items.length;i++){
			       var option=items[i].split("=");
				   if(option[0]!=name){
				   if(str!=""){
				         str+="&"+items[i];
					  }else{
					     str=items[i];
					  }
				   }
			  }
		  }
		  if(value!=""){
		      if(str!=""){
			    str+="&"+name+"="+value;
			  }else{
			    str=name+"="+value;
			  }
		  }
		 return arr[0]+"?"+str;
}