<nav>

    <?php
    foreach ($lang["menu"] as $k=>$v)
    {
        ?>
        <a href="<?php echo $v["href"]?>"><?php echo $v["text"];?></a>
        <?php
    }
    ?>
    
</nav>