
<div class="fila center">
    <div class="pagination">
        <a class="animated" href="#">&laquo;</a>
        <?php  foreach ($paginador as $p)
        {
            ?>
            <a class="animated <?php echo $p["class"]?>" href="#"><?php echo $p["number"] ?></a>
            <?php
        }?>
        <a class="animated" href="#">&raquo;</a>
    </div>
</div>
