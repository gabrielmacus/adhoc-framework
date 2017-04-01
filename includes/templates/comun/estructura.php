
<!doctype html>
<html lang="<?php echo $configuracion->getLanguage()?>">
<head>
    <title><?php echo ($htmlTitle)?$htmlTitle:"Sin tituolo"; ?></title>
    
    <?php include "tags.php";?>
    
    <?php include "css.php";?>
    
    <?php include "js.php";?>

    
</head>
<body>

   <div id="body">

       <header>
          <?php include "navbar/navbar-1.php"?>

       </header>

       <section>

       </section>

       <aside>

       </aside>


       <footer>
           asdas
       </footer>

   </div>


       <?php include "sidenav/sidenav-1.php"?>



</body>
</html>
<?php

session_write_close();
?>