@extends('layouts.admin')
@section('title', 'Product')

@section('components')
    <script src="../js/product.js"></script>
@stop

@section('content')
    <div class="col-md-5" id="left-content">
        @include('/admin/product.leftcontent')
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
                    Mã sản phẩm
                </div>
                <div class="col-md-4">
                    <input type="text" id="product-id" disabled="disabled" value="" class="form-control">
                </div>
                <div class="col-md-4 no-padding div-title">
                    <select class="form-control" id="category-id">
                        <option value="0"></option>
                        @foreach($category as $item)
                            <option value="{{$item['ctg_id']}}">{{$item['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Tên sản phẩm
                </div>
                <div class="col-md-10">
                    <input type="text" id="product-name" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Giá
                </div>
                <div class="col-md-10">
                    <input type="text" id="product-price" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Mô tả
                </div>
                <div class="col-md-10">
                    <textarea id="product-content" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="col-md-2 no-padding div-title">
                    Ảnh
                </div>
                <div class="col-md-10">
                    <button class="btn-primary" onclick="addImage();">add</button>
                    <div id="image-content"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<div class="hidden" id="image-group-hidden">
    <div id="image-group-replace" class="image-group">
        <input type="file" class="hidden" id="file-replace" image="replace" accept="image/*" onchange="readFile(this,replace);">
        <img id="image-replace" src="">
    </div>
</div>
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
    #product-image {
        max-width: 300px;
        max-height: 150px;
        padding-top: 10px;
    }
    .div-title {
        font-weight: bold;
    }
    #product-check {
        width: 20px;
        height: 20px;
    }
    #image-content .image-group {
        max-width: 120px;
        display: inline-block;
    }
    #image-content .image-group img {
        max-width: 120px;
        max-height: 120px;
    }
</style>