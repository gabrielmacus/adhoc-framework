
<script>


    angular.element(function () {

        scope.preview=[];
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

<form>
<script>
    $(document).on("change",".file-zone [type='file']",function (e) {

        var files=  $(this)[0].files;

        var data = new FormData();
        $.each(files, function(key, value)
        {
            data.append(key, value);
        });



        $.ajax({
            url: "<?php echo $configuracion->getSiteAddress() ?>/admin/files/upload.php",
            type: "post",
            dataType: "html",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success:function(res)
            {

                res = JSON.parse(res);


                $.each(res,function (k,v) {


                    scope.preview.push(v);
                    scope.$apply();

                });


            }
        })
    });
</script>
    <div class="file-zone">

        <input type="file">
    </div>

    <div class="preview" data-ng-if="preview.length>0">
        <h3>Previsualizacion de subida de archivos</h3>
        <ul class="files-preview">
            <li data-ng-repeat="file in preview">

                <div class="image" data-ng-if="file.type=='jpg'">
                    <img data-ng-src={{file.url}}>
                    <h4>{{file.name}}</h4>
                    <span>{{file.size}}</span>
                </div>


            </li>
        </ul>
        <button type="submit">Subir archivo</button>
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
