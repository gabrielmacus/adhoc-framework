
<?php

function loadSidenav($items)
{

    ?>
    <ul>
        <?php
        foreach ($items as $item)
        {
            $href="";
            $class="";
            $text="";
            if(isset($item["href"]))
            {
                $href=$item["href"];
            }
            if(isset($item["class"]))
            {
                $class=$item["class"];
            }
            if(isset($item["text"]))
            {
                $text=$item["text"];
            }

            $hasSubmenu=isset($item["items"]);

            if($hasSubmenu)
            {
                $class.=" submenu";
            }


            ?>
            <li class="<?php echo $class;?>"><a href="<?php echo $href;?>"><?php echo $text;?>
                    <?php if($hasSubmenu)
                    {
                        ?><i class="fa fa-sort-desc" aria-hidden="true"
                       ></i>
                        <?php
                    }?>
                </a>
                <?php if($hasSubmenu)
                {

                    loadSidenav($item["items"]);
                }?>
            </li>
            <?php
        }
        ?>

    </ul>




    <?php


}



?>
<script>
    $(document).on("click",".submenu",function () {

        $(this).find("ul").animate({"height":"toggle"},400);

    });
</script>
<style>
    .sidenav
    {
        position: fixed;
        height:100%;
        width: 25%;
        right: 0px;
        top:0px;
    }

    .sidenav ul > li
    {
        font-size: 20px;

    }
    .sidenav .submenu ul
    {    width: 100%;
        float: left;
        display: none;
        overflow: hidden;
        background-color: white;
        display: none;
    }

    .sidenav .submenu  >  ul li
    {
    font-size: 18px!important;
        padding-left: 20px;
    }

    section
    {
        width: 75%;
    }
</style>

    <aside class="sidenav">    <?php echo loadSidenav($lang["sidenav"])?>
     </aside>



