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
                        <div class="img">
                            <span><?php echo $archivo->getCreation()?></span>
                            <input value="<?php echo $archivo->getName();?>">
                            <img src="<?php echo     $archivo->getPath()?>">
                        </div>
                        <?php
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