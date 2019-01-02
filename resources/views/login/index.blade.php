<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page </title>
    <script src="js/respond.js"></script>
    <!-- Bootstrap -->
     <link href="{{ asset('themeadmin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
     <link href="{{ asset('themeadmin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
     <link href="{{ asset('themeadmin/css/normalize.css') }}" rel="stylesheet" type="text/css" >
     <link href="{{ asset('themeadmin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
     <link href="{{ asset('themeadmin/style.login.css') }}" rel="stylesheet" type="text/css" >

</head>

<body class="login-body">

<!-- Login Form -->
<div class="container center-align">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-sm-push-3 col-md-push-4">
            <div class="niwanta-login">
                <div class="login-logo"><img src="{{ asset('themeadmin/images/logo.png') }}" alt="logo"></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <b>{{ $error }}</b><br/>
                            @endforeach
                       
                    </div>
                @endif
                   <form method="POST" class='login-form' action="/login">
                    {{ csrf_field() }}
                    <input type="email" placeholder="Email" name="email"  required>
                    <input type="password" placeholder="Password" name="password" required>
                    <input class="captcha-input" type="text" placeholder="Captcha" name="captcha" autocomplete="off" required>
                    <div class="lcc" id="chaptca">
                       <?php  echo captcha_img() ?>
                    </div>
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</div>


    
</body>
</html>
