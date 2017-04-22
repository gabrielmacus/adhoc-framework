<?php var_dump("datasd") ?>
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
<body class="fila" >



<header>
    <?php include "menu.php"?>
</header>

<section>
    <?php include DIR_PATH."/includes/panel/templates/{$site}/{$action}.php"?>
</section>
<aside class="sidenav-container main-color">
    <?php include "sidenav.php"?>
</aside>

<footer>
    
</footer>

</body>
</html>