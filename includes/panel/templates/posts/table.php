
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
        var_dump($post);
        foreach ($keys as $k=>$v)
        {
            echo $v;
            ?>
            <tr>
                <td data-label="<?php echo $k;?>"><?php echo $post[$v];?></td>
            </tr>
            <?php
        }

    }?>


    </tbody>
</table>