$( document ).ready(function() {
    $('#link-info').addClass('active');
    $('#btn-save').click(function () {
        saveInfo();
    });
});
function saveInfo(){
	try{ 
            $.ajax({
                type        :   'POST',
                url         :   '/admin/info/save',
                dataType    :   'json',
                data        :   {
                    logo: 	$('#logo-image').attr('src'),
                    name: 	$('#name').val(),
                    address1:$('#address1').val(),
                    address2:$('#address2').val(),
                    tel1: 	$('#tel1').val(),
                    tel2: 	$('#tel2').val(),
                    mail:   $('#mail').val(),
                },
                success: function(res) {
                    //closeWaiting();
                    if (typeof (res) != 'undefined') {
                        swal("Thông báo!", "Lưu thành công");
                    }  
                },
            });
        }catch(e){
            console.log('refer' + e.message);
        }
}
function readFile(file){
    if(file.files && file.files[0]){
        var reader = new FileReader();
        reader.onloadend = function (e) {
            $('#logo-image').attr('src', e.target.result);                 
        };
        reader.readAsDataURL(file.files[0]);
    }
}