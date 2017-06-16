

<div class=" fixed-button" >

    <a class="btn" href="<?php echo $href;?>" style="color: white!important;"><?php echo $title;?></a>

</div>
<script>
    $(document).scroll(
        function () {

            $(".fixed-button").css("opacity","0.3");

        }
    );
</script>