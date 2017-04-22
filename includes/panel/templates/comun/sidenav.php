
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
   <li>a</li>
    <?php
}
}
?>

<ul class="sidenav main-color">
    <li class="title"><a><?php echo $configuracion->getSiteName()." ".$configuracion->getVersion() ?></a></li>

    <?php iterateSidenav($lang["sidenav"]) ?>

</ul>