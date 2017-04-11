<style>

    .file-container
    {
        padding: 10px;
    }
    .file
    {    position:relative;
        background: white;
        padding:20px;
        overflow: hidden!important;
        cursor: pointer;
    }
    .file .date
    {
        margin-bottom: 10px;
        float: left;
    }

    .file:hover:before
    {
        border-width:0  0px 0px 0;
    }

    .file:before {
        -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;

        content:"";
        position:absolute;
        top:0;
        right:0;
        border-width:0 27px 27px 0;
        border-style:solid;

        border-color:rgba(248, 248, 248, 1) #ededed;
        /* css3 extras */
        -webkit-box-shadow:0 1px 1px rgba(0,0,0,0.3),
        -1px 1px 1px rgba(0,0,0,0.2);
        -moz-box-shadow:0 1px 1px rgba(0,0,0,0.3),
        -1px 1px 1px rgba(0,0,0,0.2);
        box-shadow:0 1px 1px rgba(0,0,0,0.3),
        -1px 1px 1px rgba(0,0,0,0.2);
    }
    .file .name
    {
        margin-top: 5px;
        float: left;
        font-size: 18px;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    .file figure {

        overflow: hidden;
        float: left;
        width: 100%;
    position: relative;
    }
    .file figure .preview
    {
        -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;

        left: 0%;
        top:0px;
        width: 0%;
        background-color: rgba(0, 0, 0, 0.45);
        position: absolute;
        height: 100%;

    }
    .file figure  .preview a
    {  -webkit-transition: all 600ms;
        -moz-transition: all  600ms;
        -ms-transition: all  600ms;
        -o-transition: all 600ms;
        transition: all  600ms;
        opacity: 0;
        position: absolute;
        font-size: 36px;
        color: white;
        top: 35%;
        left: 35%;
    }

    .file figure  .download a
    {  -webkit-transition: all 600ms;
        -moz-transition: all  600ms;
        -ms-transition: all  600ms;
        -o-transition: all 600ms;
        transition: all  600ms;
        opacity: 0;
        position: absolute;
        font-size: 36px;
        color: white;
        top: 35%;
        right: 35%;
    }
    .file figure .download
    {        -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;

right: 0%;

        top:0px;
        width: 0%;
        background-color: rgba(0, 0, 0, 0.45);
        position: absolute;
        height: 100%;

    }
    .file figure a:hover
    {

        color: rgba(28, 150, 255, 1)

    }
    .file figure:hover a
    {
        opacity: 1;
    }
    .file figure:hover .preview
    {
        width: 50%;
        left: 0%;
    }
    .file figure:hover .download
    {  width: 50%;
       right: 0%;
    }
    .file figure:hover img
    {  -webkit-transition: all 400ms;
        -moz-transition: all  400ms;
        -ms-transition: all  400ms;
        -o-transition: all 400ms;
        transition: all  400ms;
        -ms-filter: blur(2px);
        filter: blur(2px);
    }


    .file img {
        width: 100%;
        object-fit: cover;

    }
    @media screen and  (min-width:1024px)  {


        .file-container
        {

            width: 15%;
            float: left;
        }

    }
    @media screen and (min-width: 769px) and  (max-width:1023px)  {

        .file-container
        {
            width: 20%;
            float: left;
        }

    }

    @media screen and (min-width:601px) and (max-width:768px) {
        .file-container
        {
            width: 25%;
            float: left;
        }

    }
    @media screen and (max-width:600px) {

        .file-container
        {
            width: 50%;
            float: left;
        }
    }

</style>
<?php



if($repositorio)
{
    foreach ($repositorio->getFiles() as $tipo=>$galeria)
    {


        switch ($tipo)
        {
            case 0:

                break;

            case 1 :

                foreach ($galeria as $originales)
                {

                    foreach ($originales as $original)
                    {
                        $archivo = $original["original"];
                        ?>
                        <div class="file-container">
                            <div class="file">
                                <time class="date"><?php echo date($lang["dateFormatFiles"],$archivo->getCreation()) ?></time>
                                <figure>
                                    <img   src="<?php echo     $archivo->getRealName()?>">
                                    <div class="preview">
                                        <a>
                                            <i class="fa fa-play-circle-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="download">
                                        <a>
                                            <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                        </a>


                                    </div>
                                </figure>

                                <span class="name"><?php echo $archivo->getName();?></span>

                            </div>
                        </div>
                        <?php
                        unset( $original["original"]);
                        foreach ($original as $archivo)
                        {


                        }
                    }


                }

                break;
        }

    }
}
if(!$repositorio || count($repositorio->getFiles())==0)
{
    ?>
    <h3>No hay archivos en el repositorio</h3>
    <?php
}

?>