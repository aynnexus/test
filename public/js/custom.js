function Hide(argument){
    $(argument).addClass('dn');
}
function Show(argument) {
    $(argument).removeClass('dn');
}
function modelForm(click_id){ 
    var content = $('#modal-bodyku').html();
    var title = $('#myModalLabel').html();
    var footer = $('#modal-footerq').html();

    setModalBox(title, content,footer);
    $('#myModal'+click_id).modal('show');
}

// model box mention create function
function setModalBox(title, content, footer) {
    document.getElementById('modal-bodyku').innerHTML = content;
    document.getElementById('myModalLabel').innerHTML = title;
    document.getElementById('modal-footerq').innerHTML = footer;

    $('#myModal').attr('class', 'modal fade bs-example-modal-md')
    .attr('aria-labelledby', 'mySmallModalLabel');
    $('.modal-dialog').attr('class', 'modal-dialog modal-md');
}
// user Login form
function loginForm(attr){
    if (attr=='register') { 
        var content = $('#modal-bodyku').html();
        var title = $('#myModalLabel').html();
        var footer = $('#modal-footerq').html();
        Show('#modal-bodyku');Show('#modal-footerq');Show('#myModalLabel');
        Hide('#modal-bodyku-login');Hide('#modal-footerq-login');Hide('#myModalLabel-login');
        setModalBoxRegister(title, content, footer);
    }else{ 
        var content = $('#modal-bodyku-login').html();
        var title = $('#myModalLabel-login').html();
        var footer = $('#modal-footerq').html();
        Hide('#modal-bodyku');Hide('#modal-footerq');Hide('#myModalLabel');
        Show('#modal-bodyku-login');Show('#modal-footerq-login');Show('#myModalLabel-login');
        setModalBoxLogin(title, content, footer);
    }    
    $('#myModal').modal('show');  
    $('#myModal').attr('class', 'modal fade bs-example-modal-md')
                    .attr('aria-labelledby', 'mySmallModalLabel');
    $('.modal-dialog').attr('class', 'modal-dialog modal-md'); 
}
function setModalBoxRegister(title, content, footer) {
    document.getElementById('modal-bodyku').innerHTML = content;
    document.getElementById('myModalLabel').innerHTML = title;
    document.getElementById('modal-footerq').innerHTML = footer;    
}
function setModalBoxLogin(title, content, footer) { 
    document.getElementById('modal-bodyku-login').innerHTML = content;
    document.getElementById('myModalLabel-login').innerHTML = title;
    document.getElementById('modal-footerq').innerHTML = footer;   
}
