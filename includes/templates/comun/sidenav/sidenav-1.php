
<ul class="sidenav">
    <?php foreach ($lang["sidenav"] as $item)

    {
        ?>
        <li class="<?php echo $item["class"]; ?>"><a href="<?php echo $item["href"]?>"><?php echo $item["text"] ?></a></li>
        <?php
    }?>

</ul>
<script>
    $(document).on("click",".menu-btn",function () {

        var sn=  $(".sidenav");

        var body=$("#body");

        sn.stop();

        body.stop();

        sn.animate({"right":"0px"});

        body.animate({"right":"30%"});

        $(this).addClass("opened");

    });

    $(document).on("click",".menu-btn.opened",function () {

        var sn=  $(".sidenav");

        var body=$("#body");

        sn.stop();

        body.stop();

        sn.animate({"right":"-30%"});
        body.animate({"right":"0px"});
        $(this).removeClass("opened");
    });



</script>
