<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body>
        <div class="content form-login">
            <div class="title m-b-md">
                <label>User</label>
                <input id="user_name" class="form-group form-control">
                <label>Password</label>
                <input id="user_pass" class="form-group form-control" type="password">
                <div class="col-md-12 no-padding text-center">
                    <button class="btn-primary form-control" id="btn_login">Login</button>
                </div>
            </div>
        </div>
    </body>
</html>
<style type="text/css">
    .form-login {
        width: 400px;
        margin: 20px auto;
    }
    #btn_login {
        display: inline-block;
        width: 80px;
    }
</style>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','#btn_login',function (){
        postLogin();
    });
    function postLogin(){
        try{ 
            $.ajax({
                type        :   'POST',
                url         :   'admin/login',
                dataType    :   'json',
                data        :   {
                    user: $('#user_name').val(),
                    pass: $('#user_pass').val(),
                },
                success: function(res) {
                    //closeWaiting();
                    if (typeof (res) != 'undefined') {
                        if (res['response'] == true) {
                            window.location.href = 'admin/info';
                        }else{
                           window.location.href = '/';
                        }
                    }  
                },
            });
        }catch(e){
            console.log('refer' + e.message);
        }
    }
</script>
