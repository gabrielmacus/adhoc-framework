<script>
    google.maps.event.addListenerOnce(map, 'idle', function(){
       console.log(Math.random());
    });
</script>

<map id="<?php echo $id;?>"></map>