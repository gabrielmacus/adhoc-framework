
<script>
       $(document).on("click",".item",openSubmenu);
       $(document).on("click",".close-menu",function () {

           $(".sidenav-container").removeClass("open");
           $(".close-menu").fadeOut();
       });

    $(document).on("click",".hamburger",function () {

        $(".sidenav-container").addClass("open");

        $(".close-menu").fadeIn();
        //  $(".navigation").toggleClass("push");
        //$(".main-container").toggleClass("push");
    });

    function openSubmenu(e) {

        var item = $(e.target).closest(".item");
        if(item)
        {
            item.stop();
            item.toggleClass("active");
            item.find("ul").slideToggle(400,function () {


            });

        }


       }




</script>

<?php

function iterateSidenav($nav)
{

    $colorPallete=["saffron","shamrock","honey-flower","alizarin","belize-hole"];
foreach ($nav as $item)
{
    ?>
    <li  class="item animated <?php echo $item["class"]?>">
        <a <?php if ($item["href"]){ ?> href="<?php echo $item["href"]?>"<?php }?>>
           <!-- href=""--->
            <span class="icon <?php echo $colorPallete[rand(0,4)]?> "> <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
            <span class="text"><?php echo $item["text"]?></span>
        </a>
        <?php if ($item["items"])
{
    ?>
        <ul style="display: none" >
            <?php iterateSidenav($item["items"]); ?>
        </ul>
    <?php
}?>
    </li>

    <?php
}
}
?>

<i  style="position: fixed;top: 10px;right: 10px;font-size: 45px;color: #da4244;display: none" class="close-menu fa fa-times" aria-hidden="true"></i>


<ul class="sidenav  main-color">
    <li class="title"><a><?php echo $configuracion->getSiteName()." ".$configuracion->getVersion() ?></a></li>

    <?php iterateSidenav($lang["sidenav"]) ?>

</ul>