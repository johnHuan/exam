function xuanxiang(){
var xuanxiang_={
   init:function(opt){
               var t=this;
			   t.opt=opt;
			   var html='<table cellspacing="1" cellpadding="10" class="table_option" style="max-width:400px;width:100%;">';
			       html+='<tr>';
			   t.colsnum=opt.fields.length+1;
				   for(var i=0;i<opt.fields.length;i++){
				    html+='<th>'+opt.fields[i].title+'</th>'; 
				   }
				   html+='<th>操作</th></tr>';
				   html+='</table><input type="button" class="btadd_xx"  value="添加选项" />';
				  // <tr><td><input type="text" value=""/></td><td><input type="text" value=""/></td><td>价格</td></tr>
			    t.rownum=0;
				var values=[];
				if(opt.values=="false"){opt.values="";}
				if(opt.values=="null"){opt.values="";}
				if(opt.values!=""){
			    	values=eval("("+opt.values+")");
				}
			   t.parent=$("#"+opt.parentid);
			   t.parent.html(html);
			   t.table=t.parent.find("table");
			   t.parent.find(".btadd_xx").click(function(){
			          t.add({fields:opt.fields,values:{"title":"规格名","price":"0"}});
			   });
			   if(values.length>0){
			     for(var i=0;i<values.length;i++){
			       t.add({fields:opt.fields,values:values[i]});
				 }
			   }else{
			     //t.add({fields:opt.fields});
			   }
			   
   },add:function(opt){
		  var t=this;
		  var tr="";
		  tr+='<tr>';
		  for(var i=0;i<opt.fields.length;i++){
			   var val="",type="";
			   if(typeof(opt.values)!="undefined"){
					val=opt.values[opt.fields[i].field];
					if(typeof(val)=="undefined"){
					  val="";
					}
			   }
			  if(typeof(opt.fields[i].type=="undefined")){
			   type="text";
			  }
			  tr+='<td><input type="text" value="'+val+'" style="width:90%;" class="txt_xx" name="'+t.opt.name+'['+t.rownum+']['+opt.fields[i].field+']" data-type="'+type+'" /></td>';
		  }
		  tr+='<td><input type="button" class="btdel_xx"  value="删除" /></td></tr>';
		  t.table.append(tr);
		  t.table.find(".btdel_xx").click(function(){
			 var p=$(this).parent().parent();
			 p.remove();
		  });
		  t.rownum++;
   }
}
return xuanxiang_;
}