
<!doctype html>
<html lang="<?php echo $configuracion->getLanguage()?>">
<head>
    <script>

        var facebookPermissions=<?php echo json_encode($GLOBALS["fbConfig"]["permissions"])?>;

    </script>
    <title><?php echo ($htmlTitle)?$htmlTitle:"Sin tituolo"; ?></title>
    
    <?php include "tags.php";?>
    
    <?php include "css.php";?>
    
    <?php include "js.php";?>

    
</head>
<body >


<div id="body">
    <header>
        <?php include "navbar/navbar-1.php" ?>

    </header>

    <section>

        <?php include DIR_PATH."/includes/panel/templates/{$site}/{$action}.php"?>

    </section>

    <aside>

    </aside>


    <footer>
        asdas
    </footer>

    <?php include "sidenav/sidenav-1.php"?>


</div>


</body>
</html>
