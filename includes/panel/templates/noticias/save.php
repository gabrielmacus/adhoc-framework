
<header>
    <h2>Prueba</h2>
</header>


<div class="body">

    <form data-ng-submit="save()">
        <?php

        $label="Titulo";
        $model="titulo";
        include DIR_PATH."/includes/panel/templates/posts/input/text.php";


        $model ="bajada";
        $label="Nivel";
        $options=array(
            1=>"Data 1",
            2 =>"Data 2",
            3 =>"Data 3"

        );
        include DIR_PATH."/includes/panel/templates/posts/input/select.php";
        ?>

    </form>


</div>
