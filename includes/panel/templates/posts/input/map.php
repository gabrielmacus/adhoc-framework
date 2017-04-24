<div class="form-block">
<label><?php echo $title?></label>
<script>
 $(document).ready(function () {
     var <?php echo $id?>=new google.maps.Map(
         document.querySelector("#<?php echo $id?>"),
         {
             center:<?php echo json_encode( $lang["location"])?>,
             zoom:12
         }
     );
     var marker=new google.maps.Marker({

         map:<?php echo $id?>

     });


         marker.setPosition(angular.copy(JSON.parse(scope.post.<?php echo $model?>)));



     scope.$apply();
     <?php echo $id?>.addListener("click",function (e) {
         marker.setPosition(e.latLng);

         scope.post.<?php echo $model?>="{lat:"+e.latLng.lat()+",lng:"+e.latLng.lng()+"}";

         scope.$apply();

     });

 });
</script>

<map  id="<?php echo $id;?>"></map>
</div>