<?php
 use App\Http\Controllers\TestController;

    ?>
<!DOCTYPE html>
<html><head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="{{url('/resources/js/html2canvas.js')}}" type="text/javascript"></script>
<style>

    input[type=text], select {
        width: 30%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 30%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>
</head>
<body>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<div id="file_upload_template">
    <form action="{{ route('importFile') }}" enctype="multipart/form-data" method="post" >
        @csrf
        <label for="">Choose Template</label><br>
        <select id="template" name="template">
            <option value="Template-1">Template 1</option>
            <option value="Template-2">Template 2</option>
            <option value="Template-3">Template 3</option>
        </select><br>
        <input type="file" id="file" name="file"><br><br>
        <input type="submit" value="Submit" name="btn_convert_to_image">
    </form>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    setTimeout(function(){
        $.post('http://localhost/freelancer/public/template1/prasad/77');
    },2000);
</script>
</body>
</html>
<script>

</script>
