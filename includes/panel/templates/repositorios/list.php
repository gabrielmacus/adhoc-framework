
<script>


    angular.element(function () {

        

        scope.repositorios=[];

        <?php

        foreach ($repositorios as $r) {

        ?>

        scope.repositorios.push({
            name:"<?php echo   $r->getName()?>",
            url:"<?php echo $configuracion->getSiteAddress()."/admin/archivos/?r={$r->getId()}"?>",
            id:"<?php echo $r->getId()?>"
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
               url:"<?php echo $configuracion->getSiteAddress()."/admin/archivos/?r="?>"+e.data.id,
                   id:e.data.id
           });

               scope.$apply();



           }
        }, false);



    });
</script>






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
            width: 16.6666666%;
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


<?php

if(!$repositorio)
{
    ?>


    <div class="fila toolbar">
      <a class="btn" href="<?php echo $configuracion->getSiteAddress()?>/admin/repositorios/?popup=true&act=add" data-lity>
          <span class="original">Nuevo repositorio</span>
          <span class="mask">Nuevo repositorio</span>

      </a>
    </div>
    <div class="directory fila">

        <a  href="{{r.url}}&<?php echo  $_SERVER['QUERY_STRING'] ;?>" data-ng-repeat="r in repositorios" class="folder-container" style="padding: 10px">

            <div class="folder" >

                <div class="back">
                    <span class="caret"></span>
                </div>
                <div class="paper">

                </div>
                <div class="front">
                    <span class="name">{{r.name}}</span>
                    <input class="repositorios" data-id="{{r.id}}"  style="position:absolute;bottom: 10px;right: 10px;transform:scale(1.5)" type="checkbox">
                    
                </div>

            </div>
        </a>
        <a  data-lity href="#delete-repositorio-modal" class="icon-trash" style="position: fixed;bottom: 10px;right:28% ;z-index: 5;transform: scale(2)">
            <div class="trash-lid" style="background-color: #838383"></div>
            <div class="trash-container" style="background-color: #838383"></div>
            <div class="trash-line-1"></div>
            <div class="trash-line-2"></div>
            <div class="trash-line-3"></div>
        </a>

        <script>
            $(document).on("click",".file",function (e) {

                if($(e.target).closest("figure").length==0)
                {
                    $(this).toggleClass("active");
                }

            });

            $(document).on("click","#delete-repositorio-modal .yes",function (e) {

                var ids=[];
                $(".repositorios:checked").each(function () {
                    ids.push($(this).data("id"));
                });


                $.ajax(
                    {
                        method:"post",
                        data:{"repos":ids},
                        url:"<?php echo $configuracion->getSiteAddress()?>/admin/repositorios/delete.php",
                        dataType:"json",
                        success:function (e) {
                            console.log(e);
                            if(e)
                            {

                                $.each(ids,function (k,v) {

                                  var deletedRepo=  scope.repositorios.filter(
                                        function (element) {

                                            return element.id==v
                                        }
                                    )[0];

                                 var idx = scope.repositorios.indexOf(deletedRepo);

                                 scope.repositorios.splice(idx,1);

                                });

                                scope.$apply();
                            }
                        },
                        error:error
                    }
                );
            });
        </script>

        <div  id="delete-repositorio-modal" class="lity-hide promptModal">

            <p>¿Borrar los repositorios seleccionados? <b>Se borrarán los archivos que contengan</b></p>

            <div class="buttons">
                <div>
                    <a class="no">No</a>
                </div>
                <div>
                    <a  class="yes">Si</a>
                </div>


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
?>

<style>


</style>

