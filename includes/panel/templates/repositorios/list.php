<style>

</style>
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
            "modification": "<?php echo $repositorio->getModification()?>",
            "url":"<?php echo $repositorio->getUrl()?>"
        };

        
  
        
        scope.$apply();
        <?php

        }?>

        scope.uploadFiles=function () {
            $.ajax(
                {
                    "method":"post",
                    "url":"<?Php echo $configuracion->getSiteAddress()?>/admin/files/add.php?rep=<?Php echo $_GET["id"]?>",
                    "data":{"files":angular.copy(scope.preview)},
                    "dataType":"json",
                    "success":function (e) {
                        console.log(e);
                        if(e)
                        {

                        }
                    }
                    ,"error":error
                }
            );

            
        }
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

<form data-ng-submit="uploadFiles()">
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

    <?php if($repositorio) {

        ?>
        <div class="file-zone">
            <input type="file" multiple>
        </div>
        <?php
    }
    ?>




    <div class="preview" data-ng-if="preview.length>0">
        <h3>Previsualizacion de subida de archivos</h3>
        <ul class="files-preview">
            <li data-ng-repeat="file in preview">

                <div class="image" data-ng-if="file.type=='jpg'">
                    <img data-ng-src={{file.url}}>
                    <input data-ng-model="file.name">
                    <span>{{file.size}}</span>
                </div>


            </li>
        </ul>
        <button type="submit">Subir archivos</button>
    </div>

</form>




<?php if(!$repositorio)
{
    ?>


    <h3>Todos los repositorios</h3>

    <style>
        .folder
        {
            position: relative;
            width: 140px;
            height: 100px;
        }
        .folder .front
        {
            -webkit-transition: all 400ms;
            -moz-transition: all 400ms;
            -ms-transition: all 400ms;
            -o-transition: all 400ms;
            transition: all 400ms;

            background-color: #ffcc66;
            position: absolute;
            top: 0px;
            left:0px;
            width:100%;
            height: 100%;
            border-radius: 7px;
            /* Firefox anti-aliasing hack */
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;

        }
        .folder .front:hover
        {
            transform: skew(-20deg,0deg); /* Standard syntax */
        }
        .folder .back .caret
        {

            background-color: #cca352;
            position: absolute;
            top: -10px;
            left: 0px;
            width: 40%;
            border-radius: 5px;
            height: 20px;

        }
        .folder .back
        {
            background-color: #cca352;
            position: absolute;
            top: 0px;
            left:0px;
            width:100%;
            height: 100%;
            border-radius: 7px;
        }
    </style>

    <div>

        <div class="folder" >

            <div class="back">
                <span class="caret"></span>

            </div>
            <div class="front">

            </div>
        </div>
    </div>


    <!--
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
    -->

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
