function submitForm(form_attr){
  const form = form_attr[0];
	$.ajax({		
		type: "post",
		url: $(form).attr('action'),		
        processData: false,
        contentType: false,
        data: new FormData(form),
        success:function(data){  
         	if (data.meta==true) {
         		
         	}
		}
	});
}