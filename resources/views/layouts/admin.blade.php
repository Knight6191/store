<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>S.Canvas - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        <section class="menu-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="cssmenu">
                            <ul>
                                <li><a id="link-info" href="/admin/info">Quản lý thông tin</a></li>
                                <li><a  id="link-category" href="/admin/category"> Quản lý danh mục</a></li>
                                <li><a  id="link-product" href="/admin/product"> Quản lý sản phẩm</a></li>
                                <li><a  id="link-news" href="/admin/news"> Quản lý bài viết</a></li>
                                <li><a  id="link-slide" href="/admin/slide"> Quản lý Slide</a></li>
                                <li><a  id="link-order" href="/admin/product-order"> Quản lý đơn hàng</a></li>
                                <li class="pull-right"><a  id="link-logout" href="/logout"> Logout</a></li>
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
<style type="text/css">
    .menu-top>.container {
        width: 100%;
    }
</style>