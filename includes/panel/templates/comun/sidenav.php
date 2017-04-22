<?php
var_dump("A")?>
<script>
    $(document).on("click",".item",openSubmenu);

    function openSubmenu(e) {

        var item = $(e.target).closest(".item");
        if(item)
        {


            item.find("ul").fadeToggle(400,function () {
                item.toggleClass("active");

            });

        }


       }




</script>

<?php


function iterateSidenav($nav)
{$colorPallete=["saffron","shamrock","honey-flower","alizarin","belize-hole"];
foreach ($nav as $item)
{
    ?>
    <li  class="item animated <?php echo $item["active"]?>">
        <a <?php if ($item["href"]){ ?> href="<?php echo $item["href"]?>"<?php }?>>
           <!-- href="<?php echo $item["href"]?>"--->
            <span class="icon <?php echo $colorPallete[random_int(0,4)]?> "> <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
            <span class="text"><?php echo $item["text"]?></span>
        </a>
        <?php if ($item["items"])
{
    ?>
        <ul style="display: none" class=" main-color">
            <?php iterateSidenav($item["items"]); ?>
        </ul>
    <?php
}?>
    </li>

    <?php
}
}
?>

<ul class="sidenav main-color">
    <li class="title"><a><?php echo $configuracion->getSiteName()." ".$configuracion->getVersion() ?></a></li>

    <?php iterateSidenav($lang["navbar"]) ?>

</ul>