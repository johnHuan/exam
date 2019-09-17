// JavaScript Document
//创建分类选项
var MyAddStr="";
var SelectClassIdValue="";

function CreateSelectOption(option){
		var CreateXmlHttp=function(){
			var xmlHttp_=null;
			if(window.XMLHttpRequest){  
			xmlHttp_=new XMLHttpRequest() ; 
			}else if(window.ActiveXObject){  
			/*不能写成axtivexobject否则会出错*/
			xmlHttp_=new ActiveXObject("Microsoft.XMLHTTP");
			} 
			return  xmlHttp_;
		}
		var inputid=option.id;
		var oClassNo=document.getElementById(inputid);
		if(oClassNo){
			if(MyGetObj(inputid+"Line")==null){
			  var line=document.createElement("div");
			  line.id=inputid+"Line";
			  oClassNo.parentNode.appendChild(line);
			}
		}
		
		if(MyGetObj(inputid+"Line")==null){
			 return false;
		}
		if(typeof(option.obj)=="undefined"){
			option.obj=null;
		}
		
		var obj=option.obj;
		var fatherno="";
		var index=0;
		var parentid=inputid+"Div";
		var oParent= null;
		if(!option.text){option.text="请选择";}
	    var cur_index=0;
		if(obj!=null){
				oParent=MyGetObj(parentid);
				fatherno=obj.options[obj.selectedIndex].value;
				var arr=obj.id.split("_");
				index=parseInt(arr[1])+1;
				//oClassNo.value=fatherno;
		}else{
				if(option.show=="1"){
				MyGetObj(inputid+"Line").innerHTML="<div id=\""+inputid+"Nav\"style=\"display:none;padding:0px; color:#a80000;\">"+option.text+"<a onclick=\"ShowClassDiv1(this,'"+inputid+"')\"  style=\"padding-left:10px;\" class=\"color1\">修改</a></div><div id=\""+inputid+"Div\" ></div>";
				}else{
				 MyGetObj(inputid+"Line").innerHTML="<div id=\""+inputid+"Nav\" style='padding:0px;color:#a80000;'>"+option.text+"<a onclick=\"ShowClassDiv1(this,'"+inputid+"')\"  style=\"padding-left:10px;\" class=\"color1\">修改</a></div><div id=\""+inputid+"Div\" style=\"display:none\"></div>";
				}
				oParent=MyGetObj(parentid);
				var oSelect=document.getElementById(inputid);
				if(!oSelect){
					oSelect=document.createElement("input"); 
					oSelect.type="hidden";
					oSelect.id=inputid;
					oSelect.name=inputid;
					oSelect.value=option.selectclassno;
					oParent.appendChild(oSelect);
				}else{
					oSelect.value=option.selectclassno;
				}
				fatherno=option.fatherno;
				index=0;
		}
		
		var xmlHttp_=CreateXmlHttp();
		var ajaxurl="../ajax/fs_data.php";
		var str="act=CreateSelectOption&fatherno="+fatherno+MyAddStr;
		xmlHttp_.open("POST",ajaxurl,true);
		xmlHttp_.onreadystatechange=function(){
		  if(xmlHttp_.readyState==4){
			  var str1=xmlHttp_.responseText.replace(/[\r\n]/g, "");
			  var ONav=MyGetObj(inputid+"Nav");
			  if(str1!=""){
                  var maxlen=document.getElementsByName(inputid+"_").length;
				  var oSelect=document.createElement("select"); 
				  oSelect.id=inputid+"_"+index;
				  oSelect.name=inputid+"_";
				  oSelect.index=index;
				  var arr=str1.split("||");
				  var len=arr.length;
				   if(len==1&&maxlen>0){
					   var arr1=arr[0].split("[]");
					   if(arr1[1]==SelectClassIdValue){
						   return false; //终止
					   }
				  }
				  var item1=new Option("请选择","");
				  item1.setAttribute("ChildCount",0);
				   oSelect.options.add(item1);  

				 
				  for(var i=0;i<len;i++){
					  var arr1=arr[i].split("[]");
					  var item1=new Option(arr1[0],arr1[1]);
					  item1.setAttribute("ChildCount",arr1[2]);
					  oSelect.options.add(item1);  
				  }
                         //change事件
						 oSelect.onchange=function(){
			                 var oClassNoDiv=document.getElementById(inputid+"Div");
							 var maxlen1=oClassNoDiv.getElementsByTagName("select").length;
	
								for(var i=(parseInt(this.index)+1);i<maxlen1;i++){
									var oSelect_=MyGetObj(inputid+"_"+i);
									if(oSelect_){
									oParent.removeChild(oSelect_);
									}
								}
							 if(this.index!=0&&this.options[this.selectedIndex].value==""){
								
								 var select1=document.getElementById(inputid+"_"+(parseInt(this.index)-1));
								 
								 SelectClassIdValue=select1.options[select1.selectedIndex].value;  
								 
								
							 }else {
								 SelectClassIdValue=this.options[this.selectedIndex].value;
							 }
							 oClassNo.value=SelectClassIdValue;
							 oClassNo.setAttribute("myvalue",SelectClassIdValue);
							 	
							  cur_index=this.index;
							 if( this.options[this.selectedIndex].getAttribute("ChildCount")!="0"){
								   option.obj=this;
							       CreateSelectOption(option);
							   }
							  for(var i=0;i<maxlen1;i++){
									var o=MyGetObj(inputid+"_"+i);
									if(o&&o.options[o.selectedIndex].text!="请选择"){
										if(i==0){
										  window.classcaption=o.options[o.selectedIndex].text;
										}else{
										   window.classcaption+=">>"+o.options[o.selectedIndex].text;
										}
									}
							  }
							 
							 }
				             oParent.appendChild(oSelect);
			  }

			  
		  }
		};
		xmlHttp_.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
		xmlHttp_.send(str);

}
function MyGetObj(id){
	 return document.getElementById(id);
}
function ShowClassDiv1(obj,id){
	var oDiv=MyGetObj(id+"Div");
	if(oDiv.style.display=="none"){
		oDiv.style.display="";
	}else{
		oDiv.style.display="none";
	}
	//附加的
	var nav=MyGetObj(id+"Nav");
	if(nav!=null){
	  nav.style.display="none";
	}
}
