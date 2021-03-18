<!-- <input id="name-search" class="form-control">
<button id="btn-search" class="btn-primary">Search</button> -->
<table width="100%">
    @foreach($data as $item)
    <tr>
        <td class="item-id">{{$item['id']}}<td>
        <td class="item-name">{{$item['name']}}<td>
        <td class="item-price">{{$item['price']}}<td>
    </tr>
    @endforeach
</table>