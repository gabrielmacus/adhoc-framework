
<?php
/**
 *
 * $keys  =  Correspondencia entre clave del array y encabezado
 * $_posts = Posts en json
 */

 ?>
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
    <?php foreach ($posts as $post)
    {
        $post =array_values($post);
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