
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
              url:"<?php echo $configuracion->getSiteAddress()?>/admin/files/delete.php",
              dataType:"json",
              success:function (e) {
                  console.log(e);
              },
              error:error
          }
      );
    });
</script>




<div class="directory fila">



    <?php



    if($repositorio)
    {
        foreach ($repositorio->getFiles() as $tipo=>$galeria)
        {



            switch ($tipo)
            {
                case 0:
                case 1:


                    foreach ($galeria as $key=>$originales)
                    {


                        foreach ($originales as $original)
                        {
                            $archivo = $original["original"];


                            ?>

                            <div class="file-container">

                                <div class="file" data-id="<?php echo $archivo->getId()?>">
                                    <div class="mask" >

                                    </div>
                                    <time class="date"><?php echo date($lang["dateFormatFiles"],$archivo->getCreation()) ?></time>
                                    <figure>
                                        <img   src="<?php echo     $archivo->getRealName()?>">
                                        <div class="preview">
                                            <a data-lity href="<?php echo     $archivo->getRealName()?>">
                                                <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="download">
                                            <a href="<?php echo     $archivo->getRealName()?>" download>
                                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                            </a>


                                        </div>
                                    </figure>

                                    <span class="name"><?php echo $archivo->getName();?></span>

                                </div>
                            </div>
                            <?php
                            unset( $original["original"]);
                            foreach ($original as $archivo)
                            {


                            }
                        }


                    }

                    break;
            }

        }
    }
    if(!$repositorio || count($repositorio->getFiles())==0)
    {
        ?>
        <h3>No hay archivos en el repositorio</h3>
        <?php
    }

    ?>


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
            <a class="no">No</a>
        </div>
        <div>
            <a class="yes">Si</a>
        </div>


    </div>

</div>