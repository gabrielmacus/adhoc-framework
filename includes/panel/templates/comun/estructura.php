
<!doctype html>
<html lang="<?php echo $configuracion->getLanguage()?>">
<head>
    <script>

        var facebookPermissions=<?php echo json_encode($GLOBALS["fbConfig"]["permissions"])?>;

    </script>

    <title><?php echo ($htmlTitle)?$htmlTitle:"Sin titulo"; ?></title>
    
    <?php include "tags.php";?>
    
    <?php include "css.php";?>
    
    <?php include "js.php";?>

    <style>
        html
        {
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
    
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
    <?php if(!$_GET["modal"])
    {
        ?><header>
        <?php include "navbars/A.php" ?>
        </header><?php
    }?>


    <section>

        <?php include DIR_PATH."/includes/panel/templates/{$site}/{$action}.php"?>

    </section>

    <?php if(!$_GET["modal"])
    {
        include "sidenavs/A.php";
    }?>







    <!--
    <footer>
        asdas
    </footer>-->
</div>


</body>
</html>
