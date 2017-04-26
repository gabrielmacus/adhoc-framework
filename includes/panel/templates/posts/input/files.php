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

    <input  id="<?php echo $id;?>" type="file" accept="<?Php  echo implode(",",$formats)?>"  >

    <?php

    $multiple=true;
    include DIR_PATH."/includes/panel/templates/posts/files.php";
    ?>

    <div class="files">

        <div class="file-preview s12 m6 l4" data-ng-repeat="p in previews" data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'">
            <!-- data-ng-if="p.type=='jpg' || p.type=='jpeg' ||p.type=='gif' ||p.type=='jpg' ||p.type=='png'"-->
            <div class="file" >

                <figure>
                    <img data-ng-src="{{p.url}}">
                </figure>

                <input class="name" data-ng-model="p.name">
                <span class="size"  data-ng-bind="getMb(p.size)"></span>
            </div>

        </div>

    </div>

</div>