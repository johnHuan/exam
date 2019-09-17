// JavaScript Document
//创建分类选项
var MyAddStr="";
var SelectClassIdValue="";
function ClassOption(){
	 var ClassOption_={
		  init:function(opt){
			    var t=this;
				t.opt=opt;
				t.ajaxurl=opt.url;
				t.title=$("<span id='clas"+opt.id+"_title'></span>");
				t.parent=$("<span id='clas"+opt.id+"_panel'></span>");
				$("#"+opt.id).parent().append(t.parent);
				t.old_classno="";
				if(typeof(t.opt.classno)!="undefined"){
					t.old_classno=t.opt.classno;
				}
				t.show({fatherno:opt.fatherno,index:0});
		  },show:function(opt){
				var t=this;
				t.parent.find("select").each(function(i){
				  if(i>opt.index){$(this).remove();}//移除data-index比它大的select的
				})
			   $.ajax({
					url:t.ajaxurl,
					type:"post",
					data:{"act":"classoption",fatherno:opt.fatherno},
					dateType:"text",
					success:function(datastr){
						
						   var data=eval("("+datastr+")");
						   if(data.options!=null){
							if(data.options.length>0){
								 var qz_id="clas"+t.opt.id+"_sel_";
								 var index=t.parent.find("select").length;
							     var sel=$("<select id='"+qz_id+t.parent.find("select").length+"' data-index=\""+index+"\"></select>");
							     t.parent.append(sel);
								 sel.append("<option value=''>请选择</option>"); 
								 for(var i=0;i<data.options.length;i++){
									 var classno=data.options[i].classno;
									 var childcount=data.options[i].childcount;
									 var fatherno=data.options[i].fatherno;
									 var selected="";
										  if(t.old_classno!=""&&t.old_classno.substr(0,classno.length)==classno){
											   selected=" selected='selected' " ;
											   t.show({fatherno:classno,index:index});
										  }
									  sel.append("<option value='"+data.options[i].classno+"'  "+selected+">"+data.options[i].title+"</option>"); 
								 }
								 sel.change(function(){
											t.old_classno="";
											var option=$(this).find("option:selected");
											var index_a=parseInt($(this).attr("data-index"));
											if(option.attr("value")==""){
													t.parent.find("select").each(function(i){
													  if(i>index_a){$(this).remove();}//移除data-index比它大的select的
													}) 
											}else{
											 t.show({fatherno:option.attr("value"),index:index_a});
											 $("#"+t.opt.id).val(option.attr("value"));
											}
								 });
							}
						   }
					}
				})
		  }

	 }
	 return ClassOption_;
}