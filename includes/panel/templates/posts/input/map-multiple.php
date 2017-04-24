<div class="form-block">
<script>
    $(document).ready(function () {
        var <?php echo $id?>=new google.maps.Map(
            document.querySelector("#<?php echo $id?>"),
            {
                center:<?php echo json_encode( $lang["location"])?>,
                zoom:12
            }
        );
        scope.post.<?php echo $model?>=[];

        var markers=[];

        var locations=[];//only lat lng

        <?php if($post)
        {
            ?>

            locations = JSON.parse(scope.post.<?php echo $model?>);

            console.log(locations);
            $.each(locations,function (k,v) {


                addMarker(v.lat,v.lng)

            });


        <?php
        }?>

        <?php echo $id?>.addListener("click",function (e) {

            addMarker( e.latLng.lat(),e.latLng.lng());
        });

        function addMarker(latitud,longitud) {

            var marker=  new google.maps.Marker({
                map:<?php echo $id?>,
                position:{"lat":latitud,"lng":longitud}

            });


            marker.addListener("click",function () {

                var idx =markers.indexOf(this);

                markers[idx].setPosition(null);
                markers.splice(idx,1);

                locations.splice(idx,1);
                scope.post.<?php echo $model?>= JSON.stringify(locations);

                scope.$apply();


            });
            markers.push(marker);
            locations.push({"lat":latitud,"lng":longitud});

            scope.post.<?php echo $model?>= JSON.stringify(locations);

            scope.$apply();
        }




    });
</script>

<label><?php echo $title?></label>
<map  id="<?php echo $id;?>"></map>
</div>