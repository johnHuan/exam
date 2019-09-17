// JavaScript Document
var dialog={
	Init:function(title_,str_,width_,height_,border_,second_,isclose_){//初始化
    this.second=parseInt(second_);
	this.left=0;this.width;this.top=0;this.border=border_;

	 this.oTiShi=document.getElementById("oTiShi");
	 this.oTiShiBg=document.getElementById("oTiShiBg");
	  this.oTiShiCon=document.getElementById("oTiShiCon");
	  this.oTiShiClose=document.getElementById("oTiShiClose");
	  this.oBody=document.getElementsByTagName("body")[0];
	  this.oBody.style.overflow="hidden";//隐藏滚动条
	  	this.clientWidth=document.documentElement.clientWidth;
	this.scrollHeight=document.documentElement.scrollHeight||document.body.scrollHeight;
	this.clientHeight=document.documentElement.clientHeight||document.body.clientHeight;
	
	if(this.scrollHeight<this.clientHeight){
	 this.scrollHeight=this.clientHeight;
	}
	 this.zindex=30010;
	 this.titleheight=30;
	 this.padding=0;
	 this.isclose=isclose_;
	var t=this;
	if(this.oTiShi==null){
		this.oTiShi=document.createElement("div");
		this.oTiShi.id="oTiShi";
		this.oTiShiBg=document.createElement("div");
		this.oTiShiBg.id="oTiShiBg";
		this.oTiShiBg.style.filter = "Alpha(Opacity=70)";
		this.oTiShiBg.onclick=function(){t.Close();};
		
		this.oBody.style.position="relative";
		this.oBody.insertBefore(this.oTiShiBg,null);
		this.oBody.insertBefore(this.oTiShi,null);
		this.oTiShiTitle=document.createElement("div");
		this.oTiShiTitle.innerHTML=" "+title_;
		
		this.oTiShi.appendChild(this.oTiShiTitle);
		
		this.oTiShiClose=document.createElement("div");
		this.oTiShiClose.id="oTiShiClose";
		this.SetStyle(this.oTiShiTitle,{width:"96%",height:this.titleheight+"px",lineHeight:this.titleheight+"px",opacity:0.7,paddingLeft:"2%",paddingRight:"2%",backgroundColor:'#000000',zIndex:this.zindex++,color:"#fff",fontSize:'12px',position:"relative"});
		this.SetStyle(this.oTiShiClose,{width:"30px",height:this.titleheight+"px",zIndex:this.zindex++,color:"#fff",fontSize:'12px',position:"absolute",top:"0px",right:"2%",textAlign:'right'});
		this.oTiShiTitle.appendChild(this.oTiShiClose);
		this.oTiShiClose.innerHTML="关闭 ";
		this.oTiShiClose.onclick=function(){
			 t.Close();
		}
		if(window.attachEvent){
			 // window.attachEvent('onscroll',function(){t.DialogSize()});
			  window.attachEvent('onresize',function(){t.DialogSize()});
		}else{
			 // window.addEventListener("scroll",function(){t.DialogSize()}, false );
			  window.addEventListener("resize",function(){t.DialogSize()}, false );
		} 
	
		this.oTiShiCon=document.createElement("div");
		this.oTiShiCon.id="oTiShiCon";
        this.oTiShi.appendChild(this.oTiShiCon);
	}
	
	if(title_==""){
		this.oTiShiTitle.style.display="none";
	}else{
		this.oTiShiTitle.style.display="";
	}
		if(isclose_==0){
			this.oTiShiClose.style.display="none";
		}else{
			this.oTiShiClose.style.display="";
		}
	//document.documentElement.scrollTop=0;
   //document.body.scrollTop=0;
    //
	this.width=width_;
	this.left=(this.clientWidth-this.width-this.padding*2-this.border*2)/2;
	this.height=height_;
	this.top=(document.documentElement.clientHeight-this.height)/2+(parseInt(document.body.scrollTop)==0?document.documentElement.scrollTop:document.body.scrollTop);
	
	this.oTiShiCon.innerHTML=str_;


	//this.oTiShi.innerHTML+="<div>"+str_+"</div>";
	this.SetStyle(this.oTiShiCon,{width:this.width+"px",height:this.height+"px",display:''});
	this.SetStyle(this.oTiShiBg,{width:this.clientWidth+"px",height:this.scrollHeight+"px",display:'',top:"0px",left:"0px",opacity:0.7,zIndex:this.zindex++,backgroundColor:'#000000',position:"absolute"});
	this.SetStyle(this.oTiShi,{width:this.width+"px",height:this.height+"px",display:'',top:this.top+"px",left:this.left+"px",padding:this.padding+"px",border:"solid #999 "+this.border+"px",zIndex:this.zindex++,backgroundColor:'#ffffff',position:"absolute"});
},//关闭
Close:function(){
	if(this.isclose!=0){
		this.oTiShiBg.style.display="none";
		this.oTiShi.style.display="none";
		
	}
	this.oBody.style.overflow="auto";;//显示滚动条
},//改变样式
SetStyle:function(obj,css){
  for(var atr in css){
    obj.style[atr] = css[atr];
  }
},DialogSize:function(){
   GetWH();
   var t=this;
   t.oTiShiBg.style.width=window.scrollWidth+"px";
   t.oTiShiBg.style.height=window.scrollHeight+"px";
   t.oTiShi.style.left=(window.clientWidth-t.width-t.padding*2-t.border*2)/2+window.scrollLeft+"px";
   t.oTiShi.style.top=(window.clientHeight-t.height)/2+window.scrollTop+"px";
   	
}
}//关闭
function CloseDialog(obj){
    var myFile=document.getElementById("myFile");
    var oTiShiBg=document.getElementById("oTiShiBg");
    var oTiShi=document.getElementById("oTiShi");
    var oBody=document.getElementsByTagName("body")[0];
 if(obj!=null&&obj.value=="确定"){
   if(myFile.value!=""){
    oTiShiBg.style.display="none";
    oTiShi.style.display="none";
    oBody.style.overflow="auto";;//显示滚动条
    }else{
    alert("请选择文件");
    }
}else{
    oTiShiBg.style.display="none";
    oTiShi.style.display="none";
    oBody.style.overflow="auto";;//显示滚动条
  }
}
function GetWH(){
	  window.scrollHeight=document.documentElement.scrollHeight||document.body.scrollHeight;	
	  window.scrollWidth=document.documentElement.scrollWidth||document.body.scrollWidth;
	  window.clientHeight=document.documentElement.clientHeight||document.body.clientHeight;
	  window.clientWidth=document.documentElement.clientWidth||document.body.clientWidth;
	  window.scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	  var oBody=document.getElementsByTagName("body")[0];
	  window.scrollLeft=document.documentElement.scrollLeft||document.body.scrollLeft; 
	 // oBody.style.overflow="hidden";//隐藏滚动条
		if ( document.compatMode!="CSS1Compat" ){
		  //alert("本文档未添加W3C的声明")
		    if(document.body){
		        window.clientHeight=document.body.clientHeight;
				window.scrollHeight=document.body.scrollHeight;
			}else{
				window.clientHeight=document.documentElement.clientHeight;
				window.scrollHeight=document.documentElement.scrollHeight;
			}
		 
		}
		// oBody.style.overflow="auto";
  }
//弹出
function mydialog(){
	var str='<table cellpadding="10" cellspacing="0" border="0" style="width:100%">';
	str+='<tr><td style="font-size:15px;color:#333">请选择csv文件</td></tr>';
	str+='<tr><td><input id="myFile" value="" type="text" disabled="disabled" style="width:100%"/></td></tr>';
	str+='<tr><td><iframe  src="Upload.php?ObjId=myFile&folder=images/&quan=" style="width:100%; height:22px;" frameborder="0" scrolling=no></iframe></td></tr>';
	str+='<tr><td style="text-align:center;"><input onclick="CloseDialog(this)" type="button" value="返回" style="height:40px;width:100px;" /><input onclick="CloseDialog(this)" type="button" value="确定"  style="height:40px;width:100px;"/></td></tr>';
	str+='</table>';
   dialog.Init('文件上传',str,300,230,10,0)
}
function tishi(str){
	CloseDialog(null);
}
//弹出
function ShowLoginDialog(type){
	if(type=="close"){
//		  var str='<table cellpadding="10" cellspacing="0" border="0" style="width:100%">';
//		  str+='<tr><td style="font-size:15px;color:#333">请选择csv文件</td></tr>';
//		  str+='<tr><td><input id="myFile" value="" type="text" disabled="disabled" style="width:100%"/></td></tr>';
//		  str+='<tr><td><iframe  src="Upload.php?ObjId=myFile&folder=images/&quan=" style="width:100%; height:22px;" frameborder="0" scrolling=no></iframe></td></tr>';
//		  str+='<tr><td style="text-align:center;"><input onclick="CloseDialog(this)" type="button" value="返回" style="height:40px;width:100px;" /><input onclick="CloseDialog(this)" type="button" value="确定"  style="height:40px;width:100px;"/></td></tr>';
//		  str+='</table>';
		  var str='<table style="width:100%;" border="0" cellspacing="0" cellpadding="10" class="reset_login">'
		  str+='<tr>'
		  str+='<td width="35%" align="right" style="line-height:30px;">用户名：</td>';
		  str+='<td width="65%" style="border-right:#dedede solid 1px;"><input type="text" name="UserName" id="UserName" class="input"/></td>';
		  str+='</tr>';
		  str+='<tr>';
		  str+='<td align="right"  style="line-height:30px;">密　码：</td>';
		  str+='<td style="border-right:#dedede solid 1px;"><input name="PassWord" type="password" id="PassWord"  class="input"/></td>';
		  str+='</tr>';
		  str+='<tr style="display:none;">';
		  str+='<td align="right">验证码：</td>';
		  str+='<td><input name="Code" type="text" class="code input" id="Code" style="float:left;width:40px;"/><img id="Code1" class="code1" onclick="mycode()" alt="看不清楚?请点击刷新" src="system/getcode.php"/></td>';
		  str+='</tr>';
		  str+='<tr>';
		  str+='<td colspan="2" align="center" style="border-right:#dedede solid 1px;"><input type="button" name="Submit" value="重　置"  onclick="clearinput()"/>        <input type="button" name="Submit2" value="登　录"  onclick="login('+"''"+')"/></td>';
		  str+='</tr>';
		  str+='</table>';
		 dialog.Init('<div style="text-align:center;color:#fff;font-size:15px;">重新登入</div>',str,300,180,10,0,0);
		 $fs("UserName").value=username;
		 $fs("PassWord").value="";
	}
}
function ShowImageDialog(obj){
	//alert("11");
	//obj.href="#4444444444";
	//return false;
}
function SelectErWeiMaDialog(){
	var list="";
	
	list+="<div class='tab'><a onclick='TabErWeiMa(this,1)' class='cur'>生成二维码</a><a onclick='TabErWeiMa(this,2)' >选择二维码</a></div>";
	var fsPiCiName=$fs("fsPiCiName");
	var piciname="";
	if(fsPiCiName.value!=""){
		piciname="一组"+fsPiCiName.value+"的二维码";
	};

	list+="<div id='page1' class='tabcon'><table style=\"width:100%;\" cellpadding=\"10\" cellspacing=\"0\" class=\"table_erwei\"><tr><td>二维码组名</td><td><input type='text' id='fsErWeiMaName' value='"+piciname+"' style='width:94%;'/></td></tr><tr><td>生成个数</td><td><input type='text' id='fsErWeiMaCount' />一次最多生成10000个</td></tr><tr><td colspan='2' style='text-align:center;'><input type='button' value='生成一组二维码' onclick=\"AddErWeiMa(this)\"/></td></tr></table></div>";
	list+="<div id='page2' style='display:none' class='tabcon'></div><div class='tabcolse'><input type='button' value='关闭' onclick='CloseDialog()'/></div>";
	dialog.Init('',"<div class='tab_erweima'>"+list+"</div>",400,250,10,0,0);
	
	
		var  str="state=Options&ThisTable=erweima_class"+MyAddStr;
	  	CreateXmlHttp1();
	    xmlHttp1.open("POST",url,true);
	    xmlHttp1.onreadystatechange=function(){
		  if(xmlHttp1.readyState==4){
				var str1=xmlHttp1.responseText.replace(/[\r\n]/g, "");
				if(str1=="close"){
					ShowLoginDialog('close');
				}else{
					var arr=str1.split("[]");
					var len=arr.length;
					
					var page2=document.getElementById("page2");
					if(len==1){
						page2.innerHTML="<div class='divnull'>没有可选的二维码组，请生成!</div>";
					}else{
						var list="<ul>";
					
						for(var i=1;i<(len);i++){
							
							var items=arr[i].split("||");
							list+="<li myname=\""+items[0]+"\" myvalue=\""+items[1]+"\"  mycount=\""+items[2]+"\" myurl=\""+items[3]+"\" myid=\""+items[4]+"\" onclick=\"SelectPiCiErWeiMa(this)\">"+items[0]+":"+items[1]+"</li>";
						}
						list+="</ul>";
						page2.innerHTML=list;
						//alert(str1);
					}
					
				}
			
		  }
		}
		xmlHttp1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
	    xmlHttp1.send(str);
	
	//Options({id:"fsErWeiMaClassId",addstr:"&fsProductId=0&state=Options&ThisTable=erweima_class"});
}
function TabErWeiMa(obj,index){
	var page1=$fs("page1");
	var page2=$fs("page2");
	page1.style.display=(index==1?"":"none");
	page2.style.display=(index==2?"":"none");
	var parent=obj.parentNode;
	var childs=parent.childNodes;
	for(var i=0;i<childs.length;i++){
		if((i+1)==index){
		   childs[i].className="cur";
		}else{
			childs[i].className="";
		}
	}
}

function ShowMap(opt){
	
	  var str="<div style='height:100%; position:relative;'>";
	  str+="<div  id='allmap' style='position:absolute;width:100%;top:0px;left:0px; height:100%; z-index:60000;'></div>";
	  str+="<div   style='position:absolute;width:100%; height:40px; line-height:40px; left:0px; bottom:0px; z-index:60001; text-align:center;'><input type='button' value='确定' id='btn_ok'/>&nbsp;<input type='button' value='返回' id='btn_back_map' /></div>";
	  str+="</div>";
	  GetWH();
	  dialog.Init('',str,window.clientWidth-20,window.clientHeight-40,0,0,0);
	  
	  // 百度地图API功能
	  var txtMap=document.getElementById("map");
	  var txtAddress=document.getElementById("address");
	  var txtPhone=document.getElementById("phone");
	  var x=116.404,y=39.915;
	  if(txtMap.value!=""){
		   var arr=txtMap.value.split("#");
		   x=arr[0];
		   y=arr[1];
	  }
	  var map = new BMap.Map("allmap");
	  map.centerAndZoom(new BMap.Point(x, y), 14);
	  // 创建标注
	  var marker1 = new BMap.Marker(new BMap.Point(x, y));  
	  map.addOverlay(marker1);              // 将标注添加到地图中
	  
	  //在标注中在创建信息窗口
	  var infoWindow1 = new BMap.InfoWindow("地址："+txtAddress.value+"<br/>联系电话:"+txtPhone.value);
	  marker1.addEventListener("click", function(){this.openInfoWindow(infoWindow1);});

	  map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
      map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
      //获取当前经纬度
	  var xy="";
	  function showInfo(e){
	   //alert(e.point.lng + ", " + e.point.lat);
	   xy=e.point.lng + "#" + e.point.lat;
	  }

      map.addEventListener("click", showInfo);
	  
	    var btn_back_map=document.getElementById("btn_back_map");
		btn_back_map.onclick=function(){
			CloseDialog(null);
		}
	   btn_ok.onclick=function(){
		   if(xy!=""){
			   if(opt&&opt.formid){
				   document.getElementById(opt.formid).submit();
			   }
			   CloseDialog(null);
		      txtMap.value=xy;
		   }else{
			   alert("请选择");
		   }
	  }
}