
<?php
function loadNavbar($navbar)
{

    ?>
    <ul>
    <?php
    foreach ($navbar as $item)
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



        ?>
        <li class="<?php echo $class;?>"><a href="<?php echo $href;?>"><?php echo $text;?>
                <?php if($hasSubmenu)
                {
                  ?><i class="fa fa-sort-desc" aria-hidden="true"></i>
                    <?php
                }?>
            </a>
        <?php if($hasSubmenu)
        {
            loadNavbar($item["items"]);
        }?>
        </li>
        <?php
    }
    ?>

        </ul>




        <?php


}



?>


<nav>
    <?php loadNavbar($lang["navbar"]);?>
    <ul class="menu-btn">
        <li><i class="fa fa-bars" aria-hidden="true"></i></li>
    </ul>
</nav>
