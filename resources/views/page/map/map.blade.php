@extends('layouts.main')
@section('title', 'Trang chủ')

@section('content')
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.9561140659216!2d108.19201101485777!3d16.015799888913953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421a2bf4af966f%3A0x44f0ae491be2f15a!2zNSBQaOG6oW0gVmnhur90IENow6FuaCwgQ-G6qW0gTOG7hywgxJDDoCBO4bq1bmc!5e0!3m2!1svi!2s!4v1532351997053" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#page-map').addClass('active');
    });
</script>
@endsection