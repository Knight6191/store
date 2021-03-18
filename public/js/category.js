$( document ).ready(function() {
    $('#link-category').addClass('active');
    $('#category-name').focus();
    //button save
    $(document).on('click','#btn-save',function(){
        if( checkSave() ){
            save();
        }
    });
    //button add new
    $(document).on('click','#btn-add',function(){
         clearDetail(true);
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
    if( $('#category-name').val() == '' ){
        swal("Lỗi!", "Chưa nhập tên");
        return false;
    }
    return true;
}
function checkDelete(){
    if( $('#category-id').val() == '' || $('#category-id').val() == '0' ){
        swal("Lỗi!", "Chọn 1 danh mục muốn xóa");
        return false;
    }
    return true;
}
 function leftContent(){
    try{
        var id = $('#left-content table tr.active td.item-id').text();
        $.ajax({
            type        :   'POST',
            url         :   '/admin/category/left-content',
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
            var id = Number($('#category-id').val());
            var check = $('#category-check').is(':checked')==true?'1':'0';
            var name = $('#category-name').val();
            var image = $('#image-1').attr('src');
            var content = $('#category-content').val();
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/category/save',
                dataType    :   'json',
                data        :   {
                    id      : 	id,
                    check   :   check,
                    name    : 	name,
                    image   :   image,
                    content :   content,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        id = res['id'];
                        $('#category-id').val(id);
                        leftContent();
                        swal("Thông báo!", "Lưu thành công");
                    }  
                },
            });
        }catch(e){
            console.log('save:' + e.message);
        }
}
function daleteDetail(){
    try{ 
            var id = Number($('#category-id').val());
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/category/delete',
                dataType    :   'json',
                data        :   {
                    id      :   id,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        swal("Thông báo!", "Xóa thành công");
                        $('#left-content table tr.active').remove();
                        clearDetail(true);
                    }else{
                        swal("Lỗi!", "Xóa bị lỗi");
                    }
                },
            });
        }catch(e){
            console.log('daleteDetail:' + e.message);
        }
}
function showDetail(row){
    $('#left-content table tr').removeClass('active');
    row.addClass('active');
    var id = row.find('.item-id').text();
    clearDetail(false);
    //
    $.ajax({
                type        :   'POST',
                url         :   '/admin/category/detail',
                dataType    :   'json',
                data        :   {
                    id      :   id,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        var category = res['data'][0];
                        $('#category-id').val(id);
                        $('#category-check').prop('checked',category['is_home']=='1'?true:false);
                        $('#category-name').val(category['name']);
                        $('#image-1').attr('src',category['image']);
                        $('#category-content').val(category['content']);
                    }  
                },
            });
}
function clearDetail(row){
    if(row){
        $('#left-content table tr').removeClass('active');
    }
    $('#category-id').val('');
    $('#category-check').prop('checked',false);
    $('#category-name').val('');
    document.getElementById("file-1").value = "";
    $('#image-1').removeAttr('src');
    $('#category-content').val('');
    //focus item
    $('#category-name').focus();
}
function readFile(file){
    if(file.files && file.files[0]){
        var reader = new FileReader();
        reader.onloadend = function (e) {
            $('#image-1').attr('src', e.target.result);                 
        };
        reader.readAsDataURL(file.files[0]);
    }
}