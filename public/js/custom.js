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

function convertColor(type)
{   
    var color = '';
    switch (type){
        case 'Windows 8.1':
            color = '#00a65a';
            break;
        case 'Windows 8':
            color = '#00a65a';
            break;
        case 'Windows 7':
            color = '#00a65a';
            break;
        case 'Windows Vista':
            color = '#00a65a';
            break;
        case 'Windows Server 2003/XP x64':
            color = '#00a65a';
            break;
        case 'Windows XP':
            color = '#00a65a';
            break;
        case 'Windows 2k':
            color = '#00a65a';
            break;
        case 'Windows ME':
            color = '#00a65a';
            break;
        case 'Windows 98':
            color = '#00a65a';
            break;
        case 'Windows 95':
            color = '#00a65a';
            break;
        case 'Windows 3.11':
            color = '#00a65a';
            break;
        case 'Mac OS X':
            color = '#337ab7';
            break;
        case 'Mac OS 9':
            color = '##337ab7';
            break;
        case 'Linux':
            color = '#00c0ef';
            break;
        case 'Ubuntu':
            color = '#00c0ef';
            break;
        case 'iPhone':
            color = '#337ab7';
            break;
        case 'iPod':
            color = '#337ab7';
            break;
        case 'iPad':
            color = '#337ab7';
            break;
        case 'Android':
            color = '#f39c12';
            break;
        case 'BlackBerry':
            color = '#222d32';
            break;
        case 'Mobile':
            color = '#f39c12';
            break;
        case '':
            color = '#d2d6de';
            break;
        case 'Unknow':
            color = '#d2d6de';
            break;
    }
    return color;
}