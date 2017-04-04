<style>
    .rich-text textarea
    {
        height: 300px;
        border: black 2px solid;
        width: 100%;
        padding: 0px;
    }
</style>
<input type="file" hidden id="imageLoader">
<input type="file" hidden id="videoLoader">

<script>

    $(document).on("change","#imageLoader",function () {
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

                    var tag="<img class='embeed' src='"+v+"'>";
                    $(".rich-text textarea").insertText(tag);

                });


            }
        })
    });

    $(document).on("click",".rich-text header span",function () {
      var act=  $(this).data("action");




        switch (act) {
            case "subtitulo":
                $(".rich-text textarea").surroundSelectedText("<h3>", "</h3>");


                break;
            case "italic":

                $(".rich-text textarea").surroundSelectedText("<i>", "</i>");
                break;
            case "bold":

                $(".rich-text textarea").surroundSelectedText("<b>", "</b>");
                break;
            case "image":
                $("#imageLoader").click();
                break;
            case "video":
                $("#videoLoader").click();
                break;
        }
    });
</script>

<div class="rich-text">
    <header>
       <span data-action="subtitulo">
          <i class="fa fa-header" aria-hidden="true"></i>
       </span>
        <span  data-action="italic">
            <i class="fa fa-italic" aria-hidden="true"></i>
        </span>
        <span  data-action="bold">
            <i class="fa fa-bold" aria-hidden="true"></i>
        </span>

        <span data-action="image">
            <i class="fa fa-picture-o" aria-hidden="true"></i>
        </span>
    </header>
    <textarea contenteditable>

    </textarea>

</div>