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

        <?php echo $id?>.addListener("click",function (e) {

            var marker=  new google.maps.Marker({
                map:<?php echo $id?>,
                position:{lat:e.latLng.lat(),lng:e.latLng.lng()}

            });
            scope.<?php echo $model?>.push(
              marker
            );

            marker.addListener("click",function () {

                var idx = scope.<?php echo $model?>.indexOf(this);

                console.log(idx);

            });


            scope.$apply();

        });





    });
</script>

<map  id="<?php echo $id;?>"></map>