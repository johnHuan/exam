function kuang(){
	 var kuang_={
		  show:function(opt){
			 var body=document.getElementsByTagName("body")[0];
			 var parent=document.createElement("div");
			 parent.className="duihuakuang";
			  body.appendChild(parent);
			 var rel=document.createElement("div");
			 rel.className="rel";
			 parent.appendChild(rel);
			 var bg=document.createElement("div");
			 bg.className="bg";
			 rel.appendChild(bg);
			 var inner=document.createElement("div");
			 inner.className="inner";
			 rel.appendChild(inner);
			 var colse=document.createElement("div");
			 colse.className="colse";
			 colse.innerHTML="×";
			 rel.appendChild(colse);
			 colse.onclick=function(){
				 parent.parentNode.removeChild(duihuakuang);
			 }
			 var html="";
			 if(opt.type=="img"){
				 html="<img src='"+opt.src+"'/>";
			 }
			 if(opt.type=="text"){
				 html=opt.text;
			 }
			 inner.innerHTML="<table style='width:100%;height:100%;' cellspacing='0' cellpadding='0'><tr><td  style='width:100%;height:100%;'  align='center'>"+html+"</td></tr></table>";
		  },list:function(opt){
			 var body=document.getElementsByTagName("body")[0],t=this;
			 var parent=null;
			 if(typeof(opt.id)!="undefined"){
				 parent=t.byid({id:opt.id});
			 }
			 if(parent){
				    parent.style.display="";
			 }else{
					 var parent=document.createElement("div");
					 parent.className="duihuakuang";
					  body.appendChild(duihuakuang);
					 var rel=document.createElement("div");
					 rel.className="rel";
					 duihuakuang.appendChild(rel);
					 var bg=document.createElement("div");
					 bg.className="bg";
					 rel.appendChild(bg);
					 var inner=document.createElement("div");
					 inner.className="inner";
					 rel.appendChild(inner);
					 var colse=document.createElement("div");
					 colse.className="colse";
					 colse.innerHTML="×";
					 rel.appendChild(colse);
					 colse.onclick=function(){
						  if(typeof(opt.id)=="undefined"){
						      parent.parentNode.removeChild(parent);
						  }else{
							  parent.style.display="none";
						  }
					  }
					 var html="";
					 if(opt.type=="img"){ html="<img src='"+opt.src+"'/>";}
					 if(opt.type=="text"){html=opt.text; }
					 inner.innerHTML="<table style='width:100%;height:100%;' cellspacing='0' cellpadding='0'><tr><td  style='width:100%;height:100%;'  align='center'>"+html+"</td></tr></table>";
			 }
		 },byid(opt){
			  return document.getElementById(opt.id);
		 }
	}
}
