

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ; ?></title>
    <script src="{{ asset('themeadmin/js/jquery.1.7.2.min.js') }}"></script>
    <script src="{{ asset('themeadmin/js/respond.js') }}"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themeadmin/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themeadmin/css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themeadmin/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themeadmin/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themeadmin/style.ltr.css') }}">
</head>

<body>
<!-- Start Design -->
<header class="header noprint">
    <ul class="header-social-ul">
        <li><i class="fa fa-envelope"></i></li>
        <li><i class="fa fa-cog"></i></li>
        <li><i class="fa fa-comment"></i></li>
        <li><i class="fa fa-bell"></i></li>
    </ul>
    <span class="fa fa-bars visible-xs"></span>
    <div class="avatar-box">
        <div class="avatar"><img src="<?php if(empty($userdata->avatar)){echo '/themeadmin/images/user.png';} else{echo $userdata->avatar;}?>" alt="avatar"></div>
        <div class="avatar-title"><?php  echo $userdata->name;?> <i class="fa fa-angle-left"></i></div>
        <div class="inner-avatar-box">
            <ul class="iab-ul">
                <li><a href="/login/out">Log Out</a></li>
                <li><a href="/user/showuser/<?php  echo $userdata->id;?>">Profile</a></li>
               
            </ul>
        </div>
    </div>
</header>

<div id="overlay"></div>

@yield('sidebar')
