
<div class="fila center">
    <div class="pagination">
        <a class="animated" href="#">&laquo;</a>
        <?php
        $qs=http_build_query($_GET);var_dump($qs);
        foreach ($paginador as $p)
        {
            ?>
            <a class="animated <?php echo $p["class"]?>" href="<?php ?>"><?php echo $p["number"] ?></a>
            <?php
        }?>
        <a class="animated" href="#">&raquo;</a>
    </div>
</div>
