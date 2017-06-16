<?php

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

<?php

if(count($pg)>1)

{
    ?>
<div class="fila center">
    <div class="pagination">
        <?php if($actualPage>1)
        {
            ?>
            <a class="animated prev"  href="?<?php   $qs=http_build_query($_GET);  echo $qs."&p=".($actualPage-1)?>">&laquo;</a>
            <?php
        }

        unset($_GET["p"]);
        $qs=http_build_query($_GET);
        foreach ($pg as $p)
        {
            ?>
            <a class="animated <?php echo $p["class"]?>" href="?<?php  echo $qs."&p=".$p["number"]?>"><?php echo $p["number"] ?></a>
            <?php
        }

        if($actualPage<$pages)
        {
            ?>
            <a class="animated next" href="?<?php  echo $qs."&p=".($actualPage+1)?>">&raquo;</a>
            <?Php
        }?>
    </div>
</div>
    <?php
}?>