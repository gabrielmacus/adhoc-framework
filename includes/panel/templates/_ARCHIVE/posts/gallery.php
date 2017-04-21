
<style>
    .gallery-container a
    {
        text-decoration: none;
        display: block;
        float: left;
        width: 150px;
        background-color: #2a2a2a;
        color: white;
        text-align: center;
        padding: 10px;

    }

    .gallery
    {
        margin-top: 10px;
    }
    .gallery img
    {
        height: 150px;
        object-fit: cover;
    }

</style>

<div class="gallery-container">
    <?php
    if(!$text)
    {
        ?><label>Galeria <?php echo $i;?></label>
        <?php
    }
    else
    {
        ?>
        <label><?php echo $text ?></label>
        <?php
    }
    ?>

    <a data-lity href="<?php echo $configuracion->getSiteAddress()."/admin/repositorios/?modal=true&gal={$i}"?>">Agregar archivo</a>

    <div class="gallery <?php foreach ($types as $t){ echo $t." ";} ?> fila" data-id="<?php echo $i?>">




    </div>
</div>
