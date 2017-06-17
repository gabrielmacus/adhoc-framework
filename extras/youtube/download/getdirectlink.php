<?php
// YouTube Downloader PHP
// based on youtube-dl in Python http://rg3.github.com/youtube-dl/
// by Ricardo Garcia Gonzalez and others (details at url above)
//
// Takes a VideoID and outputs a list of formats in which the video can be
// downloaded

include_once('common.php');

function getVideoDirectLink($config,$my_id)
{


    if( \YoutubeDownloader\YoutubeDownloader::isMobileUrl($my_id) )
    {
        $my_id = \YoutubeDownloader\YoutubeDownloader::treatMobileUrl($my_id);
    }

    $my_id = \YoutubeDownloader\YoutubeDownloader::validateVideoId($my_id);

    if ( $my_id === null )
    {
        echo '<p>Invalid url</p>';
        exit;
    }

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
    $video_info_url = 'http://www.youtube.com/get_video_info?&video_id=' . $my_id . '&asv=3&el=detailpage&hl=en_US';
    $video_info_string = \YoutubeDownloader\YoutubeDownloader::curlGet($video_info_url, $config);

    /* TODO: Check return from curl for status code */
    $video_info = \YoutubeDownloader\VideoInfo::createFromString($video_info_string);



    $my_title = $video_info->getTitle();
    $cleanedtitle = $video_info->getCleanedTitle();



    $stream_map = \YoutubeDownloader\StreamMap::createFromVideoInfo($video_info);



    /* create an array of available download formats */
    $avail_formats = $stream_map->getStreams();



    foreach ($avail_formats as $format)
    {
        if($directlink =$format["url"])
        {
            break;
        }
    }

    return $directlink;


}


var_dump($videoId);
$directlink= getVideoDirectLink($config,$videoId);