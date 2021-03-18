@extends('layouts.admin')
@section('title', 'Info')

@section('components')
    <script src="../js/info.js"></script>
@stop

@section('content')
    <div class="col-md-12">
        <button class="btn-primary form-control" id="btn-save"><i class="fa fa-save"></i> Lưu</button>
    </div>
    <div class="col-md-12">
        <div class="col-md-2 no-padding div-title" style="line-height: 150px;height: 150px;">
            Logo
        </div>
        <div class="col-md-6 form-group">
            <input type="file" name="logo-file" id="product-file" accept="image/*" onchange="readFile(this);">
            <img id="logo-image" src="{{$data[0]['logo']}}" height="150px">
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-2 no-padding div-title">
            Company name
        </div>
        <div class="col-md-6">
            <input type="text" id="name" class="form-control" value="{{$data[0]['name']}}">
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-2 no-padding div-title">
            Address 1
        </div>
        <div class="col-md-6">
            <input type="text" id="address1" class="form-control" value="{{$data[0]['address1']}}">
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-2 no-padding div-title">
            Address 2
        </div>
        <div class="col-md-6">
            <input type="text" id="address2" class="form-control" value="{{$data[0]['address2']}}">
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-2 no-padding div-title">
            Tel 1
        </div>
        <div class="col-md-6">
            <input type="text" id="tel1" class="form-control" value="{{$data[0]['tel1']}}">
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-2 no-padding div-title">
            Tel 2
        </div>
        <div class="col-md-6">
            <input type="text" id="tel2" class="form-control" value="{{$data[0]['tel2']}}">
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="col-md-2 no-padding div-title">
            Mail
        </div>
        <div class="col-md-6">
            <input type="text" id="mail" class="form-control" value="{{$data[0]['mail']}}">
        </div>
    </div>
    <style type="text/css">
        #logo-image {
            margin-top: 5px;
        }
        .div-title {
            font-weight: bold;
        }
    </style>
@endsection