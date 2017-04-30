<?php
var_dump($pg);
?>
<script>
    $(document).ready(
        function () {


            /*
            $(".pagination .first").siblings(".prev").hide();
            $(".pagination .last").siblings(".next").hide();*/
        }
    );
</script>

<div class="fila center">
    <div class="pagination">
        <?php if($actualPage>1)
        {
            ?>
            <a class="animated prev"  href="?<?php   $qs=http_build_query($_GET);  echo $qs."&p=".($actualPage-1)?>">&laquo;</a>
            <?php
        }
        ?>
        <?php
        unset($_GET["p"]);
        $qs=http_build_query($_GET);
        foreach ($pg as $p)
        {
            ?>
            <a class="animated <?php echo $p["class"]?>" href="?<?php  echo $qs."&p=".$p["number"]?>"><?php echo $p["number"] ?></a>
            <?php
        }?>
        <?php if($actualPage<$paginador->getPages())
        {
            ?>
            <a class="animated next" href="?<?php  echo $qs."&p=".($actualPage+1)?>">&raquo;</a>
            <?Php
        }?>
    </div>
</div>
