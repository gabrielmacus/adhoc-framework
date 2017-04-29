
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
<body class="fila" data-ng-app="panel" data-ng-controller="panelCtrl">
<?php include DIR_PATH."/includes/panel/templates/comun/submenu.php"?>
<script>



    var app = angular.module('panel', ['ngTagsInput','ngAnimate']);
    var scope;
    var timeout;
    var http;
    app.controller('panelCtrl', function($scope,$timeout,$http) {
        http=$http;
        vex.defaultOptions.className = 'vex-theme-plain';

        scope=$scope;
        timeout=$timeout;
    });

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
<header>
    <?php include "menu.php"?>
</header>

<section class="main-container animated">
    <?php include DIR_PATH."/includes/panel/templates/{$site}/{$action}.php"?>
</section>
<aside class="animated sidenav-container main-color">
    <?php include "sidenav.php"?>
</aside>

<footer>
    
</footer>

</body>
</html>