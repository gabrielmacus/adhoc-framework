<?php

if(!$shownText)
{
    $shownText="titulo";
}
?>
<script>
    angular.element(function () {
        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        scope.removeAnexo=function (a) {

            a.delete=true;

        }
        <?php if($post)
        {
            ?>
        if(!scope.post)
        {
            scope.post= <?php echo json_encode($post)?>;
        }
        if(!scope.post.anexos)
        {
            scope.post.anexos =<?php echo json_encode($post->getAnexos())?>;
  
        }


        var anexos =[];
        $.each(scope.post.anexos,function (k,v) {

            var text="";
            if(v.post_nexo_grupo== <?php echo $grupo;?>)
            {
                <?Php if(!is_array($shownText))
                {
                ?>       text+=v.post_<?php echo $shownText?>;

                <?Php
                }
                else
                {
                foreach ($shownText as $t)
                {
                ?>
                text+=v.post_<?php echo $t?>+" ";
                <?php
                }
                }?>


                anexos.push({post_id:v.id,post_nexo_id:v.post_nexo_id,post_anexo_id:v.post_anexo_id,text:text, post_nexo_grupo:v.post_nexo_grupo});

            }


        });

        if(anexos.length==0)
        {
            scope.post.anexos =anexos;
        }

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

                        scope.post.anexos.push(v);
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
    }


    .adjunto-wrapper
    { box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.10);
        padding: 0px;
        margin-bottom: 20px;
    }

    .adjuntos .adjunto
    {

        padding: 20px;
        background-color: rgba(236, 237, 228, 1);
        z-index: 0;
        width: 100%;
        float: left;
        display: block;

    }
</style>
<div class="fila adjuntos">
    <label class="fila" style="margin-bottom: 10px;"><?php echo $label;?></label>
    

    <div class="s12 m6 l4 padding " data-ng-repeat="a in post.anexos" data-ng-if="a.post_nexo_grupo==<?php echo $grupo;?>" data-ng-hide="a.delete">

        <div class="adjunto-wrapper" style="position: relative">
              <span data-ng-click="removeAnexo(a)" style="font-size:30px;cursor: pointer;position: absolute;z-index: 55;top: 5px;right:5px;color: rgba(220, 69, 47, 1)">
            <i class="fa fa-times" aria-hidden="true"></i>
        </span>



            <!--
            <figure style="height: 150px;width: 100%">
                <img data-ng-src="{{a.url}}" style="height: 100%;width: 100%;object-fit: cover">
            </figure>-->
            <a   data-lity href="<?php echo $configuracion->getSiteAddress()?>/admin/posts/?modal=true&t=<?php echo $tipo?>&s=<?php echo $s?>&act=view&id={{a.post_anexo_id}}"  class="adjunto">
                <span class="name" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis" >{{a.text}}</span>
            </a>
        </div>


    </div>
    <div class="fila">
        <a  data-lity  style="display: block;color: white!important;;" class="fila btn" href="<?php echo $configuracion->getSiteAddress()?>/admin/posts/?modal=true&grupo=<?php echo $grupo?>&t=<?php echo $tipo?>&s=<?php echo $s?>">Adjuntar anexos</a>
    </div>


</div>