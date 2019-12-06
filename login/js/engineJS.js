$(document).ready(function(){
    $('#user').select();
    $("#user").keydown(function(){
            $('#msj_alert').hide();
            $('#password').val('');
    });
    $("#password").keydown(function(){
            $('#msj_alert').hide();
    });
    $("#user").on('keyup', function (e) {
        if (e.keyCode === 13) {
           $('#password').focus();
        }
    });
    $("#password").on('keyup', function (e) {
        if (e.keyCode === 13) {
            get_login_acces();
        }
    });
});
function get_login_acces(){
    var user = $('#user').val();
    var password = $('#password').val();
    $.ajax({
        url: 'json_session.php',
        data:{user:user,password:password},
        type: 'POST',
        success:(function(res){
            if(res.estatus === 'declinado'){
                $('#msj_alert').show(200);
                $('#user').focus();
                $('#user').select();
            }else if(res.estatus === 'aceptado'){
                $('#form_login').submit();
            }
	})
    });
}