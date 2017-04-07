
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
<aside>
    <?php echo loadSidenav($lang["sidenav"])?>

</aside>
