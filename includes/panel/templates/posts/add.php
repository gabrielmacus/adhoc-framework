
<style>
    .italic
    {

    }
</style>
<script>

    angular.element(function () {

     var surroundSelected = function(surround){
         var t = '';
         var range;
         if(window.getSelection){
             t = window.getSelection();
             range  =window.getSelection().getRangeAt(0);
         }else if(document.getSelection){
             t = document.getSelection();
             range  =document.getSelection().getRangeAt(0);
         }else if(document.selection){
             t = document.selection.createRange().text.get;
         }



         range.surroundContents(surround);

         return surround.innerHTML;
     }
        $(document).on("click",".web-html header button",function (e) {

            var i = document.createElement("i");
            var selection=surroundSelected(i);



        });

    });
</script>

<style>

    .web-html p
    {
        padding: 5px;
    }


</style>

<form class="post" data-ng-submit="submitNoticia()">
    <div>
        <label>Titulo</label>
        <input data-ng-model="post.titulo">
    </div>


        <label>Bajada</label>

        <div class="web-html">
             <header>
                 <button  type="button" data-class="italic" ><i class="fa fa-italic" aria-hidden="true"></i></button>
                 <button type="button" data-class="bold"><i class="fa fa-bold" aria-hidden="true"></i></button>
             </header>
            <p data-ng-model="post.bajada" >sdasdasdads
            </p>
        </div>


        <div>
            <label>Texto</label>

        </div>
    </div>

    <button type="submit">Guardar cambios</button>
</form>