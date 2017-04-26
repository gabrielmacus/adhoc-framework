<div class="form-block">
    <div class="tags" id="<?php echo $id?>"></div>

    <script>
        $(document).ready(function () {

            new Taggle('<?php echo $id?>', {
                tags: ['Try', 'entering', 'one', 'of', 'these', 'tags'],
                duplicateTagClass: 'bounce'
            });
        });
    </script>
</div>