
<script>

    $(document).ready(function () {

        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
            ['image','video'],
            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['clean']                                         // remove formatting button
        ];

        var options = {

            modules: {
                toolbar:toolbarOptions
            },
            placeholder: 'Ingrese el texto...',
            theme: 'snow'
        };
        var texto = new Quill(".texto",options);



// Handlers can also be added post initialization
        var toolbar = texto.getModule('toolbar');
        toolbar.addHandler('image', function (e) {


            var lightbox = lity('<?php echo $configuracion->getSiteAddress()."/admin/repositorios?modal=rtue"?>');

           // texto.insertEmbed(texto.getSelection().index, 'image', 'http://quilljs.com/images/cloud.png');
        });

        window.addEventListener("message", function (e) {
            if(e.origin==location.origin)
            {

                console.log(e.data);
                if(!e.data.gal)
                { //Insert embeed
                    $.each(e.data.urls,function (k,v) {
                        switch (v.type)
                        {
                            case 1:
                                texto.insertEmbed(texto.getSelection().index, 'image', v.url);

                                break;
                        }
                    })

                }
                else
                {
                    //Insert to gallery


                    $.each(e.data.urls,function (k,v) {

                        appendToGallery(v.type,v.id,v.url,e.data.gal);

                    });
                }
            }
        }, false);


        $(document).on("submit","form",function () {

            var data= {};

            var serializedArray=$(this).serializeArray();

            $.each(serializedArray,function (k,v) {

                data[v.name] = v.value;
            });

            data.archivos=[];
            //galerias de adjuntos

            $(".file").each(function () {

                var file =$(this);

                data.archivos.push({archivo_grupo:file.data("gal"),archivo_id:file.data("file"),delete:file.data("delete"),archivo_objeto_id:file.data("id")});

            });

            //texto en html
            data.texto= texto.root.innerHTML;
            console.log(data);

            $.ajax(
                {
                    "method":"post",
                    "url":"<?Php echo $configuracion->getSiteAddress()?>/admin/posts/add.php?id=<?php echo $_GET["id"]?>",
                    "data":data,
                    "dataType":"json",
                    "success":function (e) {
                        console.log(e);
                        if(e)
                        {
                            //  parent.postMessage(e,location.origin);

                            //  location.reload();
                        }
                    }
                    ,"error":error
                }
            );

        });



        <?php if($post)
        {


            $archivos=$post->getArchivos();

            foreach ($archivos as $galerias)
            {

                foreach ($galerias as $archivos)
                {
                    $archivo = $archivos["original"];

                        ?>

        appendToGallery(<?php echo $archivo->getType();?>,<?php echo $archivo->getId(); ?>,"<?php echo $archivo->getRealName()?>",
            <?php echo  $archivo->getNexo()["archivo_grupo"]?>,<?php echo  $archivo->getNexo()["archivo_objeto_id"]?>);
        <?php


                }
            }
        ?>
        $("[name='titulo']").val("<?php echo $post->getTitulo()?>");
        texto.clipboard.dangerouslyPasteHTML(0, '<?php echo $post->getTexto()?>');
        <?php
        }?>


    });

    $(document).on("click",".file .remove",function (e) {

        $(e.target).closest(".file").attr("data-delete",true);
        $(e.target).closest(".file").fadeOut();

    });



    function appendToGallery(type,fileId,url,gal,id) {
        var HTML="";
      if(id)

      {     HTML+="<div  data-id='"+id+"' class='file s12 m6 l4' style='padding: 10px;position:relative;' data-gal='"+gal+"' data-file='"+fileId+"'>";

      }
      else

      {     HTML+="<div  class='file s12 m6 l4' style='padding: 10px;position:relative;' data-gal='"+gal+"' data-file='"+fileId+"'>";

      }

        switch (type)
        {
            case 1:


         
                HTML+="<figure>";
                HTML+="<img style='width: 100%' src='"+url+"'>";
                HTML+="</figure>";

                break;
        }
        HTML+="<span class='remove' style='position: absolute;top: 10px;right: 10px;'>X</span>";
        HTML+="</div>";
        $(".gallery."+type+"[data-id='"+gal+"']").append(HTML);

    }


    /*    $.ajax({
            url: ",
            type: "post",
            dataType: "html",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success:function(res)
            {

                res = JSON.parse(res);

                if(res)
                {
                    window.location="repositorios.php";
                }
            }
        });*/


</script>
<form>
    <?php
    if($post)
    {
        ?>   <input hidden name="id" value="<?php echo $post->getId()?>"><?php
    }?>

    <div>
        <label>Titulo</label>
        <input  type="text" name="titulo">
    </div>

    <?php
    $i=1;
    $types=[1]; //Tipos que acepta el pasador/galeria
    include "gallery.php";


    $i=2;
    $types=[1]; //Tipos que acepta el pasador/galeria
    include "gallery.php";
    ?>
    <div>

        <label>Texto</label>
        <div  class="texto editor">

        </div>
    </div>

<div>

    <button type="submit" >Guardar</button>
</div>
</form>