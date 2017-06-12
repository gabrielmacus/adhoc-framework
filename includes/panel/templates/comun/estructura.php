
<!doctype html>
<html lang="<?php echo $configuracion->getLanguage()?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?php include "tags.php";?>

    <?php include "css.php";?>

    <?php include "js.php";?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body data-ng-cloak class="fila" data-ng-app="panel" data-ng-controller="panelCtrl">

<script>
    function error(e) {

        console.log(e);
        toastr.error('', 'Hubo un error al procesar lo solicitado. Inténtelo mas tarde');

    }


    var app = angular.module('panel', ['ngAnimate','ui.tree','ngSanitize']);
    var scope;
    var timeout;
    var http;
    app.controller('panelCtrl', function($scope,$timeout,$http) {

        vex.dialog.buttons.YES.text = 'Ok';
        vex.dialog.buttons.NO.text = 'Cancelar';

        http=$http;
        vex.defaultOptions.className = 'vex-theme-plain';

        scope=$scope;
        timeout=$timeout;
    });

    app.directive('onFinishRender',['$timeout', '$parse', function ($timeout, $parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attr) {
                if (scope.$last === true) {
                    $timeout(function () {
                        scope.$emit('ngRepeatFinished');
                        if(!!attr.onFinishRender){
                            $parse(attr.onFinishRender)(scope);
                        }
                    });
                }
            }
        }
    }]);
    app.directive('stringToNumber', function() {
        return {
            require: 'ngModel',
            link: function(scope, element, attrs, ngModel) {
                ngModel.$parsers.push(function(value) {
                    return '' + value;
                });
                ngModel.$formatters.push(function(value) {
                    return parseFloat(value, 10);
                });
            }
        };
    });

</script>
<?php if(!$_GET["modal"])

{
    ?>
    <header class="hide-l">
        <?php include "menu.php"?>
    </header>

    <?Php
}
else
    {
        ?>
        <style>
            .body
            {
                padding: 10px;
            }
            .main-container
            {
                width: 100%;
            }
        </style>
        <?Php
    }
?>

<section class="main-container animated">
    <?php include DIR_PATH."/includes/panel/templates/{$site}/{$action}.php"?>
</section>

<?php if(!$_GET["modal"])

{
    ?>

    <aside class="animated sidenav-container main-color">
        <?php include "sidenav.php"?>
    </aside>

    <footer>

    </footer>
    <?php
}
?>


</body>
</html>