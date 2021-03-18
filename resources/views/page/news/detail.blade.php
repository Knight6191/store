@extends('layouts.main')
@section('title', 'Chi tiết bài viết')
<style type="text/css">
    .item-title {
        font-size: 22px;
        font-family: serif;
    }
    .item-price {
        
    }
</style>
@section('content')
    <div class="col-md-4 col-sm-4">
        <img class="item-img" src="{{$data[0]['image']}}" width="100%">
    </div>
    <div class="col-md-8 col-sm-8">
        <h2 class="item-title">{{$data[0]['name']}}</h2>
        <div class="item-content">
            {!! nl2br(e($data[0]['content'])) !!}
        </div>
    </div>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#page-news').addClass('active');
        });
    </script>
@endsection

