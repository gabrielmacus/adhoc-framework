<style>

</style>
<script>


    angular.element(function () {

        
        scope.preview=[];
        scope.repositorios=[];

        <?php

        foreach ($repositorios as $r) {

        ?>

        scope.repositorios.push({
            name:"<?php echo   $r->getName()?>",
            url:"<?php echo $configuracion->getSiteAddress()."/admin/repositorios/?id={$r->getId()}"?>"
        });

        <?php
        }
        ?>

        scope.$apply();
        window.addEventListener("message", function (e) {
           if(e.origin==location.origin)
           {
               scope.repositorios.push({
               name:e.data.nombre,
               url:"<?php echo $configuracion->getSiteAddress()."/admin/repositorios/?id="?>"+e.data.id
           });

               scope.$apply();



           }
        }, false);
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


    });
</script>


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




<?php

if(!$repositorio)
{
    ?>



    <style>

        .repositorios-breadcrumb
        {

        }
        .repositorio-form
        {
            display: none;

        }

        .directory
        {
            padding: 20px;

        }

        .folder
        {
            position: relative;
            width: 100%;
            height: 100px;
            float: left;
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
            padding: 10px;
        }
        .folder .front .name
        {

            overflow: hidden;
            text-overflow: ellipsis;
        }
        .folder .paper
        { -webkit-transition: all 300ms;
            -moz-transition: all 300ms;
            -ms-transition: all 300ms;
            -o-transition: all 300ms;
            transition: all 300ms;

            position: absolute;
            height: 90%;
            width: 90%;
            left: 5%;
            top: 5%;
            background-color: #fffdf5;

        }
        .folder:hover .paper
        {  left: 10px;
            top: 10px;
            height: 90%;
            transform: skew(-5deg,0deg);
            top: -7%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .folder:hover .front
        {
            left: 7px;
            top: 7px;
            height: 93%;
            transform: skew(-10deg,0deg)
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


        @media screen and  (min-width:1024px)  {


            .folder-container
            {
                width: 15%;
                float: left;
            }

        }
        @media screen and (min-width: 769px) and  (max-width:1023px)  {


            .folder-container
            {
                width: 20%;
                float: left;
            }

        }

        @media screen and (min-width:601px) and (max-width:768px) {
            .folder-container
            {
                width: 25%;
                float: left;
            }

        }
        @media screen and (max-width:600px) {

            .folder-container
            {
                width: 50%;
                float: left;
            }
        }



        .btn
        {
            cursor: pointer;
            -webkit-transition: all 300ms;
            -moz-transition:all 300ms;
            -ms-transition: all 300ms;
            -o-transition: all 300ms;
            transition: all 300ms;

            padding: 20px;
            display: inline-block;
            background-color:  #262626;
            color: white;
            font-weight: 600;
            overflow: hidden;
            position: relative;

        }

        .btn .original
        {
            z-index: 20;


        }

        .btn .mask
        {

            z-index: 2;
            display: inline-block;
            background-color: white;
            color: #262626;
            font-weight: 600;
            width:100%;
            position: absolute;
            right:0%;
            bottom:0px;
            -webkit-transition: all 400ms;
            -moz-transition:all 400ms;
            -ms-transition: all 400ms;
            -o-transition: all 400ms;
            transition: all 400ms;
            height:100%;
            perspective: 800px;
            padding: 20px;
        }


        .btn:hover .mask
        {

            right: -95%;
            color:white;
        }



        .toolbar{
            padding-left: 20px;
            padding-top: 20px;
        }

    </style>

    <div class="fila toolbar">
      <a class="btn" href="<?php echo $configuracion->getSiteAddress()?>/admin/repositorios/?modal=true" data-lity>
          <span class="original">Nuevo repositorio</span>
          <span class="mask">Nuevo repositorio</span>

      </a>
    </div>
    <div class="directory fila">

        <a  href="{{r.url}}" data-ng-repeat="r in repositorios" class="folder-container" style="padding: 10px">

            <div class="folder" >

                <div class="back">
                    <span class="caret"></span>
                </div>
                <div class="paper">

                </div>
                <div class="front">
                    <span class="name">{{r.name}}</span>
                </div>

            </div>
        </a>

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
