<!doctype html>
<html lang="<?php echo $configuracion->getLanguage()?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?php include "tags.php";?>

    <?php include "css.php";?>

    <?php include "js.php";?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="body" class="columns" >
    <?php if(!$_GET["modal"])
    {
        ?><header class=" is-12">

        </header><?php
    }?>


    <section class="column is-9-desktop is-12">


        <?php include DIR_PATH."/includes/panel/templates/{$site}/{$action}.php"?>

    </section>
    <aside class="menu is-3 is-hidden-touch column">
        <?php include "sidenav.php"?>
    </aside>



    <!--
    <footer>
        asdas
    </footer>-->
</div>
</body>
</html>