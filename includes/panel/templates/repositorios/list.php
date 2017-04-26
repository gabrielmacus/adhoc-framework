<script>


    angular.element(function () {

        <?php if($repositorios)
        {
            ?>

        scope.repositorios = <?php echo json_encode($repositorios)?>;
        <?php
        }else
        {
            ?>
        scope.post = <?php echo json_encode(reset($repositorio))?>;
        console.log( scope.tags1);
        $("#tags1").val();
        $("#add-repositorio").hide();
        $("#new-repositorio").show();
        <?php

        }?>

        scope.$apply();
        scope.save=function () {
            console.log(scope.post);
            $.ajax
            (
                {
                    method:"post",
                    url:"<?php echo $configuracion->getSiteAddress()."/admin/repositorios/data.php?act=save"?>",
                    data:angular.copy(scope.post),
                    dataType:"json",
                    success:function (e) {
                        console.log(e);
                    },
                    error:function (e) {

                        console.log(e);
                    }
                }
            );

        }

    });

    $(document).on("click",".item",function () {
        $(this).find(".content").stop();
        $(this).find(".content").slideToggle();
    })
    $(document).on("click","#add-repositorio",function () {

        $("#new-repositorio").slideToggle();

    });
</script>
<header>
    <h2 class="title"><?php echo $lang["repositorios"]?></h2>
</header>

<div class="body">

    <button id="add-repositorio">Nuevo</button>
    <form id="new-repositorio" class="fila" style="display: none;background-color:#efefef">
        <?php
        $label="Nombre";
        $model="nombre";
        $class=["s12","m6","l6"];
        include DIR_PATH."/includes/panel/templates/posts/input/text.php";

        $label="Directorio";
        $model="ruta";
        $class=["s12","m6","l6"];
        include DIR_PATH."/includes/panel/templates/posts/input/text.php";

        $label="Host";
        $model="host";
        $class=["s12","m12","l12"];
        include DIR_PATH."/includes/panel/templates/posts/input/text.php";

        $label="Usuario";
        $model="usuario";
        $class=["s12","m6","l6"];
        include DIR_PATH."/includes/panel/templates/posts/input/text.php";

        $label="Contraseña";
        $model="pass";
        $class=["s12","m6","l6"];
        include DIR_PATH."/includes/panel/templates/posts/input/password.php";


        $label="Url";
        $model="url";
        $class=["s12","m6","l6"];
        include DIR_PATH."/includes/panel/templates/posts/input/text.php";


        $label="Puerto";
        $model="puerto";
        $class=["s12","m6","l6"];
        include DIR_PATH."/includes/panel/templates/posts/input/number.php";

        $label="Resoluciones (solo imágenes)";
        $id="tags1";
        $placeholder="nombre:altoxancho.Ej: portada:200x200,...";
        $model="versiones";
        $class=["s12","m12","l12"];
        $max="7";
        include DIR_PATH."/includes/panel/templates/posts/input/tags.php";


        $action="save()";
        $name="Guardar cambios";
        include DIR_PATH."/includes/panel/templates/posts/input/submit.php";



        ?>

    </form>


    <ul class="list" style="margin-top: 10px;">

        <li class="item" data-ng-repeat="(k,r) in repositorios">
            <a class="animated" style="position: relative">
                <span class="name">{{r.nombre}}</span>
                <a  class="icon animated" href="<?php echo $configuracion->getSiteAddress()."/admin/repositorios/?id="?>{{r.id}}"><i class="fa fa-pencil  " aria-hidden="true"></i></a>
                <a class="icon animated"><i class="fa fa-trash-o icon animated" aria-hidden="true"></i></a>
            </a>
            <div class="content">

                <div class="peso">
                    {{r.url}}
                </div>

                <a href="<?php echo $configuracion->getSiteAddress()."/admin/archivos/?rep=";?>{{r.id}}" class="archivos">

                    Ver archivos
                    <span class="mask animated"><i class="fa fa-file" aria-hidden="true"></i></span>

                </a>
            </div>
        </li>

    </ul>

</div>
