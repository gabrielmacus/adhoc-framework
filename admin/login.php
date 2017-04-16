<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:22 PM
 */


include_once "../includes/autoload.php";

try
{
    $user=(array)\Firebase\JWT\JWT::decode($_COOKIE["usrtk"],$configuracion->getTokenSecret(),array('HS512'));
    header('Location: '.$configuracion->getSiteAddress()."/admin/");
}
catch (Exception $e)
{

}



if($_GET["login"])
{

    $token=$GLOBALS["userDAO"]->selectToken($_POST["user"],$_POST["password"]);

    if($token)
    {
        setcookie("usrtk",$token);
        header('Location: '.$configuracion->getSiteAddress()."/admin/");

    }
}

$htmlTitle=$configuracion->getSiteName();
$htmlKeywords="keyword";
$htmlDescription="Descriptiom";
$htmlLocality="Paraná,Entre Rios";

try{

    ?>
    <form action="<?php echo $configuracion->getSiteAddress()?>/admin/login.php?login=true" method="post" enctype="application/x-www-form-urlencoded">
        <div>
            <label>Usuario o Email</label>
            <input name="user">
        </div>
        <div>
            <label>Contraseña</label>
            <input name="password">
        </div>
        <button type="submit">Ingresar</button>

    </form>
    <?php
}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

