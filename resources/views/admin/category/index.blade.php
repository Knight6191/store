@extends('layouts.admin')
@section('title', 'Category')

@section('components')
    <script src="../js/category.js"></script>
@stop

@section('content')
    <div class="col-md-5" id="left-content">
        @include('/admin/category.leftcontent')
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
                    Mã danh mục
                </div>
                <div class="col-md-4">
                    <input type="text" id="category-id" disabled="disabled" value="" class="form-control">
                </div>
                <div class="col-md-offset-1 col-md-3 no-padding div-title">
                    Hiển thị trang chủ
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="category-check">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Tên danh mục
                </div>
                <div class="col-md-10">
                    <input type="text" id="category-name" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Mô tả
                </div>
                <div class="col-md-10">
                    <textarea id="category-content" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Ảnh
                </div>
                <div class="col-md-10">
                    <input type="file" id="file-1" accept="image/*" onchange="readFile(this);">
                    <img id="image-1">
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
        min-height: 600px;
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
        min-height: 600px;
        margin-left: 10px;
    }
    #category-image {
        max-width: 300px;
        max-height: 150px;
        padding-top: 10px;
    }
    .div-title {
        font-weight: bold;
    }
    #category-check {
        width: 20px;
        height: 20px;
    }
    img#image-1 {
        width: 200px;
        margin-top: 10px; 
    }
</style>