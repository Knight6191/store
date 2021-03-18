$( document ).ready(function() {
    $('#link-slide').addClass('active');
    $('#slide-name').focus();
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
    if( $('#slide-name').val() == '' ){
        swal("Lỗi!", "Chưa nhập tên");
        return false;
    }
    return true;
}
function checkDelete(){
    if( $('#slide-id').val() == '' || $('#slide-id').val() == '0' ){
        swal("Lỗi!", "Chọn 1 slide muốn xóa");
        return false;
    }
    return true;
}
 function leftContent(){
    try{
        var id = $('#left-content table tr.active td.item-id').text();
        $.ajax({
            type        :   'POST',
            url         :   '/admin/slide/left-content',
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
            var id = Number($('#slide-id').val());
            var name = $('#slide-name').val();
            var link = $('#slide-link').val();
            var content = $('#slide-content').val();
            var image = $('#slide-image').attr('src');
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/slide/save',
                dataType    :   'json',
                data        :   {
                    id      : 	id,
                    name    : 	name,
                    link    :   link,
                    content :   content,
                    image   :   image,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        id = res['id'];
                        $('#slide-id').val(id);
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
            var id = Number($('#slide-id').val());
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/slide/delete',
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
                url         :   '/admin/slide/detail',
                dataType    :   'json',
                data        :   {
                    id      :   id,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        $('#slide-id').val(id);
                        $('#slide-name').val(res['data']['name']);
                        $('#slide-link').val(res['data']['link']);
                        $('#slide-content').val(res['data']['content']);
                        $('#slide-file').val(null);
                        $('#slide-image').attr('src',res['data']['image']);
                    }  
                },
            });
}
function clearDetail(row){
    $('#left-content table tr').removeClass('active');
    $('#slide-id').val('');
    $('#slide-name').val('');
    $('#slide-link').val('');
    $('#slide-content').val('');
    $('#slide-file').val(null);
    $('#slide-image').attr('src','');
    //focus item
    $('#slide-name').focus();
}
function readFile(file){
    if(file.files && file.files[0]){
        var reader = new FileReader();
        reader.onloadend = function (e) {
            $('#slide-image').attr('src', e.target.result);                 
        };
        reader.readAsDataURL(file.files[0]);
    }
}