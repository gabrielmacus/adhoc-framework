
<script>

    angular.element(function () {

        if(!scope.post)
        {
            scope.post={};
        }

        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        scope.removeAdjunto=function (a) {

            a.delete=true;

        }
        // Listen to message from child window
        eventer(messageEvent,function(e) {
            console.log(e);
            if(e.origin == "<?php echo $configuracion->getSiteAddress()?>")
            {
                if(v.embeed)
                {

                var HTML="";
                    $.each(e.data,function (k,v) {


                            switch (v.embeed)
                            {
                                case "image":
                                    if(e.data.length==1)
                                    {

                                        HTML+="<img  class='data' src='"+v.url+"'>";

                                    }


                                    break;
                            }

                        });

                    }

                console.log(HTML);
                <?php echo $id?>.clipboard.dangerouslyPasteHTML(<?php echo $id?>.getSelection().index, HTML);





            }
        },false);


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
        var <?php echo $id?> = new Quill("#<?php echo $id?>",options);

        <?php echo $id?>.on('text-change', function(delta, oldDelta, source) {


            scope.post.<?php echo $model?>= <?php echo $id ?>.root.innerHTML;

        });



// Handlers can also be added post initialization
        var toolbar<?php echo $id?> = <?php echo $id?>.getModule('toolbar');
        toolbar<?php echo $id?>.addHandler('image', function (e) {



            var lightbox = lity('<?php echo $configuracion->getSiteAddress()."/admin/repositorios?modal=true&embeed=image"?>');

       //     <?php echo $id?>.clipboard.dangerouslyPasteHTML(     <?php echo $id?>.getSelection().index, '&nbsp;<b>World</b>');
            // texto.insertEmbed(texto.getSelection().index, 'image', 'http://quilljs.com/images/cloud.png');
        });


        <?php if($post)
        {
        $p = json_decode(json_encode($post),true); //Convierto a array assoc

        ?>
        <?php echo $id?>.clipboard.dangerouslyPasteHTML(0, '<?php echo $p[$model];?>');
        <?php
        }?>

    });
</script>
<style>
    .#<?php echo $id?>
    {
        width: 100%;
        float: left;

    }
    .ql-container
    {
        height: 150px;
    }

</style>
<div class="fila form-block" >
    <label> <?Php echo $label?></label>
    <div class="text"  style="float: left;width:100%;" id="<?php echo $id?>" >

    </div>
</div>
