
<map id="<?php echo $map;?>" style="height: 300px;width: 100%;background-color: white;float: left"></map>

<script>

    function initMap() {
    
        var map;
        map = new google.maps.Map(document.querySelector('#<?php echo $map;?>'), {
            center: <?php echo json_encode($GLOBALS["mapsConfig"]["initialPosition"])?>,
            zoom: 8
        });
      var  markers=[];
        var marker= new google.maps.Marker({

            map:map
        });
        marker.addListener("click",function () {

            this.setPosition(null);
        });



        map.addListener("click",function (e) {
            var position = e.latLng;


            <?php
            if($multipleMarkers)
            {

            ?>
            var marker= new google.maps.Marker({

                map:map
            });
            marker.addListener("click",function () {

                this.setPosition(null);
            });
            marker.setPosition(position);
            markers.push(marker);
            <?php
            }
            else
            {
            ?>

            marker.setPosition(position);
            <?php
            }?>



        })

    }




</script>