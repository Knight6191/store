@extends('layouts.main')
@section('title', 'Chi tiết sản phẩm')

@section('content')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div class="col-md-4 col-sm-4">
        @foreach($data[1] as $image)
        <div class="column">
            <img src="{{$image['image']}}" style="width: 100%" onclick="openModal();currentSlide({{$image['id']}})" class="hover-shadow cursor">
        </div>
        @endforeach
        <div id="myModal" class="modal text-center">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">
                @foreach($data[1] as $image)
                <div class="mySlides">
                  <div class="numbertext"></div>
                  <img src="{{$image['image']}}">
                </div>
                @endforeach
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-8">
        <input type="hidden" name="" id="product_id" value="{{$data[0][0]['id']}}">
        <h2 class="item-title">{{$data[0][0]['name']}}</h2>
        <br>
        <span class="item-price">{{$data[0][0]['price']}}</span>
        <div class="col-md-12 no-padding">
          <input type="number" class="form-control" value="1" id="order-number">
          <button class="btn btn-primary" data-toggle="modal" data-target="#orderModal" id="btn-order">Đặt hàng</button>
        </div>
        <div class="item-content">
            {!! nl2br(e($data[0][0]['content'])) !!}
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Đặt hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-xs-6">
              <img src="{{$image['image']}}" style="max-width: 100%;">
            </div>
            <div class="col-xs-6">
               <input type="" name="" class="form-control form-group" id="txt_name" placeholder="Họ tên">
               <input type="" name="" class="form-control form-group" id="txt_tel" placeholder="Số điện thoại">
               <input type="" name="" class="form-control form-group" id="txt_mail" placeholder="Email">
               <input type="" name="" class="form-control form-group" id="txt_address" placeholder="Địa chỉ nhận hàng">
               <label id="text-order"></label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary" id="btn-save">Đặt hàng</button>
          </div>
        </div>
      </div>
    </div>
</div>
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#page-product').addClass('active');
            //show popup order
            $( document ).on('click','#btn-order',function() {
              // var price = $('.item-price').text();
              // var price = price.replace(/[^\d]/g, '');
              // var num   = $('#order-number').val();
              // var total = parseInt(price) * parseInt(num);
              // $('#text-order').html(total);
            });
            //save order
            $(document).on('click', '#btn-save', function(){
              if(checkOrder()){
                saveOrder();
              }
            });
        });
        //check required
    function checkOrder(){
      var isCheck = false
      if( $('#txt_name').val().trim() == '' ){
          swal("Lỗi!", "Vui lòng nhập tên");
          return false;
      }
      if( $('#txt_tel').val().trim() == '' ){
          swal("Lỗi!", "Vui lòng nhập số điện thoại");
          return false;
      }
      if( $('#txt_address').val().trim() == '' ){
          swal("Lỗi!", "Vui lòng nhập địa chỉ giao hàng");
          return false;
      }
      return true;
    }
    //save order
    function saveOrder(){
      $.ajax({
        type        :   'POST',
        url         :   '/admin/product/save-order',
        dataType    :   'json',
        data        :   {
          product_id: $('#product_id').val().trim(),
          name: $('#txt_name').val().trim(),
          tel: $('#txt_tel').val().trim(),
          mail: $('#txt_mail').val().trim(),
          address: $('#txt_address').val().trim(),
          number: $('#order-number').val().trim(),
        },
        success: function(res) {
          //closeWaiting();
          if( res['res'] == true ) {
              swal("Thông báo!", "Lưu thành công");
              closeModal();
          }  
        },
      });  
    }
    </script>
@endsection

<script type="text/javascript">
    function openModal() {
      document.getElementById('myModal').style.display = "block";
    }

    function closeModal() {
      document.getElementById('myModal').style.display = "none";
    }

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    //show slide
    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      var slides = slides[slideIndex-1];
      if(slides != undefined){
        slides.style.display = "block";
      }
      var dots = dots[slideIndex-1];
      if(dots != undefined){
        dots.className += " active";
        captionText.innerHTML = dots.alt;
      }
    }
</script>

<style type="text/css">
    .column {
      float: left;
      width: 50%;
      padding: 10px;
    }
    #order-number {
      width: 80px!important;
      float: left;
        margin-right: 10px;
    }
    /* The Modal (background) */
    #myModal.modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      overflow: auto;
      background-color: black;
      margin: 30px 60px;
      max-height: 700px;
    }
    /* Modal Content */
    #myModal .modal-content {
      position: relative;
      background-color: transparent!important;
      margin: auto;
      padding: 0;
    }
    #myModal .modal-content img {
        max-height: 700px;
    }
    
    /* The Close Button */
    #myModal .close {
      color: white!important;
      position: absolute;
      top: 10px;
      right: 25px;
      font-size: 60px!important;
      opacity: .8!important;
      z-index: 999;
    }

    .mySlides {
      display: none;
    }

    .cursor {
      cursor: pointer;
    }

    /* Next & previous buttons */
    .prev {
        left: 0;
    }
    .next{
        right: 0;
    }
    .prev, .next{
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      padding: 16px;
      color: white;
      font-weight: bold;
      font-size: 60px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      user-select: none;
      -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
      background-color: #dddd;
    }

    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }

    img {
      margin-bottom: -4px;
    }

    .caption-container {
      text-align: center;
      background-color: black;
      padding: 2px 16px;
      color: white;
    }

    .demo {
      opacity: 0.6;
    }

    .active,
    .demo:hover {
      opacity: 1;
    }

    img.hover-shadow {
      transition: 0.3s;
    }

    .hover-shadow:hover {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #orderModal .modal-body {
      display: inline-block;
    }
</style>