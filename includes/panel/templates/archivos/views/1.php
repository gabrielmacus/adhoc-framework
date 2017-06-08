
<?php



foreach ($archivos as $k=>$archivo)
{


    foreach ($archivo as $grupo)
    {


        foreach ($grupo as $versiones) {


            $version= reset($versiones);

            if(!$versiones[$versionPanel])//Si no encuentro la version de panel, cargo la original
            {
                $vp="original";
            }
            else
            {
                $vp=$versionPanel;
            }


            var_dump($vp);



        }
    }
}

if(count($archivos)==0)
{
    ?>
    <div class="fila center" style="font-size: 40px;font-weight: 300;margin-top: 30px">
        <h3>No hay archivos en el repositorio</h3>
    </div>

    <?Php
}
?>


