
<script>

    angular.element(function () {

        scope.sidenav=<?php echo json_encode($lang["sidenav"],JSON_NUMERIC_CHECK)?>;

        if(!scope.sidenav)
        {
            scope.sidenav=[];
        }
        scope.addToSidenav=function () {

            scope.sidenav.push(angular.copy(scope.item));
        };
        scope.deleteSidenavItem=function (item) {

            var idx = scope.sidenav.indexOf(item);

            scope.sidenav.splice(idx,1);
        }

        scope.saveSidenav=function () {

            $.ajax(
                {
                    "method":"post",
                    "url":"save.php",
                    "data":{"sidenav":angular.copy(scope.sidenav)},
                    "dataType":"json",
                    "success":function (e) {
                        console.log(e);
                    }
                    ,"error":error
                }
            );

            console.log(scope.sidenav);
        };

        scope.$apply();


    });

</script>

<h3>Gestionar menu lateral</h3>

<ul ui-sortable data-ng-model="sidenav">
    <li data-ng-repeat="item in sidenav"><a href="{{item.href}}">{{item.text}}</a><span data-ng-click="deleteSidenavItem(item)">x</span></li>
</ul>

<div>
    <label>Texto</label>
    <input type="text" data-ng-model="item.text">
</div>

<div>
    <label>Enlace</label>
    <input type="text" data-ng-model="item.href">
</div>


<button data-ng-click="addToSidenav()">Agregar</button><button data-ng-click="saveSidenav()">Guardar cambios</button>