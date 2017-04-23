<!doctype html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmTWqtcbhdnNXdv-Ow60PedAtYwYgbQ5Q&callback=initMap">
</script>
<style>
    map {
        height: 100%;
        width: 100%;
        float: left;
    }
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
<script>

    function initMap() {

        var map = new google.maps.Map(
            document.querySelector("map"),
            {
                center:<?php echo $_GET["pos"];?>,
                zoom:12
            }
        );
        var marker = new google.maps.Marker(
            {
                position:<?php echo $_GET["pos"];?>,
                map:map
            }
        );



    }
</script>

<map>

</map>
</body>
</html>