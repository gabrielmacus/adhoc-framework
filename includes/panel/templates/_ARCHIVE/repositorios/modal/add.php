<style>
    .repositorio-form
    {
        padding: 15px;
    }
    header
    {
        display: none;
    }
    aside
    {
        display: none;
    }
    footer
    {
        display: none;
    }
    section
    {
        display: block;
    }
</style>
<script>
    angular.element(function () {
        <?php if($repositorio)
        {


        ?>
        scope.repositorio= {
            "puerto": "<?php echo $repositorio->getPort()?>",
            "host": "<?php echo $repositorio->getHost()?>",
            "usuario": "<?php echo $repositorio->getUser()?>",
            "pass": "<?php echo $repositorio->getPass()?>",
            "nombre":"<?php echo $repositorio->getName()?>",
            "ruta": "<?php echo $repositorio->getPath()?>",
            "id": "<?php echo $repositorio->getId()?>",
            "creation": "<?php echo $repositorio->getCreation()?>",
            "modification": "<?php echo $repositorio->getModification()?>",
            "url":"<?php echo $repositorio->getUrl()?>"
        };




        scope.$apply();
    <?php

    }?>

        scope.addRepositorio=function () {
            $.ajax(
                {
                    "method":"post",
                    "url":"<?Php echo $configuracion->getSiteAddress()?>/admin/repositorios/add.php?id=<?php echo $_GET["id"]?>",
                    "data":angular.copy(scope.repositorio),
                    "dataType":"json",
                    "success":function (e) {
                        console.log(e);
                        if(e)
                        {
                            parent.postMessage(e,location.origin);

                          //  location.reload();
                        }
                    }
                    ,"error":error
                }
            );

        }
    });
</script>
<div class="repositorio-form">

    <?php if($repositorio) {

        ?>

        <h3>Editar repositorio</h3>
        <?php
    }
    else
    {
        ?><h3>Nuevo repositorio</h3><?php
    }?>
    <form data-ng-submit="addRepositorio()">
        <input  data-ng-model="repositorio.id" hidden>
        <input  data-ng-model="repositorio.creation" hidden>
        <input  data-ng-model="repositorio.modification" hidden>
        <div>
            <label>Nombre</label>
            <input  data-ng-model="repositorio.nombre" type="text">
        </div>
        <div>
            <label>Host</label>
            <input   data-ng-model="repositorio.host" type="text">
        </div>
        <div>
            <label>URL</label>
            <input   data-ng-model="repositorio.url" type="text">
        </div>
        <div>
            <label>Puerto</label>
            <input data-ng-model="repositorio.puerto" type="text">
        </div>
        <div>
            <label>Usuario</label>
            <input  data-ng-model="repositorio.usuario" type="text">
        </div>
        <div>
            <label>Contraseña</label>
            <input  data-ng-model="repositorio.pass" type="password">
        </div>
        <div>
            <label>Ruta</label>
            <input  data-ng-model="repositorio.ruta" type="text">
        </div>

        <div>
            <label>Tipo de archivos permitidos (en construccion)</label>
        </div>
        <div>
            <button type="submit">Guardar cambios</button>
        </div>

    </form>

</div>