
<script>

    angular.element(function () {


    });
</script>

<style>

    .web-html p
    {
        padding: 5px;
    }


</style>

<input type="file" hidden id="loader">
<form class="post" data-ng-submit="submitNoticia()">
    <div>
        <label>Titulo</label>
        <input data-ng-model="post.titulo">
    </div>


        <div>
            <label>Texto</label>
            <!-- Create the editor container -->
            <div id="texto" class="editor">
             

            </div>


            <!-- Initialize Quill editor -->
            <script>

                var toolbarOptions = [
                    ['image']                                       // remove formatting button
                ];
                var quill = new Quill('#texto', {
                    theme: 'snow',
                    modules: {
                        toolbar:toolbarOptions
                    }
                });


                var toolbar = quill.getModule('toolbar');
                toolbar.addHandler('image', function () {
                    $("#loader").click();
                });
                
                $(document).on("change","#loader",function () {
                    var files=   $("#loader")[0].files;

                    var data = new FormData();
                    $.each(files, function(key, value)
                    {
                        data.append(key, value);
                    });



                    $.ajax({
                        url: "<?php echo $configuracion->getSiteAddress() ?>/admin/files/upload.php",
                        type: "post",
                        dataType: "html",
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success:function(res)
                        {

                            res = JSON.parse(res);

                            $.each(res,function (k,v) {
                                quill.insertEmbed(1, 'image', v);

                            });
                            console.log(quill.getContents());

                        }
                    })
                });



            </script>
        </div>
    </div>

    <button type="submit">Guardar cambios</button>
</form>