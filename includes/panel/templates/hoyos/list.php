<style>
    body,section,#body{
        height: 100%;
    }
</style>
<script>
    function initMap() {
        var map = new google.maps.Map(document.querySelector('map'),
            {
                center: <?php echo json_encode($GLOBALS["mapsConfig"]["initialPosition"])?>,
                zoom: 8
            }
        );
        var markers =[];
        var trazo=new google.maps.Polyline({
            geodesic: true,
            strokeColor: '#262626',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            map:map
        });
        var path=[];
        <?php foreach ($posts as $post)
        {
            ?>

        path.push(<?php echo $post->getExtra1();?>);


        //    console.log((google.maps.geometry.spherical.computeDistanceBetween(, <?php echo $post->getExtra1();?>) / 1000).toFixed(2););


        markers.push(
            new google.maps.Marker({
                position:<?php echo $post->getExtra1();?>,
                map:map,icon:"https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_green<?php echo $post->getTitulo() ?>.png"
            })
        )
        <?php
        }?>

        trazo.setPath(path);

    }
</script>
<div style="width: 100%;height:100%;float: left;">
    <map style="width:100%;height: 100%;float: left;background-color: #2a2a2a"></map>
</div>
