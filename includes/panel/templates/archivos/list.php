
<style>




    .file-container
    {
        position: relative;
        padding: 10px;
    }
    .file.active .mask
    {
        opacity: 1;
    }
    .file.active figure
    {
        z-index: 4;
    }
    .file-container .mask
    {
        -webkit-transition: all 300ms;
        -moz-transition: all 300ms;
        -ms-transition: all  300ms;
        -o-transition: all 300ms;
        transition: all  300ms;
        opacity: 0;
        position: absolute;right: 0px;top:0px;width: 100%;height: 100%;
        z-index: 5;
        background-color: rgba(0,0,0,.6);
        background-image: url("https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-256.png");
        -webkit-background-size:100%;
        background-size:50%;
        background-position: center;
        background-repeat: no-repeat;
    }
    .file
    {    position:relative;
        background: white;
        padding:20px;
        overflow: hidden!important;
        cursor: pointer;
    }
    .file .date
    {
        margin-bottom: 10px;
        float: left;
    }

    .file:hover:before
    {
        border-width:0  0px 0px 0;
    }

    .file:before {
        -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;

        content:"";
        position:absolute;
        top:0;
        right:0;
        border-width:0 27px 27px 0;
        border-style:solid;

        border-color:rgba(248, 248, 248, 1) #ededed;
        /* css3 extras */
        -webkit-box-shadow:0 1px 1px rgba(0,0,0,0.3),
        -1px 1px 1px rgba(0,0,0,0.2);
        -moz-box-shadow:0 1px 1px rgba(0,0,0,0.3),
        -1px 1px 1px rgba(0,0,0,0.2);
        box-shadow:0 1px 1px rgba(0,0,0,0.3),
        -1px 1px 1px rgba(0,0,0,0.2);
    }
    .file .name
    {
        margin-top: 5px;
        float: left;
        font-size: 18px;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .file figure {

        z-index: 7;
        overflow: hidden;
        float: left;
        width: 100%;
        position: relative;
    }
    .file figure .preview
    {
        -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;

        left: 0%;
        top:0px;
        width: 0%;
        background-color: rgba(0, 0, 0, 0.45);
        position: absolute;
        height: 100%;

    }
    .file figure  .preview a
    {  -webkit-transition: all 600ms;
        -moz-transition: all  600ms;
        -ms-transition: all  600ms;
        -o-transition: all 600ms;
        transition: all  600ms;
        opacity: 0;
        position: absolute;
        font-size: 36px;
        color: white;
        top: 35%;
        left: 35%;
    }

    .file figure  .download a
    {  -webkit-transition: all 600ms;
        -moz-transition: all  600ms;
        -ms-transition: all  600ms;
        -o-transition: all 600ms;
        transition: all  600ms;
        opacity: 0;
        position: absolute;
        font-size: 36px;
        color: white;
        top: 35%;
        right: 35%;
    }
    .file figure .download
    {        -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;

        right: 0%;

        top:0px;
        width: 0%;
        background-color: rgba(0, 0, 0, 0.45);
        position: absolute;
        height: 100%;

    }
    .file figure .preview:hover a
    {

        color: rgba(28, 150, 255, 1)

    }

    .file figure .download:hover a
    {

        color: #58e055

    }
    .file figure:hover a
    {
        opacity: 1;
    }
    .file figure:hover .preview
    {
        width: 50%;
        left: 0%;
    }
    .file figure:hover .download
    {  width: 50%;
        right: 0%;
    }
    .file figure:hover img
    {  -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;
        -ms-filter: blur(2px);
        filter: blur(2px);
    }


    .file img {
        width: 100%;
        object-fit: cover;
        -webkit-transition: all 300ms;
        -moz-transition: all  300ms;
        -ms-transition: all  300ms;
        -o-transition: all 300ms;
        transition: all  300ms;

        height: 200px;

    }

    @media screen and  (min-width:1024px)  {

        .file-container
        {

            width: 25%;
            float: left;
        }

    }
    @media screen and (min-width: 769px) and  (max-width:1023px)  {

        .file-container
        {
            width: 33.33333%;
            float: left;
        }

    }

    @media screen and (min-width:601px) and (max-width:768px) {
        .file-container
        {
            width: 33.333333%;
            float: left;
        }

    }
    @media screen and (max-width:600px) {

        .file-container
        {
            width: 100%;
            float: left;
        }
        .file img
        {
            height: 200px;

        }
    }
</style>
<form data-ng-submit="uploadFiles()">
    <script>


        angular.element(function () {
            scope.preview=[];


            scope.uploadFiles=function () {

                console.log(scope.preview);
                $.ajax(
                    {
                        "method":"post",
                        "url":"<?php echo $configuracion->getSiteAddress()?>/admin/archivos/add.php?rep=<?php echo $_GET["r"]?>",
                        "data":{"files":angular.copy(scope.preview)},
                        "dataType":"json",
                        "success":function (e) {
                            console.log(e);
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
        $(document).on("change",".file-zone [type='file']",function (e) {

            var files=  $(this)[0].files;

            var data = new FormData();
            $.each(files, function(key, value)
            {
                data.append(key, value);
            });


            $.ajax({
                url: "<?php echo $configuracion->getSiteAddress() ?>/admin/archivos/upload.php",
                type: "post",
                dataType: "html",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(res)
                {


                    res = JSON.parse(res);

                    console.log(res);
                    $.each(res,function (k,v) {

                        scope.preview.push(v);
                        scope.$apply();

                    });


                }
            })
        });
    </script>

    <?php if($_GET["r"]) {

        ?>
        <div class="file-zone">
            <input type="file" multiple>
        </div>
        <?php

    }
    ?>

    <!--
        <style>
            .preview
            {
                padding: 25px;
                float: left;
                width:100%;
            }
            .preview li
            {
                float: left;
                width: 25%;
                margin-top:15px;
            }
            .preview img
            {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }
        </style>

        -->
    <div class="preview" data-ng-if="preview.length>0">
        <h3>Previsualizacion de subida de archivos</h3>
        <ul class="files-preview">
            <li data-ng-repeat="file in preview">

                <div class="image" data-ng-if="file.type=='jpg' || file.type=='jpeg' || file.type=='png' || file.type=='gif'">
                    <img style="width: 100%" data-ng-src={{file.url}}>
                    <input data-ng-model="file.name">
                    <span>{{file.size}}</span>
                </div>


            </li>
        </ul>
        <button type="submit">Subir archivos</button>
    </div>

</form>


<script>
    $(document).on("click",".file",function (e) {

        if($(e.target).closest("figure").length==0)
        {
            $(this).toggleClass("active");
        }

    });

   $(document).on("click","#delete-file-modal .yes",function (e) {

        var ids=[];
        $(".file.active").each(function () {
            ids.push($(this).data("id"));
        });

      $.ajax(
          {
              method:"post",
              data:{"files":ids},
              url:"<?php echo $configuracion->getSiteAddress()?>/admin/archivos/delete.php",
              dataType:"json",
              success:function (e) {
                  if(e)
                  {
                      location.reload();
                  }
                  console.log(e);
              },
              error:error
          }
      );
    });
</script>




<div class="directory fila">



    <?php



    if($archivos)
    {
        foreach ($archivos as $tipo=>$galeria)
        {




            switch ($tipo)
            {
                case 0:
                case 1:


                    foreach ($galeria as $key=>$originales)
                    {


                        foreach ($originales as $original)
                        {
                            $tamanoPanel="portada";
                            $archivo = $original[$tamanoPanel];


                            ?>

                            <div class="file-container">

                                <div data-id="<?php echo   $original["original"]->getId()?>" data-type="<?php echo $archivo->getType();?>" data-url="<?php echo $archivo->getRealName(); ?>" class="file" >
                                    <div class="mask" >

                                    </div>
                                    <time class="date"><?php echo date($lang["dateFormatFiles"],$archivo->getCreation()) ?></time>
                                    <figure>
                                        <img   src="<?php echo     $archivo->getRealName()?>">
                                        <div class="preview">
                                            <a data-lity href="<?php echo     $original["original"]->getRealName()?>">
                                                <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="download">
                                            <a href="<?php echo     $original["original"]->getRealName()?>" download>
                                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                            </a>


                                        </div>
                                    </figure>

                                    <span class="name"><?php echo $archivo->getName();?></span>

                                </div>


                            </div>
                            <?php
                            unset( $original[$tamanoPanel]);
                            foreach ($original as $archivo)
                            {


                            }
                        }


                    }

                    break;
            }

        }
    }
    if(!$archivos || count($archivos)==0)
    {
        ?>
        <h3>No hay archivos en el repositorio</h3>
        <?php
    }

    ?>


<?php if($_GET["modal"])
{
    ?>

    <script>

        $(document).on("click","#select-files",function () {

            var urls=[];
            $(".file.active").each(function () {
                urls.push({url:$(this).data("url"),id:$(this).data("id"),type:$(this).data("type")});
            });

            var data={urls:urls};

            <?php
            if($_GET["gal"])
            {
                ?>
            data.gal = <?php echo $_GET["gal"]?>;
            <?php
            }?>

            parent.postMessage(data,location.origin);


        });
    </script>

    <div class="fila">

        <div class="s12 m6 l4"><a id="select-files">Aceptar</a></div>

    </div>
    <?php
}?>

</div>
<a data-lity href="#delete-file-modal" class="icon-trash" style="position: fixed;bottom: 10px;right:28% ;z-index: 5;transform: scale(2)">
    <div class="trash-lid" style="background-color: #838383"></div>
    <div class="trash-container" style="background-color: #838383"></div>
    <div class="trash-line-1"></div>
    <div class="trash-line-2"></div>
    <div class="trash-line-3"></div>
</a>

<div  id="delete-file-modal" class="lity-hide promptModal">

    <p>¿Borrar los archivos seleccionados?</p>

    <div class="buttons">
        <div>
            <a data-lity-close class="no">No</a>
        </div>
        <div>
            <a data-lity-close class="yes">Si</a>
        </div>


    </div>

</div>