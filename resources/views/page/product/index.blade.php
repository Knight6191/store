@extends('layouts.main')
@section('title', 'Sản phẩm')
<style type="text/css">
    .item-product {
        margin-bottom: 10px;
    }
    .item-title {
        font-size: 22px;
        font-family: serif;
    }
</style>
@section('content')
<div class="col-md-3 col-sm-3">
    <label>Danh mục sản phẩm</label>
     @foreach($category as $item)
    <div class="col-md-12 col-sm-12">
        <a href="/product/{{$item['ctg_id']}}">{{$item['name']}}</a>
    </div>
    @endforeach
    </div>

    
    <div class="col-md-9 col-sm-9">
    @foreach($data as $item)
        <div class="col-md-12 col-sm-12 col-xl-4 col-lg-4">
            <div class="item-product">
                <a href="/product/detail/{{$item['id']}}">
                    <img class="item-img" src="{{$item['image']}}" alt="" style="width: 100%;">
                </a>
                <br>
                <a class="item-title" href="/product/detail/{{$item['id']}}">{{$item['name']}}</a>
                <br>
                <span class="item-price">{{$item['price']}}</span>
                <div class="item-content">
                    {!! nl2br(e($item['content'])) !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#page-product').addClass('active');
        });
    </script>
@endsection

