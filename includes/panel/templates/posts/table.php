
<table>
    <caption><?php echo $title;?></caption>
    <thead>
    <?php foreach ($rows as $k=>$v)
    {
    ?>
        <tr>
            <th scope="col"><?php echo $k?></th>
        </tr>
        <tr>
            <th scope="col"><?php echo $lang["editar"];?></th>
        </tr>
        <tr>
            <th scope="col"><?php echo $lang["eliminar"];?></th>
        </tr>
    <?php
    }?>

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
