@extends('layouts.admin')
@section('title', 'Slide')

@section('components')
    <script src="../js/slide.js"></script>
@stop

@section('content')
    <div class="col-md-5" id="left-content">
        @include('slide.leftcontent')
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
                    <input type="text" id="slide-id" disabled="disabled" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Tên
                </div>
                <div class="col-md-10">
                    <input type="text" id="slide-name" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Link
                </div>
                <div class="col-md-10">
                    <input type="text" id="slide-link" class="form-control">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Mô tả
                </div>
                <div class="col-md-10">
                    <textarea id="slide-content" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Ảnh
                </div>
                <div class="col-md-10">
                    <input type="file" id="slide-file" accept="image/*" onchange="readFile(this);">
                    <img id="slide-image" src="">
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
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
    #slide-image {
        max-width: 300px;
        max-height: 150px;
        padding-top: 10px;
    }
    .div-title {
        font-weight: bold;
    }
</style>