$( document ).ready(function() {
    $('#link-news').addClass('active');
    $('#news-name').focus();
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
    if( $('#news-name').val() == '' ){
        swal("Lỗi!", "Chưa nhập tên");
        return false;
    }
    return true;
}
function checkDelete(){
    if( $('#news-id').val() == '' || $('#news-id').val() == '0' ){
        swal("Lỗi!", "Chọn 1 bài viết muốn xóa");
        return false;
    }
    return true;
}
 function leftContent(){
    try{
        var id = $('#left-content table tr.active td.item-id').text();
        $.ajax({
            type        :   'POST',
            url         :   '/admin/news/left-content',
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
            var id = Number($('#news-id').val());
            var name = $('#news-name').val();
            var des = $('#news-des').val();
            var content = $('#news-content').val();
            var image = $('#news-image').attr('src');
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/news/save',
                dataType    :   'json',
                data        :   {
                    id      : 	id,
                    name    : 	name,
                    des     :   des,
                    content :   content,
                    image   :   image,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        id = res['id'];
                        $('#news-id').val(id);
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
            var id = Number($('#news-id').val());
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/news/delete',
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
                url         :   '/admin/news/detail',
                dataType    :   'json',
                data        :   {
                    id      :   id,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        $('#news-id').val(id);
                        $('#news-name').val(res['data']['name']);
                        $('#news-des').val(res['data']['des']);
                        $('#news-content').val(res['data']['content']);
                        $('#news-file').val(null);
                        $('#news-image').attr('src',res['data']['image']);
                    }  
                },
            });
}
function clearDetail(row){
    $('#left-content table tr').removeClass('active');
    $('#news-id').val('');
    $('#news-name').val('');
    $('#news-des').val('');
    $('#news-content').val('');
    $('#news-file').val(null);
    $('#news-image').attr('src','');
    //focus item
    $('#news-name').focus();
}
function readFile(file){
    if(file.files && file.files[0]){
        var reader = new FileReader();
        reader.onloadend = function (e) {
            $('#news-image').attr('src', e.target.result);                 
        };
        reader.readAsDataURL(file.files[0]);
    }
}