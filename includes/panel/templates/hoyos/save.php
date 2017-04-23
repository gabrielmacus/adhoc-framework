
<header>
    <h2><?php echo $lang["hoyosave"]?></h2>
</header>


<div class="body">

    <form>
        <?php
        $label="Número";
        $model="hoyo.numero";
        include DIR_PATH."/includes/panel/templates/posts/input/number.php";

        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";
        ?>

    </form>


</div>
