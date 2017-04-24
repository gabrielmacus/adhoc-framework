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
        scope.<?php echo $model?>=[];

        var markers=[];

        <?php echo $id?>.addListener("click",function (e) {

            var marker=  new google.maps.Marker({
                map:<?php echo $id?>,
                position:{lat:e.latLng.lat(),lng:e.latLng.lng()}

            });

            scope.<?php echo $model?>.push({lat:e.latLng.lat(),lng:e.latLng.lng()});

            marker.addListener("click",function () {

                var idx =markers.indexOf(this);

                markers.splice(idx,1);
                scope.<?php echo $model?>.splice(idx,1);
                scope.$apply();
                console.log(idx);

            });
            markers.push(marker);

            scope.$apply();

        });





    });
</script>

<label><?php echo $title?></label>
<map  id="<?php echo $id;?>"></map>
</div>