<?php

if(!$shownText)
{
    $shownText="titulo";
}
?>
<script>
    angular.element(function () {

        scope.togglePost=function (p) {

            console.log(p);

            if(!scope.selectedPosts)
            {
                scope.selectPosts=[];
            }

            var idx = scope.selectPosts.indexOf(p);

            if(idx==-1)
            {
                scope.selectedPosts.push(p);
            }
            else
            {
                scope.selectedPosts.splice(idx,1);
            }


        }



    });
</script>
<div class="body">
    <?php  if(count($rows)>0)

    {
        ?>
        <table>
            <caption><?php echo $title;?></caption>
            <thead>

            <tr>
                <?php foreach ($rows[0] as $k=>$v)
                {
                    ?>
                    <th scope="col"><?php echo $k?></th>
                    <?php
                }?>

                <th scope="col"><?php echo $lang["editar"];?></th>

                <th scope="col"><?php echo $lang["eliminar"];?></th>
                <th style="col">Ver más</th>
                <?php if($_GET["modal"])
                {
                    ?>
                    <th style="col"></th>
                    <?Php
                }?>
            </tr>

            </thead>
            <tbody>
            <?php foreach ($rows as $row)
            {

                $post=json_decode(json_encode($posts[$row["#"]["data"]]),true);

                ?>
                <tr  data-ng-click='togglePost(<?php echo $row["#"]["data"]; ?>,"<?php echo $post[$shownText]?>","<?php echo $grupo?>")'>
                    <?php foreach ($row as $k=>$v)
                    {
                        ?>
                        <td title="<?php echo $v["data"];?>" data-label="<?php echo $k;?>"><a <?php if($v["modal"]){ echo "data-lity";} ?> href="<?php echo $v["href"];  ?>"><?php echo $v["data"]; ?></a></td>
                        <?php
                    }?>
                    <td title="<?php echo $lang["editar"];?>"><a class="icon " href="?t=<?php echo $_GET["t"]?>&s=<?php echo $_GET["s"]?>&act=save&id=<?php echo $row["#"]["data"];?>"><i class="fa fa-pencil-square-o animated" aria-hidden="true"></i></a></td>
                    <td title="<?php echo $lang["eliminar"];?>"><a class="icon "><i class="fa fa-trash-o animated" aria-hidden="true"></i></a></td>
                    <td title="Más info"><a class="icon"  href="?t=<?php echo $_GET["t"]?>&s=<?php echo $_GET["s"]?>&act=view&id=<?php echo $row["#"]["data"];?>"><i class="fa fa-info animated" aria-hidden="true"></a></i></td>
                    <?php if($_GET["modal"])
                    {
                        ?>
                        <td title=""><input style="-webkit-transform: scale(1.5);-moz-transform: scale(1.5);-ms-transform: scale(1.5);-o-transform: scale(1.5);transform: scale(1.5);" type="checkbox" data-id="<?php echo $row["#"]["data"]?>"></td>
                        <?Php
                    }?>
                </tr>
                <?php
            }?>



            </tbody>
        </table>

        <?Php
    }
    ?>

    <?php  if(count($rows)==0)

    {
        ?>
        <h3 style="    padding: 20px;
    text-align: center;
    font-size: 30px;">No hay contenido disponible</h3>
        <?php
    }?>
</div>