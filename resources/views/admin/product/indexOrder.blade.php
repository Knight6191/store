@extends('layouts.admin')
@section('title', 'Product')

@php
    $stt = array(
        array('id' => 0, 'name' => 'Đang chờ'),
        array('id' => 1, 'name' => 'Đang xử lý'),
        array('id' => 2, 'name' => 'Đã hoàn thành'),
    );
@endphp

@section('content')
    <div class="col-md-12">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Mail</th>
                    <th>Địa chỉ</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                </tr>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['product_id']}}</td>
                        <td>{{$item['product_name']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['tel']}}</td>
                        <td>{{$item['mail']}}</td>
                        <td>{{$item['address']}}</td>
                        <td>{{$item['number']}}</td>
                        <td>
                            <select class="form-control">
                            @foreach($stt as $select)
                                <option value="{{$select['id']}}" {{$item['status']==$select['id']?'selected':''}}>{{$select['name']}}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </thead>
        </table>
    </div>
@endsection
@section('components')
    <script type="text/javascript">
        
    </script>
@stop
<style type="text/css">
    table {
        width: 100%;
    }
    table tr th {
        border: 1px solid black;
        padding: 2px 5px;
        background: #ddd;
    }
    table tr td {
        border: 1px solid black;
        padding: 2px 5px;
    }
</style>