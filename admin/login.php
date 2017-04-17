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
<html>
<head>


    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilo.css">
    <style>
        html
        {
            font-family: 'Ubuntu', sans-serif;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1" />
</head>
<body>
<form action="<?php echo $configuracion->getSiteAddress()?>/admin/login.php?login=true" method="post" enctype="application/x-www-form-urlencoded">
    <div>
        <label>Usuario o Email</label>
        <input name="user">
    </div>
    <div>
        <label>Contraseña</label>
        <input type="password" name="password">
    </div>
    <div>    <button type="submit">Ingresar</button></div>


</form>
</body>
</html>
    <?php
}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

