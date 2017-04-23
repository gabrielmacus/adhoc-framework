<script>
 function initMap() {



      var <?php echo $id?>=new google.maps.Map(
          document.querySelector("#<?php echo $id?>"),
          {
              center:{"lat": -34.397, "lng": 150.644}
          }
      );
  };
</script>

<map style="width: 100%;height: 300px;float: left" id="<?php echo $id;?>"></map>