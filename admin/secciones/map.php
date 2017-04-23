<script>
    function initMap() {

       var map = new google.maps.Map(
           document.querySelector("map"),
           {
               center:<?php echo $_GET["pos"];?>
           }
       );
    }
</script>

<map style="width: 100%;height: 300px">

</map>