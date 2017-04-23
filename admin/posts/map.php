<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmTWqtcbhdnNXdv-Ow60PedAtYwYgbQ5Q&callback=initMap">
</script>

<script>

    function initMap() {

        var map = new google.maps.Map(
            document.querySelector("map"),
            {
                center:<?php echo $_GET["pos"];?>,
                zoom:8
            }
        );
    }
</script>

<map style="width: 100%;height: 300px">

</map>