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
         map:<?php echo $id?>,

     });
     <?php echo $id?>.addListener("click",function (e) {

         marker.setLocation(e.latLng);


     })
 });
</script>

<map  id="<?php echo $id;?>"></map>