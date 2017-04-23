
<?php
/**
 *
 * $keys  =  Correspondencia entre clave del array y encabezado
 * $_posts = Posts en json
 */
$_posts =json_encode($posts); ?>
<table>
    <caption><?php echo $title;?></caption>
    <thead>
    <tr>
        <?php foreach ($keys as $k=>$v)
        {
            ?>
            <th scope="col"><?php echo $k?></th>
            <?php
        }?>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($_posts as $post)
    {
        foreach ($keys as $k=>$v)
        {
            ?>
            <tr>
                <td data-label="<?php echo $k;?>"><?php echo $post[$v];?></td>
            </tr>
            <?php
        }

    }?>


    </tbody>
</table>