
<script>

    angular.element(function () {

        if(!scope.post)
        {
            scope.post={};
        }

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



            var lightbox = lity('<?php echo $configuracion->getSiteAddress()."/admin/repositorios?modal=true"?>');

            <?php echo $id?>.clipboard.dangerouslyPasteHTML(     <?php echo $id?>.getSelection().index, '&nbsp;<b>World</b>');
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
<div class="fila" >
   <?Php echo $label?>
    <div class="text" id="<?php echo $id?>" >

    </div>
</div>
