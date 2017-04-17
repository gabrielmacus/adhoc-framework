
<div class="table-container">
    <table class="rwd-table">
        <tr>
            <th>Titulo</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
        <?php

        foreach ($posts as $post)
        {
            ?>

            <tr>
                <td data-th="Titulo"><a ><?php  echo $post->getTitulo()?></a></td>
                <td data-th="Editar"><a href="<?php echo $configuracion->getSiteAddress()."/admin/posts/?act=add&id={$post->getId()}"?>"><i class="fa fa-pencil-square-o" arituhidden="true"></i></a></td>
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

</style>