

<div class=" fixed-button" >

    <a class="btn" href="<?php echo $href;?>" style="color: white!important;"><?php echo $title;?></a>

</div>
<script>
    $(document).scroll(
        function () {

            clearTimeout(timeout);
            clearTimeout($.data(this, 'scrollTimer'));
            $.data(this, 'scrollTimer', setTimeout(function() {
                // do something

                $(".fixed-button").css("opacity","0.15");

                var timeout= setTimeout(function () {
                    $(".fixed-button").css("opacity","1");
                    clearTimeout(timeout);
                },2500)
            }, 250));



        }
    );
</script>