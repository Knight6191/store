@extends('layouts.main')
@section('title', 'Bài viết')
<style type="text/css">
    .item-news {
        margin-bottom: 10px;
    }
    .item-title {
        font-size: 22px;
        font-family: serif;
    }
</style>
@section('content')
    @foreach($data as $item)
        <div class="col-md-12 col-sm-12 col-xl-4 col-lg-4">
            <div class="item-news">
                <a href="/news/{{$item['id']}}">
                    <img class="item-img" src="{{$item['image']}}" alt="" style="height: 200px;width: 100%;">
                </a>
                <br>
                <a class="item-title" href="/news/{{$item['id']}}">{{$item['name']}}</a>
                <br>
                <div class="item-content">
                    {!! nl2br(e($item['content'])) !!}
                </div>
            </div>
        </div>
    @endforeach
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#page-news').addClass('active');
        });
    </script>
@endsection

