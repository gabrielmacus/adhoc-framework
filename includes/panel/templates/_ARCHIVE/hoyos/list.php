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



        var infowindow = new google.maps.InfoWindow({});




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
        var holeIndex=markers.length-1;
        markers[holeIndex].addListener("click",function () {

            var HTML="<div id='content'>" +
                "<div id='bodyContent'>";



           var holeIndex=markers.indexOf(this);
            if(markers.length>holeIndex+1)
            {
                var hole1 =markers[holeIndex].getPosition();
                var hole2 =markers[holeIndex+1].getPosition();

                var title="Distancia hasta el siguiente hoyo";
                 HTML+="<p><strong>Distancia hasta el siguiente hoyo:</strong> "+(google.maps.geometry.spherical.computeDistanceBetween(hole1, hole2) ).toFixed(2)+" metros</p>";

            }
            else
            {

                var title="Último hoyo";
                HTML+="<p><strong>Último hoyo</strong></p>";

            }


            HTML+="<div > " +
                "<div style='display: inline-block;width: 50%;padding: 5px'><a href='<?php echo $configuracion->getSiteAddress()."/admin/hoyos/?act=add&id={$post->getId()}"?>' style='cursor:pointer;background-color: #2a2a2a;padding: 10px;display: block;width: 100%;text-align: center;color: white'><i class='fa fa-pencil-square-o' aria-hidden='true' style='font-size: 17px'></i></a></div>" +
                "<div style='display: inline-block;width: 50%;padding: 5px'><a  style='cursor:pointer;background-color: #2a2a2a;padding: 10px;display:block;width: 100%;text-align: center;color: white'><i class='fa fa-trash' aria-hidden='true' style='font-size: 17px'></i></a></div>" +
                "</div>";

            HTML+="</div>";
            HTML+="</div>";


            markers[holeIndex].setTitle(title);
            infowindow.setContent(HTML);
            infowindow.open(map,this);




        });


        <?php
        }?>

        trazo.setPath(path);

    }
</script>
<div style="width: 100%;height:100%;float: left;">
    <map style="width:100%;height: 100%;float: left;background-color: #2a2a2a"></map>
</div>
