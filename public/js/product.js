var param = '|'
$( document ).ready(function() {
    $('#link-product').addClass('active');
    $('#product-name').focus();
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
    //
    $(document).on('click','#image-content .image-group img',function(){
        $(this).parent().remove();
    });
});
function checkSave(){
    if( $('#product-name').val() == '' ){
        swal("Lỗi!", "Chưa nhập tên");
        return false;
    }
    if( $('#product-price').val() == '' ){
        swal("Lỗi!", "Chưa nhập giá");
        return false;
    }
    return true;
}
function checkDelete(){
    if( $('#product-id').val() == '' || $('#product-id').val() == '0' ){
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
            url         :   '/admin/product/left-content',
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
            var id          = Number($('#product-id').val());
            var category    = $('#category-id').val();
            var name        = $('#product-name').val();
            var price       = $('#product-price').val();
            var image       = '';
            $('#image-content img').each(function(){
                image += $(this).attr('src') + param;
            });
            var content = $('#product-content').val();
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/product/save',
                dataType    :   'json',
                data        :   {
                    id      : 	id,
                    category   :   category,
                    name    : 	name,
                    price   :   price,
                    image   :   image,
                    content :   content,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        id = res['id'];
                        $('#product-id').val(id);
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
            var id = Number($('#product-id').val());
            //
            $.ajax({
                type        :   'POST',
                url         :   '/admin/product/delete',
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
            console.log('refer' + e.message);
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
                url         :   '/admin/product/detail',
                dataType    :   'json',
                data        :   {
                    id      :   id,
                },
                success: function(res) {
                    //closeWaiting();
                    if( res['res'] == true ) {
                        var product = res['data'][0][0];
                        $('#product-id').val(id);
                        $('#category-id').val(product['ctg_id']);
                        $('#product-name').val(product['name']);
                        $('#product-price').val(product['price']);
                        $('#product-content').val(product['content']);
                        //
                        var images = res['data'][1];
                        if(images != undefined){
                            images.forEach(function(element) {
                                var html = $('#image-group-hidden').html().replace(/replace/g,element['id']);
                                html = html.replace('src=""','src="'+element['image']+'"');
                                $("#image-content").append(html);
                            });
                        }
                    }  
                },
            });
}
function clearDetail(row){
    if(row){
        $('#left-content table tr').removeClass('active');
    }
    $('#product-id').val('');
    $('#category-id').val('');
    $('#product-name').val('');
    $('#product-price').val('');
    $('#image-content').html('');
    $('#product-content').val('');
    //focus item
    $('#product-name').focus();
}
function readFile(file,id){
    if(file.files && file.files[0]){
        var reader = new FileReader();
        reader.onloadend = function (e) {
            $('#image-'+id).attr('src', e.target.result);                 
        };
        reader.readAsDataURL(file.files[0]);
    }
}
function addImage(){
    var element = $("#image-content");
    var id = element.find('input[type="file"]').last().attr('image');
    id = Number((id == undefined ? 0 : id)) + 1;
    var html = $('#image-group-hidden').html().replace(/replace/g,id);
    element.append(html);
    $('#file-'+id).trigger('click');
}