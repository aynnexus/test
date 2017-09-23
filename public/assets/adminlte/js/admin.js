function showLoading($status = true){
    if($status) {
        $(".loading-background").show();
        $("body").addClass("modal-open");
    }
    else {
        $(".loading-background").hide();
        $("body").removeClass("modal-open");
    }
}

function showNotification($msg,$type = 'success'){
    html = '<div class="alert alert-'+$type+'" style="display:none;">';
    html += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    html += $msg+"</div>";
    if($('.notification-panel').children().length >= 3){
        $('.notification-panel .alert').first().slideUp("slow").remove();
    }
    $(html).appendTo('.notification-panel').slideDown("fast");
}

function formSubmit(form){
    var formData = new FormData(form[0]);
    showLoading(true);
        $.ajax({
            headers: {'X-CSRF-TOKEN': window.Laravel.csrf_token},
            type: form.attr('method'),
            url: form.attr('action'),
            contentType: false,
            processData: false,
            data:formData,
            cache:false,
            success: function(data){
                if(data.status){
                    window.location = data.url;
                } else {
                    showLoading(false);
                    msg = '';
                    $.each(data.errors,function(index,data){
                        msg += data +"<br/>";
                    });
                    showNotification(msg,'danger');
                }
            },
            error: function(data){
                showLoading(false);
                showNotification("Connection error.Try again",'info');
            }
        });
}

$(document).ready(function(){
  setTimeout(function(){
    $('body .notification-panel .alert').fadeOut(function(){
      $(this).remove();
    });    
  },5000);  
});