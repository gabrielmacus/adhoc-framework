<?php

include "../../includes/autoload.php";

include_once DIR_PATH."/extras/api/check-login.php";

$secciones=$GLOBALS["seccionDAO"]->selectSeccionesSubsecciones() ;

function showSections($secciones)
{

    ?>

    <ul class="secciones">
    <?php
    if(count($secciones)>0){
        foreach ($secciones as $s)
        {

            ?>
            <li data-nombre="<?php echo $s->getNombre()." #".$s->getId();?>" data-id="<?php echo $s->getId();?>">



                <a class="delete-seccion"><i class="fa fa-times " aria-hidden="true"></i></a>
                #<?Php echo $s->getId()?>
                <?php echo $s->getNombre();

                ?>

                <?php

                showSections($s->getSecciones())

                ?>



            </li>
            <?php

        }

    }

    ?></ul><?PHP

}

ob_start();

    showSections($secciones);
    ?>

    <?php if(count($secciones)==0)
    {

        ?>
        <h3>No hay secciones para mostrar</h3>
        <?php
    }

  
    $data=  ob_get_contents();
    ob_end_clean();

    echo $data;
    ?>



