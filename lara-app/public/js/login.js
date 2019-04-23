// laravel X-CSRF TOKEN used so that every post request to the would be accepted an handeled
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});

// attempts a 'fake redirection' if the user has a jwt token in his local storage
if( localStorage.getItem('token') ){
    $.ajaxSetup({
        headers: {
            'Authorization': 'bearer '+ localStorage.getItem('token'),
        }
    });
    var request = $.get('/');
    request.done(function(data){
        $('html').html(data);
    });

    request.fail(function(){
        localStorage.removeItem('token');
    });
}

// attemps logging in From the login page
$(document).on('submit', 'form#login_form',function(){
    var unamee = $('#uname').val();
    var passwordd= $('#password').val();

    var postData = {'uname': unamee, 'password':passwordd};

    $.ajax({
        url:     "/login",
        type:    "POST",
        data: postData,
        dataType: 'text',
        success: function(data) {
            var token = JSON.parse(data).token;
            localStorage.setItem('token', token);
            // Set the jwt token header for every ajax request
            $.ajaxSetup({
                headers: { 'Authorization': 'bearer ' + token }
            });
            $.get('/',function(data){
                $('html').html(data);
            });
        },
        // Error handling
        error:   function(jqXHR, textStatus, errorThrown) {
            if(jqXHR.status != 200) {
                $('#badLoginMessage').text('Invalid Credentials!');
                localStorage.removeItem('token');
            }
        }
    });
    return false;
});
