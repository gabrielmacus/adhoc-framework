
<div class="table-container">
    <table class="rwd-table">
        <tr>
            <th>Nombre completo</th>
            <th>Edad</th>
            <th>DNI</th>
            <th>Foto</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php
        foreach ($posts as $post)
        {
            $foto =array_values( array_values($post->getArchivos())[0])[0]["original"];
            ?>
            <tr>
                <td data-th="Nombre completo"><a ><?php  echo $post->getTitulo()." ".$post->getVolanta()?></a></td>
                <td data-th="Edad"><a ><?php  echo $post->getExtra1()?></a></td>
                <td data-th="DNI"><a ><?php  echo $post->getBajada()?></a></td>
                <td data-th="Foto"><a data-lity href="<?php echo $foto->getRealName()?>"><i class="fa fa-picture-o" aria-hidden="true"></i></a></td>
                <td data-th="Editar"><a href="<?php echo $configuracion->getSiteAddress()."/admin/jugadores/?act=add&id={$post->getId()}"?>"><i class="fa fa-pencil-square-o" arituhidden="true"></i></a></td>
                <td data-th="Eliminar"><a><i class="fa fa-times" aria-hidden="true"></i></a></td>
            </tr>
            <?php
        }
        ?>


    </table>
</div>


<style>

    .table-container
    {
        padding: 20px;
    }
    .rwd-table {
        margin: 1em 0;
        min-width: 300px;
    }
    .rwd-table tr {
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
    }
    .rwd-table th {
        display: none;
    }
    .rwd-table td {
        display: block;
    }
    .rwd-table td:first-child {
        padding-top: .5em;
    }
    .rwd-table td:last-child {
        padding-bottom: .5em;
    }
    .rwd-table td:before {
        content: attr(data-th) ": ";
        font-weight: bold;
        width: 6.5em;
        display: inline-block;
    }
    @media (min-width: 480px) {
        .rwd-table td:before {
            display: none;
        }
    }
    .rwd-table th, .rwd-table td {
        text-align: left;
    }
    @media (min-width: 480px) {
        .rwd-table th, .rwd-table td {
            display: table-cell;
            padding: .25em .5em;
        }
        .rwd-table th:first-child, .rwd-table td:first-child {
            padding-left: 0;
        }
        .rwd-table th:last-child, .rwd-table td:last-child {
            padding-right: 0;
        }
    }


    .rwd-table a
    {
        color: white;!important;
    }



    .rwd-table {
        float: left;width: 100%;
        background-color:#2a2a2a;
        color: #fff;
        border-radius: .4em;
        overflow: hidden;
    }
    .rwd-table tr {
        border-color: #4a4a4a;
    }
    .rwd-table th, .rwd-table td {
        margin: .5em 1em;
    }
    @media (min-width: 480px) {
        .rwd-table th, .rwd-table td {
            padding: 1em !important;
        }
    }

    .rwd-table th, .rwd-table td:before {
        color: #dd5!important;
    }
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

</style>

<div class="fila"  >

    <?php
    foreach ($posts as $post)
    {           $foto =array_values( array_values($post->getArchivos())[0])[0]["original"];
        ?>

        <div class="s12 m6 l6" style="padding: 10px">
            <div class="player-card">
                <h3 style="font-size: 35px"><?php echo $post->getTitulo()." ". $post->getVolanta()?></h3>

                <div class="mask-2" style="background-image: url('<?php echo $foto->getRealName()?>')">

                </div>
                <div class="mask-3"></div>
                <div class="mask">

                </div>

            </div>
        </div>

        <?php
    }?>

</div>