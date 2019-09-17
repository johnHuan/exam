function mycheck(formid){
   var form1=$("#"+formid);
	var inputs=form1.find(".txt");
	var data={};
	for(i=0;i<inputs.length;i++){
	   var input=inputs.eq(i);
	   var placeholder=input.attr("placeholder");
	   var datatype=input.attr("data-type");
	   var databijiao=input.attr("data-bijiao");
	   var databijiaotishi=input.attr("data-bijiao-tishi");
	   if(placeholder!=null){
	       if(datatype!=null){
		      if(datatype=="phone"){
			     if(input.val()==""||input.val().length!=11){
						myalert(input.attr("placeholder"));
						input[0].focus();
						return false;
				 }
			  }
		   }else{
				   if(input.attr("type")=="radio"){
					  var val=form1.find("input[name='"+input.attr("name")+"']:checked").val();
					  if(typeof(val)=="undefined"){
						  myalert(input.attr("placeholder"));
						  return false;
					  }
				   }else if(input.attr("type")=="checkbox"){
					  var val=form1.find("input[name='"+input.attr("name")+"']:checked").val();
					  if(typeof(val)=="undefined"){
						  myalert(input.attr("placeholder"));
						  return false;
					  }
				   }else if(input.val()==""){
					  myalert(input.attr("placeholder"));
					  input[0].focus();
					  return false;
				   }
		   }
	       if(databijiao!=null){
		     var input1=$("input[name='"+databijiao+"']");
		      if(input.val()!=input1.val()){
			     myalert(databijiaotishi);
			     input[0].focus();
			     return false;
			  }
		   }
	   }
	   if(input.attr("type")=="radio"){
	       var val=form1.find("input[name='"+input.attr("name")+"']:checked").val();
		   if(typeof(val)!="undefined"){
		     data[input.attr("name")]=val;
		   }
	   }else if(input.attr("type")=="checkbox"){
	       var val=form1.find("input[name='"+input.attr("name")+"']:checked").val();
		   if(typeof(val)!="undefined"){
		     data[input.attr("name")]=val;
		   }else{
		      data[input.attr("name")]=0;
		   }
	   }else{
	       data[input.attr("name")]=input.val();
	   }
	}
	 console.log(data);
	var action=form1.attr("action");
	$.ajax({
	url:action,
	type:"post",
	data:data,
	dataType:"text",
	success:function(data){
	   var json=eval("("+data+")");
	   if(!json){
	       myalert("修改失败");
	   }else if(json.status=="error"){
	       myalert(json.msg);
	   }else if(json.status=="success"){
	       myalert(json.msg);
	   }else if(json.status=="1"){
	       myalert(json.info);
	   }
	}
	})
	return false;
}