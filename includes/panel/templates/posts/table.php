
<table>
    <caption><?php echo $title;?></caption>
    <thead>

        <tr>
            <?php foreach ($rows as $k=>$v)
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
    <?php foreach ($rows as $k=>$v)
    {
        ?>
        <tr>
            <td data-label="<?php echo $k;?>"><a href="<?php echo $v["href"]; ?>"><?php echo $v["data"]; ?></a></td>
        </tr>
        <?php
    }?>


    </tbody>
</table>
