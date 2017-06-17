<?php
require('youtube-dl.class.php');
try {


    new yt_downloader("http://www.youtube.com/watch?v=bHGECrXM5_Q", TRUE, "audio");
}
catch (Exception $e) {
    die($e->getMessage());
}
