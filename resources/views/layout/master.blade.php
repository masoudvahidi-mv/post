<html>

<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href={{asset('css/custom.css')}}>
    <script src="https://kit.fontawesome.com/09b1f2949b.js" crossorigin="anonymous"></script>
</head>

<body>
<nav>
    <div class="container">
        <div class="row fnavrow">
            <div class="col-md-2 col-sm-5 col-xs-5 zpadding companylogo">
                <img src="{{asset('imgs/images.png')}}" class="logo">
                <h4 class="logodesc">Aloware</h4>
            </div>
            <div class="col-md-1 col-sm1 col-xs-1">

            </div>
            <div class="col-md-7  naving">
                <div class="topnav" id="myTopnav">
                    <a href="#">Overview</a>
                    <a href="#" class="mgl30">Posts</a>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6">
                <a href="javascript:void(0);" class="icon hamb" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                <img src="{{asset('imgs/ms.jpg')}}" class="profileicon">
                <i class="far fa-bell notificon"></i>
            </div>
        </div>
        <div class="row">
            <div class="topnav" id="myTopnav1">
                <a href="# " class="mgl10 mgt10">Overview</a>
                <a href="# " class="mgl10">Posts</a>
            </div>
        </div>
        <hr class="hrnav">
        <div class="row ">
            <h2 class="navinfo">
                Posts
            </h2>
        </div>
    </div>
</nav>
<div class="container-fluid " id="maincontainer">
    @yield('content')
    @stack('script')
    <script src="js/nav.js "></script>
</body>

</html>
