<div class="body">

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
        </tr>

        </thead>
        <tbody>
        <?php foreach ($rows as $row)
        {


            ?>
            <tr>
                <?php foreach ($row as $k=>$v)
                {
                    ?>
                    <td title="<?php echo $v["data"];?>" data-label="<?php echo $k;?>"><a <?php if($v["modal"]){ echo "data-lity";} ?> href="<?php echo $v["href"];  ?>"><?php echo $v["data"]; ?></a></td>
                    <?php
                }?>
                <td title="<?php echo $lang["editar"];?>"><a class="icon " href="?t=<?php echo $_GET["t"]?>&s=<?php echo $_GET["s"]?>&act=save&id=<?php echo $row["#"]["data"];?>"><i class="fa fa-pencil-square-o animated" aria-hidden="true"></i></a></td>
                <td title="<?php echo $lang["eliminar"];?>"><a class="icon "><i class="fa fa-trash-o animated" aria-hidden="true"></i></a></td>
            </tr>
            <?php
        }?>



        </tbody>
    </table>

    <?php  if(count($rows)==0)

    {
        ?>
        <h3 style="    padding: 20px;
    text-align: center;
    font-size: 30px;">No hay contenido disponible</h3>
        <?php
    }?>
</div>