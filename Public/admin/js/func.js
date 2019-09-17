// JavaScript Document
function clearinput(){
	var content=document.getElementById("content");
	//fsContent.value;
	if(fsContent){
	CKEDITOR.instances.fsContent.setData('');
	}
}
 function $fs(id){
	 return document.getElementById(id);
 }
 function AllSelect(obj){
	var cks=document.getElementsByName("ck");
	var ids="";
	for(var i=0;i<cks.length;i++){
			cks[i].checked=obj.checked;
	}
}

function Del(){
	var cks=document.getElementsByName("ck");
	var ids="";
	for(var i=0;i<cks.length;i++){
		if(cks[i].checked){
		    if(ids!=""){
				ids+=","+cks[i].value;
			}else{
				ids+=cks[i].value;
			}
		}
	}
	if(ids==""){
		alert("请选择!");
	}else{
		if(confirm("确定要删除?")){
		   window.location="list.php?act=del&ids="+ids;
		}
	}
}
 function ShowSelect(objid,valuestr,thisvalue,fg){
	 if(typeof(fg)=="undefined"||fg==""){
		 fg="[]";
	 }

	  var items=valuestr.split(fg);
	  var obj=document.getElementById(objid);
	  if(typeof(obj)=="undefined"||!obj){
		  return false;
	  }
	  if(obj.tagName!="SELECT"){
		    return false;
	  }
	  for(var i=0;i<items.length;i++){
		  var values=items[i].split("||");
		  var val=values[0];
		  if(values.length>1){
			  val=values[1];
		  }
		  var option=new Option(values[0],val);
		  obj.options.add(option);
		  if(val==thisvalue){
			  obj.selectedIndex=i;
		  }
	  }
 }
  function ShowSelectA(objid,valuestr,thisvalue){
	  var items=eval("("+valuestr+")");
	  var obj=document.getElementById(objid);
	  if(typeof(obj)=="undefined"||!obj){
		  return false;
	  }
	  if(obj.tagName!="SELECT"){
		    return false;
	  }
	  for(var i=0;i<items.length;i++){
		  var item1=items[i];
		  var option=new Option(item1["title"],item1["value"]);
		  obj.options.add(option);
		  if(item1["value"]==thisvalue){
			  obj.selectedIndex=i;
		  }
	  }
 }
 function OpenImage(obj){
	 if(obj.value!=""){
		var arr=obj.value.split(".");
		var ext=arr[arr.length-1];
		var bigsrc=obj.value+"."+ext+"."+ext;
	    window.open("../../"+bigsrc);
	 }
 }

function GetValue(opt) {

		var str_="";
		 var obj_=null;
		if(opt.obj){
			obj_=opt.obj;
		}else{
		   obj_= document.getElementById(opt.id);
		}
		if(obj_==null){
			var objs= document.getElementsByName(opt.id);
			if(objs.length>0){
				obj_=objs[0];
			}
		}
		 if(obj_!=null){
		 if(obj_.type=="checkbox"||obj_.type=="radio"){
				  var obj_=document.getElementsByName(obj_.name);
				  var len = obj_.length;
				  for (var i = 0; i < len; i++) {
                    if(obj_[i].checked){
						if(str_!=""){
							str_+=","+obj_[i].value;
						}else{
							str_+=""+obj_[i].value;
						}
					}
				  }
		 }else if(obj_.type=="text"){
			  str_= obj_.value;
		 }else if(obj_.type=="select-one"){
			  var len1 = obj_.length;
			  for (var i = 0; i < len1; i++) {
                    if(obj_.options[i].selected){
						if(str_!=""){
							str_+=","+obj_.options[i].value;
						}else{
							str_+=""+obj_.options[i].value;
						}
					}
			  }
		 }else if(obj_.type=="textarea"){
			str_= obj_.value;
		 }else if(obj_.type=="hidden"){
			str_= obj_.value;
		 }else if(obj_.type=="password"){
			 str_= obj_.value;
		 }else{
			  str_= obj_.innerHTML;
		 }
		 }
		str_=str_.replace(new RegExp("&","gm"),"[cxc]"); 
    return str_;
}
function SetRadio(name,value){
	var inputs=document.getElementsByName(name);
	for(var i=0;i<inputs.length;i++){
		var input=inputs[i];
		if(input.value==String(value)){
			input.checked=true;
		}
	}
}
function CreateRadio(name,value,optionstr){
	   var items=optionstr.split("[]");
	   for(i=0;i<items.length;i++){
		  var values=items[i].split("||");
		  var checked="";
		  if(values[1]==value){
			  checked="checked";
		  }
		  if(values[1]!=""){
	      document.writeln('<label><input type="radio" name="'+name+'"  value="'+values[1]+'" '+checked+' />'+values[0]+'</label>');
		  }
	   }
}
function SelectAll(obj){
	var inputs=document.getElementsByName("ck");
	for(var i=0;i<inputs.length;i++){
		if(obj.checked){
			inputs[i].checked=true;
		}else{
			inputs[i].checked=false;
		}
	}
}
function Del(){
	var cks=document.getElementsByName("ck");
	var ids="";
	for(var i=0;i<cks.length;i++){
		if(cks[i].checked){
		    if(ids!=""){
				ids+=","+cks[i].value;
			}else{
				ids+=cks[i].value;
			}
		}
	}
	if(ids==""){
		alert("请选择!");
	}else{
		if(confirm("确定要删除?")){
		   window.location="list.php?act=del&ids="+ids;
		}
	}
}
function Alert(str){
 	    	if(typeof(layer)!="undefined"){
			     layer.msg("<span style='color:#ffff00;font-size:15px;'>"+str+"<span>");
			 }else{
				 alert(str);
			 }    
}
function popupbox(opt){
	$("#popupbox").remove();
	var html="";
	html+='<div class="popupbox" id="popupbox">';
	html+='<div class="pptitle">'+opt.title+'</div>';
	html+='<div class="ppdesc">';
	html+='<div class="ppdescinner">';
	html+=opt.txt;
	html+='</div>';
	html+='</div>';
	html+='<div class="ppbt">'+opt.bttitle+'</div>';
	html+='</div>';
	
	var pp=$(html);
	var hz=$(window).height();
	var wz=$(window).width();
	$("body").append(pp);
	if(opt.init){
		opt.init();
	}
	var popupbox=$(".popupbox");
	var h,w;
	if($(document).width()<1000){
         w=$(window).width();
		 h=$(window).height();
		 popupbox.css({width:w+"px",height:h+"px",'margin-left':-(w/2)+"px","margin-top":-(h/2)+"px"}).find(".ppdesc").css({height:(h-40-32-8-20)+"px"});
	}else{
         w=700;
		 h=500;
		 popupbox.css({width:w+"px",height:h+"px",'margin-left':-(w/2)+"px","margin-top":-(h/2)+"px"}).find(".ppdesc").css({height:(h-40-32-8-20)+"px"});
	}
	popupbox.find(".ppbt").click(function(){
	    popupbox.fadeOut();
		if(opt.success){
			 opt.success();
		}
	});
	popupbox.fadeIn();
	
}