
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

        foreach ($row as $k=>$v)
        {
var_dump($v);
            ?>
            <tr>
                <td data-label="<?php echo $k;?>"><a href="<?php echo $v["href"]; ?>"><?php echo $v["data"]; ?></a></td>
                <td><a class="icon "><i class="fa fa-pencil-square-o animated" aria-hidden="true"></i></a></td>
                <td><a class="icon "><i class="fa fa-trash-o animated" aria-hidden="true"></i></a></td>
            </tr>
            <?php
        }
    }?>


    </tbody>
</table>
