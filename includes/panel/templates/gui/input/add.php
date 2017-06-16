

<div class=" fixed-button animated" >

    <a class="btn" href="<?php echo $href;?>" style="color: white!important;"><?php echo $title;?></a>

</div>
<script>

    $(document).ready(function () {
        $(document).scroll(
            function () {

                clearTimeout(timeout);

                // do something

                $(".fixed-button").css("opacity","0.15");

                var timeout= setTimeout(function () {
                    $(".fixed-button").css("opacity","1");
                    clearTimeout(timeout);
                },2500)




            }
        );
    });
</script>