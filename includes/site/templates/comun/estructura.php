
<!doctype html>
<html lang="<?php echo $configuracion->getLanguage()?>">
<head>
    <script>
        var facebookData=<?php echo json_encode($GLOBALS["fbConfig"]);?>;
   
    </script>
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
<body  data-ng-cloak class="<?php  echo implode(" ",$bodyClasses);?>" data-ng-app="panel" data-ng-controller="panelCtrl">

<?php
include DIR_PATH."/includes/panel/templates/comun/loader.php"; ?>
<script>


    
    var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
    var eventer = window[eventMethod];
    var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";
    // Listen to message from child window
    eventer(messageEvent,function(e) {

        console.log(e);

        if(e.origin=="<?php echo $configuracion->getSiteAddress()?>")
        {
            switch (e.data)
            {
                case "login":
                    checkLogin();
                    break;
            }
        }

    });



    function error(e) {

        console.log("GENERIC ERROR \n");
        console.log(e);
    }
    function checkLogin() {
        $.ajax(
            {
                url:"<?php echo $configuracion->getSiteAddress()?>/admin/login.php?login=true&async=true",
                method:"post",
                dataType:"json",
                data:scope.usuarioLogin,
                success:function (e) {

                    scope.user=e.data;
                    scope.$apply();
                },
                error:function () {
                    scope.user=false;

                    setTimeout(function () {
                        scope.$apply();
                    });
                }
            }
        );
    }
    angular.element(function () {
        checkLogin();
    });

    var app = angular.module('panel', ['ngAnimate']);
    app.config(function ($provide, $httpProvider) {

        // Intercept http calls.
        $provide.factory('httpInterceptor', function ($q) {
            return {
                // On request success
                request: function (config) {
                    $(".loader").addClass("active");
                    $(".loader .info").html("");

                    // console.log(config); // Contains the data about the request before it is sent.

                    // Return the config or wrap it in a promise if blank.
                    return config || $q.when(config);
                },

                // On request failure
                requestError: function (rejection) {
                    // console.log(rejection); // Contains the data about the error on the request.
                    $(".loader").removeClass("active");
                    // Return the promise rejection.
                    return $q.reject(rejection);
                },

                // On response success
                response: function (response) {
                    // console.log(response); // Contains the data from the response.
                    $(".loader").removeClass("active");
                    // Return the response or promise.

                    return response || $q.when(response);
                },

                // On response failture
                responseError: function (rejection) {
                    // console.log(rejection); // Contains the data about the error.
                    $(".loader").removeClass("active");
                    // Return the promise rejection.
                    return $q.reject(rejection);
                }
            };
        });

        // Add the interceptor to the $httpProvider.
        $httpProvider.interceptors.push('httpInterceptor');
    });
    var scope;
    var timeout;
    var http;
    app.controller('panelCtrl', function($scope,$timeout,$http) {
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
<header>
    <?php  include DIR_PATH."/includes/site/templates/comun/menu.php"; ?>
</header>



<section>
    
    <?php include DIR_PATH."/includes/site/templates/{$site}/{$action}.php"?>
    
</section>

<footer>
    
</footer>

</body>
</html>