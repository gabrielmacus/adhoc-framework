<?php
require_once 'PhpTube.php';
$tube = new PhpTube();
$videos = $tube->getDownloadLink('https://www.youtube.com/watch?v=uLIs0j2WnlM');

var_dump($videos);
?>
                   
