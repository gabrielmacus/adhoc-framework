<?php
if($_GET["modal"])
{
    ?>
    <script>
        var selectedPlayers =[];
        $(document).on("click",".player-card",function (e) {
            var id =$(this).data("id");
            var name =$(this).data("name");
            var surname =$(this).data("surname");
            var player={post_anexo_id:id,name:name,surname:surname};

            $(e.target).closest(".player-card").toggleClass("active");


           var idx= selectedPlayers.findIndex(
                function (element) {
                 return   element.id==id
                }
            );
            if(idx==-1)
            {
                selectedPlayers.push(player);
            }
            else
            {
                selectedPlayers.splice(idx,1);
            }

        });

        $(document).on("click",".select",function () {
            parent.postMessage(selectedPlayers,location.origin);
        });



    </script>
    <?php
}?>

<style>


    .player-card
    {    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 10px;
        background-color: white;
        height: 200px;
        position: relative;
        overflow: hidden;
    }
    .player-card .mask-2{

        -webkit-transition: all 300ms;
        -moz-transition: all 300ms;;
        -ms-transition: all 300ms;;
        -o-transition: all 300ms;;
        transition: all 300ms;;
        position: absolute;
        top: 0px;
        left: 0px;
        height: 100%;
        width: 60%;
        background-color: #2a2a2a;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .player-card:hover .mask-3
    {
        background-color: transparent;
    }
   
    .player-card .mask-3{

        -webkit-transition: all 300ms;
        -moz-transition: all 300ms;;
        -ms-transition: all 300ms;;
        -o-transition: all 300ms;;
        transition: all 300ms;;
        position: absolute;
        top: 0px;
        left: 0px;
        height: 100%;
        width: 70%;
        background-color:  rgba(8, 152, 53, 0.47);
        background-size: cover;
    }
    .player-card .mask{
        -webkit-transition: all 300ms;
        -moz-transition: all 300ms;;
        -ms-transition: all 300ms;;
        -o-transition: all 300ms;;
        transition: all 300ms;;
        -ms-transform: skewX(-20deg);
        -webkit-transform: skewX(-20deg);
        transform: skewX(-20deg);
        left: 50%;
        position: absolute;
        top: 0px;
        height: 100%;
        width: 70%;
        background-color: #2a2a2a;
    }
    .player-card .full-name
    {
        z-index: 10000;
        display: block;
        position: relative;
        color: white;
        font-size: 23px;
    }
    .player-card .select-mask
    {       -webkit-transition: all 300ms;
        -moz-transition: all 300ms;
        -ms-transition: all 300ms;
        -o-transition: all 300ms;
        transition: all 300ms;
        -webkit-transform: scale(0);
        -moz-transform: scale(0);
        -ms-transform: scale(0);
        -o-transform: scale(0);
        transform: scale(0);
        background-image: url("http://www.freeiconspng.com/uploads/accept-tick-icon-12.png");
        background-size: 50%;
        background-repeat: no-repeat;
        background-position: center;
    }
    .player-card.active .select-mask
    {
        z-index: 9999999;
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.61);
        top: 0px;
        left: 0px;
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -o-transform: scale(1);
        transform: scale(1);
    }
</style>

<div class="fila"  >

    <?php
    foreach ($posts as $post)
    {           $foto =array_values( array_values($post->getArchivos())[0])[0]["thumbnail"];
        ?>

        <div class="s12 m6 l6" style="padding: 10px">
            <div class="player-card" data-id="<?php echo $post->getId()?>" data-name="<?php echo $post->getTitulo()?>" data-surname="<?php echo  $post->getVolanta()?>">


                <span class="full-name"><strong class="name"><?php echo $post->getTitulo()?></strong>&nbsp;<span class="surname"><?php
                        echo  $post->getVolanta()?></span></span>

                <div class="mask-2" style="background-image: url('<?php echo $foto->getRealName()?>')">

                </div>
                <div class="mask-3"></div>
                <div class="mask">
                </div>
                <div class="select-mask"></div>

            </div>


        </div>

        <?php
    }?>
    <div style="padding: 10px">
        <button data-lity-clsoe class="select">Aceptar</button>
    </div>
</div>