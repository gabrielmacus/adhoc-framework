
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
            "modification": "<?php echo $repositorio->getModification()?>"
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
                   if(e)
                   {
                       location.reload();
                   }
                   }
                   ,"error":error
               }
           );
       }

    });
</script>


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
            <button type="submit">Guardar cambios</button>
        </div>
    </form>




<?php if(!$repositorio)
{
    ?>


    <h3>Todos los repositorios</h3>
    <ul class="repositorios">
        <?php

        foreach ($repositorios as $repositorio)
        {




            ?>

            <li>
                <h3><span><?php echo $repositorio->getName();?></span></h3>
                <span><?php echo "#".$repositorio->getId();?></span> <span><?php echo  date($lang["dateFormat"],  $repositorio->getCreation())?></span>
                <span><?php echo $repositorio->getHost();?></span>
                <span><?php echo $repositorio->getUser();?></span>
                <span><?php echo     $repositorio->getPort();?></span>
                <span><?php echo     $repositorio->getPath();?></span>
            </li>

            <?php
        }?>
    </ul>

    <?php
}
else
{
    ?>
    <h3>Archivos en el repositorio</h3>

    <div class="files">

        <?php include DIR_PATH."/includes/panel/templates/archivos/list.php"?>

    </div>
    <?php
}?>
