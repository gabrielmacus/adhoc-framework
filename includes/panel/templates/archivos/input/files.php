<script>

    angular.element(function () {
        scope.previews=[];


    });

   function loadSindicado() {
       var e =$("#<?php echo $id;?>sindicado");
           var patternYoutube=/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/g;

           patternYoutube=patternYoutube.test(e.val());

           if(patternYoutube)
           {
               var url=e.val();

               $.ajax(
                   {
                       "dataType":"json",
                       "method":"get",
                       "url":"<?php echo $configuracion->getSiteAddress()?>/extras/youtube/get_info.php?url="+url,
                       "success":function (e) {

                           console.log(e);
                           var yt={url:url,type:"youtube",
                               size:e.thumbnail_url,
                               name:e.title,
                               mime:e.author_url
                           };

                           scope.previews.push(yt);
                           setTimeout(function () {
                               scope.$apply();
                           })
                       },
                       "error":error
                   }

               );

           }

       var patternVimeo = /https:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/g;

       patternVimeo= patternVimeo.test(e.val());

       if(patternVimeo)
       {
           var url=e.val();

           $.ajax(
               {
                   "dataType":"json",
                   "method":"get",
                   "url":"<?php echo $configuracion->getSiteAddress()?>/extras/vimeo/get_info.php?url="+url,
                   "success":function (e) {

                       e = e[0];
                       console.log(e);
                       var vm={url:url,type:"vimeo",
                           size:e.thumbnailUrl,
                           name:e.name,
                           mime:e.author.url
                       };

                       scope.previews.push(vm);
                       setTimeout(function () {
                           scope.$apply();
                       })
                   },
                   "error":error
               }

           );
       }



   }

    $(document).on("change","#<?php echo $id?>",function (e) {

        var files =$(this)[0].files;
        var data = new FormData();

        $.each(files,function (k,v) {

            data.append(k,v);
        });

        scope.getMb=function (a,b) {

            if(0==a)return"0 Bytes";var c=1e3,d=b||2,e=["Bytes","KB","MB","GB","TB","PB","EB","ZB","YB"],f=Math.floor(Math.log(a)/Math.log(c));return parseFloat((a/Math.pow(c,f)).toFixed(d))+" "+e[f];

        }

        scope.uploading=true;
        scope.$apply();
        

        $.ajax({
            url: "<?php echo $configuracion->getSiteAddress() ?>/admin/archivos/data.php?act=upload",
            type: "post",
            dataType: "html",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;

                        <?php if($progressBar)
                        {
                            ?>
                        percentComplete=Math.floor(percentComplete*100);
                        console.log(percentComplete);
                        if(percentComplete>=98) {
                            $("<?php echo $progressBar?>").html("100");

                            $("<?php echo $progressBar?>").css("width","100%");

                            setTimeout(function () {
                                $("<?php echo $progressBar?>").fadeOut(300,function () {
                                    $("<?php echo $progressBar?>").css("width","0%");
                                });
                            },1000);
                        }
                         else
                        {

                            $("<?php echo $progressBar?>").fadeIn();
                            $("<?php echo $progressBar?>").html(Math.floor(percentComplete));
                            $("<?php echo $progressBar?>").css("width",percentComplete+"%");
                        }
                        <?php
                        }?>
                        
                    }
                }, false);
                xhr.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                   

                    }
                }, false);
                return xhr;
            },
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

            },
            complete:function () {
                scope.uploading=false;
                scope.$apply();
            }
        })




    })
    
</script>

<style>
    .file-upload {
        position: relative;
        display: inline-block;
    }

    .file-upload__label {
        display: block;
        padding: 1em 2em;
        color: #fff;
        background: #222;
        border-radius: .4em;
        transition: background .3s;
    }
    .file-upload__label:hover {
        cursor: pointer;
        background: #000;
    }

    .file-upload__input {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        font-size: 1;
        width: 0;
        height: 100%;
        opacity: 0;
    }

</style>

<div class="form-block">

<!--
    <input multiple   id="<?php echo $id;?>" type="file" accept="<?Php  echo implode(",",$formats)?>"  >
    -->
    <div class="file-upload">
        <label for="<?php echo $id;?>" class="file-upload__label">Subir archivos</label>
        <input multiple   id="<?php echo $id;?>" type="file" accept="<?Php  echo implode(",",$formats)?>"   class="file-upload__input">
    </div>


    <div class="fila">
        <input class="s12 m8 l10" id="<?php echo $id;?>sindicado" style="padding: 10px;" type="text" placeholder="Url de Youtube o Vimeo">
        <button type="button" onclick="loadSindicado()" class="s12 m4 l2" style="    height: 49px;">Cargar url</button>
    </div>


</div>


