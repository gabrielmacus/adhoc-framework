
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

<header class="primary-header">
    <div class="container">
        <h1 class="primary-header__title">
            My Tasks App <small>using custom context menus</small>
        </h1>
    </div>
</header>
<main class="content">
    <div class="container">
        <ul class="tasks">
            <li class="task" data-id="3">
                <div class="task__content">
                    Go To Grocery
                </div>
                <div class="task__actions">
                    <i class="fa fa-eye"></i>
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-times"></i>
                </div>
            </li>
            <li class="task" data-id="2">
                <div class="task__content">
                    Type Some Code
                </div>
                <div class="task__actions">
                    <i class="fa fa-eye"></i>
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-times"></i>
                </div>
            </li>
            <li class="task" data-id="1">
                <div class="task__content">
                    Build An App
                </div>
                <div class="task__actions">
                    <i class="fa fa-eye"></i>
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-times"></i>
                </div>
            </li>
        </ul>
    </div>
</main>
<footer class="primary-footer">
    <div class="container">
        <small>&copy; 2015 Context Menu Madness! Demo by Nick Salloum. <a href="building-custom-context-menu-javascript" target="_blank">See article </a></small>
    </div>
</footer>
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