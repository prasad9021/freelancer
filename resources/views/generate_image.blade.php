<html>
<head>

</head>
<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<?php
    $i=1;
foreach ($arrStrRows as $arrStrRow){
    echo '<input id="url-'.$i.'" type="hidden" value="'.url('/template1/'.$arrStrRow['name'].'/'.$arrStrRow['id'].'/'.$arrStrRow['profile_pic']).'" />';
    $i++;
}
?>
<iframe id="iframe" src="" width="1" height="1" ></iframe>
<p>Processing: <span id="perc">0% completed</span> </p>
Do not refresh page..

<!-- add with javascript -->
<div class="container">
    <h2>Progressing</h2>
    <div class="progress"></div>
</div>

<script>
    $(document).ready(function(){
        var intCount = '<?php echo count($arrStrRows); ?>';
        var intPercentage = 0;
        var i = 0;


        setInterval(function(){
            var j = i + 1;

            $('#perc').text(Math.round(intPercentage)+'% completed');
            console.log(intCount + ' | ' + i);
            if(i == intCount) {
                return;
            }
            intPercentage = 100 * j / intCount;

            var strUrl = $('#url-'+j).val();
            console.log('strUrl: ' + strUrl);

            $('#iframe').attr('src',strUrl);

            i++;
        },5000);
    });


</script>

</body>
</html>
