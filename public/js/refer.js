$( document ).ready(function() {
    //$('#link-product').addClass('active');
    $('#refer-name').focus();
    //button save
    $(document).on('click','#btn-save',function(){
        if( checkSave() ){
            save();
        }
    });
    //button add new
    $(document).on('click','#btn-add',function(){
         clearDetail();
    });
    //button delete
    $(document).on('click','#btn-delete',function(){
        if( checkDelete() ){
            daleteDetail();
        }
    });
    //click left content
    $(document).on('click','#left-content table tr',function(){
        showDetail($(this));
    });
});
function checkSave(){
    if( $('#refer-link').val() == '' ){
        swal("Lỗi!", "Chưa nhập link");
        return false;
    }
    return true;
}
function checkDelete(){
    if( $('#refer-id').val() == '' || $('#refer-id').val() == '0' ){
        swal("Lỗi!", "Chọn 1 sản phẩm muốn xóa");
        return false;
    }
    return true;
}
 function leftContent(){
    try{
        var id = $('#left-content table tr.active td.item-id').text();
        $.ajax({
            type        :   'POST',
            url         :   '/haidepzai/left-content',
            dataType    :   'html',
            data        :   {
            },
            success: function(res) {              
                var json = $.parseJSON(res);
                $('#left-content').empty();
                $('#left-content').append(json.html);
                if(Number(id)==0){
                    $('#left-content table tr:last').addClass('active');
                    return;
                }
                $('#left-content table tr td.item-id').each(function(){
                    if($(this).text()==id){
                        $(this).parent().addClass('active');
                        return;
                    }
                });
            },
        });    
    }catch(e){
        alert('leftContent: ' + e.message);
    }
 }
function save(){
	try{ 
            var id = Number($('#refer-id').val());
            var name = $('#refer-name').val();
            var link = $('#refer-link').val();
            //
            $.ajax({
                type        :   'POST',
                url         :   '/haidepzai/save',
                dataType    :   'json',
                data        :   {
                    id      : 	id,
                    name    : 	name,
                    link    :   link,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        id = res['id'];
                        $('#refer-id').val(id);
                        leftContent();
                        swal("Thông báo!", "Lưu thành công");
                    }  
                },
            });
        }catch(e){
            console.log('refer' + e.message);
        }
}
function daleteDetail(){
    try{ 
            var id = Number($('#refer-id').val());
            //
            $.ajax({
                type        :   'POST',
                url         :   '/haidepzai/delete',
                dataType    :   'json',
                data        :   {
                    id      :   id,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        swal("Thông báo!", "Xóa thành công");
                        $('#left-content table tr.active').remove();
                        clearDetail();
                    }else{
                        swal("Lỗi!", "Xóa bị lỗi");
                    }
                },
            });
        }catch(e){
            console.log('refer' + e.message);
        }
}
function showDetail(row){
    $('#left-content table tr').removeClass('active');
    row.addClass('active');
    var id = row.find('.item-id').text();
    //
    $.ajax({
                type        :   'POST',
                url         :   '/haidepzai/detail',
                dataType    :   'json',
                data        :   {
                    id      :   id,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        $('#refer-id').val(id);
                        $('#refer-name').val(res['data']['name']);
                        $('#refer-link').val(res['data']['link']);
                    }  
                },
            });
}
function clearDetail(row){
    $('#left-content table tr').removeClass('active');
    $('#refer-id').val('');
    $('#refer-name').val('');
    $('#refer-link').val('');
    //focus item
    $('#refer-name').focus();
}