
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
{
foreach ($nav as $item)
{
    ?>
    <li  class="item animated <?php echo $item["active"]?>">
        <a >
            <span class="icon saffron"> <i class="fa fa-futbol-o" aria-hidden="true"></i></span>
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

    <?php iterateSidenav($lang["sidenav"]) ?>

</ul>