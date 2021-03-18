<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>S.Canvas - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
        <script src="/js/common.js"></script>
        
        <!-- Page JS files -->      
        @yield('components')

    </head>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <?php
        use Illuminate\Support\Facades\DB;
        $Object = DB::select("call spc_info()");
        $info   = json_decode(json_encode($Object),true);
    ?>
    <body>
        <div class="header">    
            <header class="site-header ">
                <div class="container">
                    <div class="site-header-inner col-md-8 no-padding">
                        <div class="logo col-md-5 no-padding">
                            <a href="." class="logo-wrapper ">                  
                                <img src="{{$info[0]['logo']}}" height="50px" alt="logo ">                    
                            </a>
                        </div>
                        <div class="logo col-md-7 no-padding" style="margin-top: 20px;">
                            <input maxlength="100" class="form-control" id="txt-search-product">
                            <button class="btn-primary form-control" id="btn-search-product">Tìm kiếm</button>
                        </div>
                    </div>
                        
                    <div class="col-md-4 no-padding">
                        <div class="header-address col-md-12">
                            <i class="fa fa-phone"></i><a href="tel:{{$info[0]['tel1']}}"> {{$info[0]['tel1']}}</a>
                                 - <a href="tel:{{$info[0]['tel2']}}"> {{$info[0]['tel2']}}</a>
                                 <br>
                            <i class="fa fa-envelope-o"></i><a href="mailto:{{$info[0]['mail']}}"> {{$info[0]['mail']}}</a>
                            <br>
                            <i class="fa fa-map-marker" aria-hidden="true"></i><span>{{$info[0]['address1']}}</span>
                            <br>
                            <i class="fa fa-map-marker" aria-hidden="true"></i><span>{{$info[0]['address2']}}</span>
                        </div>
                    </div>

                </div>
            </header>
        </div>
        <section class="menu-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="cssmenu">
                            <ul>
                                <li class="active"><a id="page-home" href="/">Trang chủ</a></li>
                                <li><a id="page-product" href="/product">Sản phẩm</a></li>
                                <li><a id="page-news" href="/news">Bài viết</a></li>
                                <li><a id="page-map" href="/map">Bản đồ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="main container">
            @yield('content')
        </div>
        <footer>
            <div class="copyright clearfix">
                <div class="container text-center">
                    Copyright © {{$info[0]['name']}}
                </div>
            </div>
     </footer>
    </body>
</html>