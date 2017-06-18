<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 18/06/2017
 * Time: 13:52
 */

$filename = "http://mapucheonline.com/multimedia/2017/06/14/1497445017dcr1zf2170/1497445017_dcr1zf5241_original.jpg";

header("Content-Length: " . filesize($filename));
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=something.doc');

readfile($filename);