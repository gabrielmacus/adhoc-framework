<script>
  $(document).ready(function () {

      var <?php echo $id?>=new google.maps.Map(
          document.querySelector("#<?php echo $id?>"),
          {
              center:<?php echo $lang["location"]?>
          }
      );
  });
</script>

<map id="<?php echo $id;?>"></map>