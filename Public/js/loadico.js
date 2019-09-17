var loadico={
    show:function(opt){
	   var body=document.getElementsByTagName("body")[0];
	   var a=document.getElementById("load");
	   if(!a){
	            var html="";
				var div=document.createElement("div");
				div.id="load";
				div.className="load";
				html+='<div class="load-rel">';
				html+='<div class="load-bg"></div>';
				html+='<div class="load-con" id="loadcon"></div>';
				html+='</div>';
				div.innerHTML=html;
				body.appendChild(div);
	   }
	   var ac=document.getElementById("loadcon");
	   var a=document.getElementById("load");
	   var txt="";
	   if(typeof(opt)=="undefined"){
	      txt="正在加载";
	   }else{
	     if(opt.txt==""){txt="正在加载";}else{txt=opt.txt; }
	   }

	    if(ac){ac.innerHTML=txt;}
		
	   if(a){a.style.display="";}
	   if(ac){ac.onclick=function(){if(a){a.style.display="none";}}}
	},hide:function(){
	   var a=document.getElementById("load");
	   window.setTimeout(function(){if(a){a.style.display="none";};},500);
	},init:function(){
	   var ac=document.getElementById("loadcon");
	   var a=document.getElementById("load");
	   if(ac){ac.onclick=function(){if(a){a.style.display="none";} }}
	}
}
loadico.show({txt:"<?php echo $_SESSION['msg'];?>"});