<?php

if(!$errorMsg)
{
    $errorMsg="Seleccione archivos válidos";
}

$showError = (is_array($min) || is_numeric($max) || $formats);
?>
<script>
    angular.element(function () {
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        /*
        scope.$watch($scope.cart, $scope.updateCart(), true);
*/

        scope.validation.archivos<?php echo $grupo?>=
        {
            isValid: true, check: function () {


                <?php
                if($showError)
                {

                if($min)
                {
                ?>

                var arr = scope.post.archivosGroups[<?php echo $grupo;?>].filter(
                    function (el) {
                        return !el.delete;
                    }
                );

                if(arr.length<<?php echo $min;?>)
                {
                    scope.validation.archivos<?php echo $grupo?>.isValid=false;

                    setTimeout(function () {
                        scope.$apply();
                    });

                    return false;
                }
                else
                {
                    scope.validation.archivos<?php echo $grupo?>.isValid=true;
                }


                <?php
                }

                if($max)
                {
                ?>
                if(arr.length><?php echo $max;?>)
                {
                    scope.validation.archivos<?php echo $grupo?>.isValid=false;

                    setTimeout(function () {
                        scope.$apply();
                    });

                    return false;
                }
                else
                {
                    scope.validation.archivos<?php echo $grupo?>.isValid=true;
                }

                <?php
                }
                ?>






                setTimeout(function () {
                    scope.$apply();
                });

                <?php
                }

                ?>


            }
        };



        scope.adjuntos<?php echo $grupo;?>IsEmpty=function () {


            var group=scope.post.archivosGroups["<?php echo $grupo?>"];

            if(group)
            {
                var filter = group.filter(
                    function (el) {

                        return !el.delete;
                    }
                );
                return  filter.length==0;
            }
            else
            {
                return true;
            }


        }
        scope.removeAdjunto<?php echo $grupo;?>=function (a) {

            a.delete=true;

            scope.validation.archivos<?php echo $grupo?>.check();
        }

        if(!scope.post)
        {
            scope.post={};
        }

        if(!scope.post.archivosGroups)
        {
            scope.post.archivosGroups={};
        }
        // Listen to message from child window
        eventer(messageEvent,function(e) {
            console.log(e);
            if(e.origin == "<?php echo $configuracion->getSiteAddress()?>")
            {


                if(!scope.post.archivos)
                {
                    scope.post.archivos=[];
                }


                $.each(e.data,function (k,v) {

                    if(v.archivo_grupo==<?php echo $grupo?> && !e.embeed)
                    {

                        if(!scope.post.archivosGroups["<?php echo $grupo?>"])
                        {
                            scope.post.archivosGroups["<?php echo $grupo?>"]=[];
                        }

                        scope.post.archivosGroups["<?php echo $grupo?>"].push(v);

                        scope.validation.archivos<?php echo $grupo?>.check();
                        //scope.post.archivos.push(v);
                    }

                });
              setTimeout(function () {
                  scope.$apply();
              });

            }
        },false);
    });

    $(document).on("click","#adjuntarArchivo<?php echo $grupo;?>",function (e) {

        var href="<?php echo $configuracion->getSiteAddress()?>/admin/repositorios/?modal=true&grupo=<?php echo $grupo; ?><?php if(!empty($formats)){ echo "&formats=".implode(",",$formats); } ?>";

        var group=scope.post.archivosGroups["<?php echo $grupo?>"];

        if(group && group.length)
        {
            var ids=group.map(
                function (el) {
                    return el.archivo_id;
                }
            );

            ids= ids.join();

            href+="&exclude="+ids;
        }

        console.log(href);

        var lightbox = lity(href);

    });

</script>
<style>
    .adjuntos
    {
        padding: 10px;
    }

    .adjunto-wrapper
    {
        padding: 15px;
    }

    .adjuntos .adjunto
    {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.10);
        padding: 10px;
    }
</style>
<div style="display: block!important;" class="fila adjuntos"  ui-sortable="sortableOptions<?php echo $grupo;?>"  data-ng-model='post.archivosGroups["<?php echo $grupo?>"]'>
    <label class="fila" style="margin-bottom: 10px;"><?php echo $label;?></label>

    <div   class="s12 m6 l4 padding " data-ng-repeat='a in post.archivosGroups["<?php echo $grupo?>"]'  data-ng-hide="a.delete">

        <div class="adjunto-wrapper" style="position: relative">
              <span data-ng-click="removeAdjunto<?php echo $grupo;?>(a)" style="font-size:30px;cursor: pointer;position: absolute;top:5px;right:5px;color: rgba(220, 69, 47, 1)">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span>

            <figure style="height: 150px;width: 100%">
                <img data-ng-src="{{a.url}}" style="height: 100%;width: 100%;object-fit: cover">
            </figure>
            <div class="adjunto">
                <span class="name" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis">{{a.name}}</span>
            </div>
        </div>


    </div>

    <div class="fila margin empty" data-ng-if='adjuntos<?php echo $grupo;?>IsEmpty()'>

        <h3><?php echo $label;?> no tiene contenido</h3>

    </div>
    <div class="fila margin">
        <a id="adjuntarArchivo<?php echo $grupo;?>" style="display: block;color: white!important;;" class="fila btn" >Adjuntar archivo</a>
    </div>


</div>
<?php
if($showError) {
    $model="archivos".$grupo;
    include "error.php";
}
?>