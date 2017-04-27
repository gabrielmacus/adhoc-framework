<script>

    angular.element(function () {
        scope.previews=[];
    });
    $(document).on("change","#<?php echo $id?>",function (e) {

        var files =$(this)[0].files;
        var data = new FormData();

        $.each(files,function (k,v) {

            data.append(k,v);
        });

        scope.getMb=function (a,b) {

            if(0==a)return"0 Bytes";var c=1e3,d=b||2,e=["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"],f=Math.floor(Math.log(a)/Math.log(c));return parseFloat((a/Math.pow(c,f)).toFixed(d))+" "+e[f];

        }

        $.ajax({
            url: "<?php echo $configuracion->getSiteAddress() ?>/admin/archivos/data.php?act=upload",
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
                $.merge(scope.previews, res);

                scope.$apply();

  /*              $.each(res,function (k,v) {

                    scope.preview.push(v);
                    scope.$apply();

                });
*/

            }
        })




    })
    
</script>

<div class="form-block">

    <label><?php echo $label?></label>

    <input hidden  id="<?php echo $id;?>" type="file" accept="<?Php  echo implode(",",$formats)?>"  >

    <div class="file" style="height: 180px;">
        <span style="font-size: 25px;font-weight: 600;    top: 38%;
    font-size: 25px;
    position: relative;
    text-align: center;">Arrastre el archivo para subirlo</span>
    </div>


    <?php

    //$multiple=true;
   // include DIR_PATH."/includes/panel/templates/posts/files.php";
    if(!$view)
    {
        include DIR_PATH."/includes/panel/templates/posts/preview.php";
    }
    else
    {
        include $view;
    }
    ?>



</div>