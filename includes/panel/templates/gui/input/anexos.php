<?php
if(!$textBtn)
{
    $textBtn="Adjuntar anexo";
}
if(!$shownText)
{
    $shownText="titulo";
}
$showError = (is_array($min) || is_numeric($max));

?>
<script>
    angular.element(function () {



        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        scope.anexos<?php echo $grupo;?>IsEmpty=function () {




            var group=scope.post.anexosGroups["<?php echo $grupo?>"];

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

        scope.getText<?php echo $grupo;?>=function (a) {



            if(!a.text)
            {
                a.text="";
                var shownText=<?php echo json_encode($shownText)?>;

                if( typeof shownText === 'string' ) {

                    a.text= a.post_<?php echo $shownText?>;

                }
                else
                {
                    <?php foreach ($shownText as $t)
                    {
                        ?>

                    a.text+=a.post_<?php echo $t?>+" ";
                    <?php
                    }?>
                }
            }

            return a.text;


        }



        scope.validation.anexos<?php echo $grupo?>= {
            isValid: true, check: function () {


                <?php
                if($showError)
                {

                if($min)
                {
                ?>

                var arr = scope.post.anexosGroups[<?php echo $grupo;?>].filter(
                    function (el) {
                        return !el.delete;
                    }
                );

                if(arr.length<<?php echo $min;?>)
                {
                    scope.validation.anexos<?php echo $grupo?>.isValid=false;

                    setTimeout(function () {
                        scope.$apply();
                    });

                    return false;
                }
                else
                {
                    scope.validation.anexos<?php echo $grupo?>.isValid=true;
                }


                <?php
                }

                if($max)
                {
                ?>
                if(arr.length><?php echo $max;?>)
                {
                    scope.validation.anexos<?php echo $grupo?>.isValid=false;

                    setTimeout(function () {
                        scope.$apply();
                    });

                    return false;
                }
                else
                {
                    scope.validation.anexos<?php echo $grupo?>.isValid=true;
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


        scope.removeAnexo<?php echo $grupo;?>=function (a) {

            a.delete=true;

            scope.validation.anexos<?php echo $grupo?>.check();
        }
        <?php if($post)
        {
            ?>
        if(!scope.post)
        {
            scope.post= <?php echo json_encode($post)?>;


        }

        if(!scope.anexos)
        {
           scope.anexos= scope.post.anexos;
            scope.post.anexos=[];
        }
        if(!scope.post.anexosGroups)
        {
            scope.post.anexosGroups=[];
        }
        scope.post.anexosGroups[<?php echo $grupo;?>]=[];

        $.each(scope.anexos,function (clave,valor) {

            $.each(valor,function (k,v) {

                var  text="";

                if(v.nexoGrupo== <?php echo $grupo;?>)
                {

                    <?Php if(!is_array($shownText))
                    {
                    ?>
                       text+=v.<?php echo $shownText?>;

                    <?Php
                    }
                    else
                    {
                    foreach ($shownText as $t)
                    {

                    ?>

                    if( v.<?php echo $t?>)
                    {

                        text += "<p class='paragraph-preview'>"+v.<?php echo $t?>+"</p>";
                    }

                    <?php
                    }
                    }?>


                    var anexo={post_id:v.id,post_nexo_id:v.nexoId,post_anexo_id:v.anexoId,text:text, post_nexo_grupo:v.nexoGrupo};


                    scope.post.anexosGroups[<?php echo $grupo;?>].push(anexo);

                }


            });

        });


        scope.$apply();



        <?Php
        }?>
        // Listen to message from child window
        eventer(messageEvent,function(e) {
            console.log(e);
            if(e.origin == "<?php echo $configuracion->getSiteAddress()?>")
            {

                if(!scope.post.anexos)
                {
                    scope.post.anexos=[];
                }

                $.each(e.data,function (k,v) {


                    if(v.post_nexo_grupo=="<?php echo $grupo?>")
                    {

                        scope.post.anexosGroups[<?php echo $grupo;?>].push(v);

                        scope.validation.anexos<?php echo $grupo?>.check();
                      //  scope.post.anexos.push(v);
                    }

                });
                setTimeout(function () {
                    scope.$apply();
                });

            }
        },false);






    });


</script>
<style>
    .adjuntos
    {

        padding: 10px;
        display: flex!important;
        flex-wrap: wrap;
    }


    .adjunto-wrapper
    {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.10);
        padding: 0px;
        margin-bottom: 20px;
        height: 100%;
    }

    .adjuntos .adjunto
    {

        padding: 20px;
        background-color: rgba(236, 237, 228, 1);
        z-index: 0;
        width: 100%;
        float: left;
        display: block;
        height: 100%;

    }
</style>



<div class="fila adjuntos"   >
    <label class="fila" style="margin-bottom: 10px;"><?php echo $label;?></label>


    <ul class="grid"  ui-sortable  data-ng-model="post.anexosGroups[<?php echo $grupo;?>]" id="sortable<?php echo $grupo;?>" >
        <li  data-idx="{{k}}" class="s12 m6 l4 padding item" data-ng-repeat="(k,a) in post.anexosGroups[<?php echo $grupo;?>]" data-ng-if="a.post_nexo_grupo==<?php echo $grupo;?>"  data-ng-hide="a.delete">

            <div  class="adjunto-wrapper" style="position: relative">
              <span data-ng-click="removeAnexo<?php echo $grupo;?>(a)" style="font-size:30px;cursor: pointer;position: absolute;z-index: 55;top: 5px;right:5px;color: rgba(220, 69, 47, 1)">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span>
                <!--
                <figure style="height: 150px;width: 100%">
                    <img data-ng-src="{{a.url}}" style="height: 100%;width: 100%;object-fit: cover">
                </figure>-->
                <a   data-lity href="<?php echo $configuracion->getSiteAddress()?>/admin/posts/?modal=true&t=<?php echo $tipo?>&s=<?php echo $s?>&act=view&id={{a.post_anexo_id}}"  class="adjunto">
                <span class="name" style="white-space: pre-wrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 25px;" data-ng-bind-html="getText<?php echo $grupo?>(a)"></span>
                </a>
            </div>

        </li>
    </ul>
    <div class="fila margin empty" data-ng-if='anexos<?php echo $grupo;?>IsEmpty()'>

        <h3><?php echo $label;?> no tiene contenido</h3>

    </div>
    <div class="fila" style="margin-top: 15px">
        <a data-lity class="btn" style="color: white!important;" href='/admin/posts/?modal=true&grupo=<?php echo $grupo?>&s=<?php echo $s;?>&t=<?php echo $tipo;?>&shownText=<?php echo json_encode($shownText)?>'><?php echo $textBtn;?></a>

    </div>

    <?php
    if($showError) {
        $model="anexos".$grupo;
        include "error.php";
    }
    ?>
</div>

<script>

</script>

