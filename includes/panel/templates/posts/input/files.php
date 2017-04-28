<script>

    angular.element(function () {
        scope.previews=[];
        scope.deletePreview=function (e) {
            var idx=scope.previews.indexOf(e);
            scope.previews.splice(idx,1);
            scope.$apply();
        };
        scope.getMb=function (a,b) {

            if(0==a)return"0 Bytes";var c=1e3,d=b||2,e=["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"],f=Math.floor(Math.log(a)/Math.log(c));return parseFloat((a/Math.pow(c,f)).toFixed(d))+" "+e[f];

        }
    });

    $(document).on("change","#<?php echo $id?>",function (e) {


        <?php

        if(is_numeric($max))
        {
        ?>

        if(scope.previews.length >= <?php echo $max?>)
        {
            vex.dialog.alert("Solo se permite <?php echo $max?> archivo/s");
            return false;
        }
        <?php
        }?>


        var files =$(this)[0].files;
        var data = new FormData();

        $.each(files,function (k,v) {

            data.append(k,v);
        });




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

              setTimeout(function () {
                  scope.$apply();
              })

  /*              $.each(res,function (k,v) {

                    scope.preview.push(v);
                    scope.$apply();

                });
*/

            },
            error:function () {

                alert("err");
            }
        })




    })
    
</script>

<div class="form-block">

    <label><?php echo $label?></label>


    <div class="file" style="height: 180px;text-align: center">


        <input style="width: 100%;height: 100%;position: absolute;opacity: 0;left: 0;z-index: 1000"   id="<?php echo $id;?>" type="file" accept="<?Php  echo implode(",",$formats)?>"  >
        <span style="font-weight: 600;    top: 38%;
    font-size: 20px;
    position: relative;
    text-align: center;"><?php echo $uploadMessage;?></span>

        <i style="position: absolute;top: 20px;right: 20px;font-size:50px;color: #0d71bb" class="fa fa-cloud-upload" aria-hidden="true"></i>

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