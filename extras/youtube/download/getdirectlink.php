<?php
// YouTube Downloader PHP
// based on youtube-dl in Python http://rg3.github.com/youtube-dl/
// by Ricardo Garcia Gonzalez and others (details at url above)
//
// Takes a VideoID and outputs a list of formats in which the video can be
// downloaded
ob_start();

include_once('common.php');

function getVideoDirectLink($config,$my_id)
{

    if( \YoutubeDownloader\YoutubeDownloader::isMobileUrl($my_id) )
    {
        $my_id = \YoutubeDownloader\YoutubeDownloader::treatMobileUrl($my_id);
    }

    $my_id = \YoutubeDownloader\YoutubeDownloader::validateVideoId($my_id);


    if (isset($_GET['type']))
    {
        $my_type = $_GET['type'];
    }
    else
    {
        $my_type = 'redirect';
    }

    if ($my_type == 'Download')
    {


    } // end of if for type=Download

    /* First get the video info page for this video id */
// $my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id;
// thanks to amit kumar @ bloggertale.com for sharing the fix
    $video_info_url = 'http://www.youtube.com/get_video_info?&video_id=' . $my_id . '&asv=3&el=detailpage&hl=es_ES';
    $video_info_string = \YoutubeDownloader\YoutubeDownloader::curlGet($video_info_url, $config);

    /* TODO: Check return from curl for status code */
    $video_info = \YoutubeDownloader\VideoInfo::createFromString($video_info_string);



    $my_title = $video_info->getTitle();
    $cleanedtitle = $video_info->getCleanedTitle();


    $stream_map = \YoutubeDownloader\StreamMap::createFromVideoInfo($video_info);



    /* create an array of available download formats */
    $avail_formats = $stream_map->getStreams();


    $links=[];

    foreach ($avail_formats as $format)
    {
        if($directlink =$format["url"])
        {
            $links[]=$directlink;
        }
    }

    return $links;


}


$links= getVideoDirectLink($config,$_GET["href"]);

echo json_encode($links[0]);

$filename=$links[0];

echo "<br>DOWNLOAD HERE";
var_dump(file_put_contents("Tmpfile.webm", file_get_contents($filename)));