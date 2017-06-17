<?php
/**
 * Created by PhpStorm.
 * User: Puers
 * Date: 17/06/2017
 * Time: 16:44
 */
ob_start();
require_once 'errorhandler.php';
require 'class.YouTubeBean.php';
require 'class.YouTubeVideoDownloader.php';

$bean = new YouTubeBean();
$bean->setVideoId("xACG4MClvLo");
$bean->setVideoFormat("43");
$bean->setMethod("curl");
$bean->setDestination("./");


$downloader = new YouTubeVideoDownloader();
$downloader->startDownload($bean);