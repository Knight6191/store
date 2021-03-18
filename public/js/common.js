$(document).ready(function() {  
    $(document).ajaxStart(function () {
      callWaiting();
    });
    $(document).ajaxStop(function () {
       closeWaiting();
    });
    //click button search product
    $(document).on('click','#btn-search-product',function(){
        searchProduct();
    });
    $('#txt-search-product').keyup(function(e){
        if(e.keyCode == 13)
        {
            searchProduct();
        }
    });
});
//
function callWaiting() {
    $.blockUI({
        message: '<i class="fa fa-spinner"></i>',
        overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
        },
        css: {
            border: 0,
            color: '#fff',
            padding: 0,
            zIndex: 1201,
            backgroundColor: 'transparent'
        }
    });
}
function closeWaiting() {
    $.unblockUI({});
}
//search product
function searchProduct(){
    var name = $('#txt-search-product').val().trim();
    location.href = '/product?name='+name;
}