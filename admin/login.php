<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 29/03/2017
 * Time: 12:22 PM
 */

$asyncLogin=isset($_GET["async"]) && $_GET["async"]=="true";
include_once "../includes/autoload.php";


try
{
    $user=(array)\Firebase\JWT\JWT::decode($_COOKIE["usrtk"],$configuracion->getTokenSecret(),array('HS512'));
    
    if($asyncLogin)
    {
        echo json_encode($user);
        exit();
    }
    else
    {
        header('Location: '.$configuracion->getSiteAddress()."/admin/");
    }
      
    
   
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

        if($asyncLogin)
        {

            include DIR_PATH."/extras/api/check-login.php";
            exit();

        }
     
        
        if($lastUrl=$_COOKIE["referer"])
        {
            header('Location: '.$lastUrl);
        }
        else
        {
            header('Location: '.$configuracion->getSiteAddress()."/admin/");
        }


    }
    else
    {
        if($asyncLogin)
        {
            echo "Login:1";
            exit();
        }
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
<style>
    html {
        height: 100%;
        box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    @media screen and  (min-width:769px)  {

form
{
    padding-left: 20%;
    padding-right: 20%;
    padding-top: 10%;
}

    }

    @media screen and (min-width:601px) and (max-width:768px) {
        form
        {
            padding-left: 10%;
            padding-right: 10%;
            padding-top: 10%;
        }

    }
    @media screen and (max-width:600px) {
        form
        {
            padding-left: 5%;
            padding-right: 5%;
            padding-top: 5%;
        }

    }

</style>

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

    <h1>Adhoc Panel <?php echo $configuracion->getVersion()?></h1>
    <div class="form-block">
        <label>Usuario o Email</label>
        <input name="user">
    </div>
    <div  class="form-block">
        <label>Contraseña</label>
        <input type="password" name="password">
    </div>
    <div class="form-block"><input type="submit" value="Ingresar"></div>


</form>
</body>
</html>
    <?php
}
catch (Exception $e)
{
    echo "Error: {$e->getMessage()}";

}

