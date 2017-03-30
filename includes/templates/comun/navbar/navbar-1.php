<nav>
    <?php
    foreach ($lang["navbar"] as $item)
    {
        if(isset($item["items"]))
        {
          var_dump($item["items"]);
        }
       ?>
            <a class="<?php if(isset($item["class"])){ echo $item["class"];} ?>"><?php echo $item["text"];?></a>

     <?php

    }?>
</nav>