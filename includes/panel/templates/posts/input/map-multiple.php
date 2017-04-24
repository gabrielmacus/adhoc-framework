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


        <?php echo $id?>.addListener("click",function (e) {

            var marker=  new google.maps.Marker({
                map:<?php echo $id?>,
                position:{lat:e.latLng.lat(),lng:e.latLng.lng()}

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
            locations.push({lat:e.latLng.lat(),lng:e.latLng.lng()});

            scope.post.<?php echo $model?>= JSON.stringify(locations);

            scope.$apply();

        });





    });
</script>

<label><?php echo $title?></label>
<map  id="<?php echo $id;?>"></map>
</div>