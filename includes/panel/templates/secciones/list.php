
<script>

    angular.element(function () {
        scope.secciones =[];
        <?php
                foreach ($secciones as $seccion)
                {
                    ?>
        scope.secciones.push({id:<?php echo $seccion->getId();?>
            ,nombre:"<?php echo $seccion->getNombre();?>",
            tipo:<?php echo $seccion->getTipo();?>
        });
        <?php
                }
            ?>;

        scope.addSeccion = function () {
            $.ajax(
                {
                    "method":"post",
                    "url":"add.php",
                    "data":angular.copy(scope.seccion),
                    "dataType":"json",
                    "success":function (e) {
                        scope.secciones.push(e);
                        scope.seccion={};
                        scope.$apply();
                    }
                    ,"error":error
                }
            );

        }
        scope.deleteSeccion = function (s) {
            $.ajax(
                {
                    "method":"post",
                    "url":"delete.php",
                    "data":angular.copy(s),
                    "dataType":"json",
                    "success":function (e) {

                        if(e)
                        {
                            var idx = scope.secciones.indexOf(s);

                            scope.secciones.splice(idx,1);
                            scope.$apply();
                        }

                    }
                    ,"error":error
                }
            );

        }

        scope.$apply();

    });

</script>

<h3>Secciones</h3>

<form data-ng-submit="addSeccion()">

    <div>
        <label>Nombre</label>
        <input data-ng-model="seccion.nombre" type="text">
    </div>

    <div>
        <label>Pertenece a</label>
        <select data-ng-model="seccion.tipo">
            <option>Ninguna seccion</option>

            <option data-ng-repeat="s in secciones" value="{{s.id}}">{{s.nombre}}</option>
        </select>
    </div>
    <button type="submit">Agregar seccion</button>
</form>

</form>

<ul class="secciones">
    <li data-ng-repeat="s in secciones" data-id="{{s.id}}">#{{s.id}} {{s.nombre}} <span data-ng-click="deleteSeccion(s)">x</span></li>

    <li data-ng-if="secciones.length==0">
        <h3>No hay secciones disponibles</h3>
    </li>
</ul>


