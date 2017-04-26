
<div class="fila center">
    <div class="pagination">
        <a class="animated nav" href="#">&laquo;</a>
        <?php
        unset($_GET["p"]);
        $qs=http_build_query($_GET);
        foreach ($paginador as $p)
        {
            ?>
            <a class="animated <?php echo $p["class"]?>" href="?<?php  echo $qs."&p=".$p["number"]?>"><?php echo $p["number"] ?></a>
            <?php
        }?>
        <a class="animated nav" href="#">&raquo;</a>
    </div>
</div>
