
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
<body data-ng-app="panel" data-ng-controller="panelCtrl">

<script>
    function error(e) {

        console.log(e);
        alert("Error desconocido");
    }
    var app = angular.module('panel', ['ui.sortable']);
    var scope;
    app.controller('panelCtrl', function($scope) {

        scope=$scope;

    });

</script>
<div id="body">
    <header>
        <?php include "navbar/navbar-1.php" ?>

    </header>

    <section>

        <?php include DIR_PATH."/includes/panel/templates/{$site}/{$action}.php"?>

    </section>

    <aside>

    </aside>



    <?php include "sidenav/sidenav-1.php"?>


    <!--
    <footer>
        asdas
    </footer>-->
</div>


</body>
</html>
