<script>
 $(document).ready(function () {
     var <?php echo $id?>=new google.maps.Map(
         document.querySelector("#<?php echo $id?>"),
         {
             center:<?php echo json_encode( $lang["location"])?>,
             zoom:12
         }
     );
 });
</script>

<map style="width: 100%;height: 300px;float: left" id="<?php echo $id;?>"></map>