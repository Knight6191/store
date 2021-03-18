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
        <script src="../js/refer.js"></script>

    </head>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
<body>
    <header class="site-header" style="height: 100px;">
    </header>
    <div class="container">
        <div class="col-md-5" id="left-content">
            @include('/admin/refer.leftcontent')
        </div>
        <div class="col-md-7">
            <div id="right-content">
                <div class="col-md-12 form-group">
                    <button class="btn-primary form-control" id="btn-save"><i class="fa fa-save"></i> Lưu</button>
                    <button class="btn-primary form-control" id="btn-add"><i class="fa fa-plus"></i> Tạo mới</button>
                    <button class="btn-danger form-control" id="btn-delete"><i class="fa fa-times"></i> Xóa</button>
                </div>
                <div class="col-md-12 form-group">
                    <div class="col-md-2 no-padding div-title">
                        ID
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="refer-id" disabled="disabled" value="" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <div class="col-md-2 no-padding div-title">
                        Tên
                    </div>
                    <div class="col-md-10">
                        <input type="text" id="refer-name" class="form-control" required="required">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <div class="col-md-2 no-padding div-title">
                        Link
                    </div>
                    <div class="col-md-10">
                        <input type="text" id="refer-link" class="form-control" required="required">
                    </div>
                </div>
            </div>
        </div>
        </div>
         <footer>
                <div class="copyright clearfix">
                    <div class="container text-center">
                        Copyright © haidepzai
                    </div>
                </div>
         </footer>
        </body>
    </body>
</html>
<style type="text/css">
    #left-content {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10;
        min-height: 500px;
    }
    #left-content table tr {
        cursor: pointer;
        height: 24px;
    }
    #left-content table tr:hover {
        background: #ddd;
    }
    #left-content table tr.active {
        background: gray;
    }
    #right-content {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10;
        min-height: 500px;
        margin-left: 10px;
    }
</style>