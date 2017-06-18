<?php
// YouTube Downloader PHP
// based on youtube-dl in Python http://rg3.github.com/youtube-dl/
// by Ricardo Garcia Gonzalez and others (details at url above)
//
// Takes a VideoID and outputs a list of formats in which the video can be
// downloaded
function force_download($filename) {
    $filedata = @file_get_contents($filename);

    // SUCCESS
    if ($filedata)
    {
        // GET A NAME FOR THE FILE
        $basename = basename($filename);

        // THESE HEADERS ARE USED ON ALL BROWSERS
        header("Content-Type: application-x/force-download");
        header("Content-Disposition: attachment; filename=$basename");
        header("Content-length: " . (string)(strlen($filedata)));
        header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2, date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
        header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

        // THIS HEADER MUST BE OMITTED FOR IE 6+
        if (FALSE === strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE '))
        {
            header("Cache-Control: no-cache, must-revalidate");
        }

        // THIS IS THE LAST HEADER
        header("Pragma: no-cache");

        // FLUSH THE HEADERS TO THE BROWSER
        flush();

        // CAPTURE THE FILE IN THE OUTPUT BUFFERS - WILL BE FLUSHED AT SCRIPT END
        ob_start();
        echo $filedata;
    }

    // FAILURE
    else
    {
        die("ERROR: UNABLE TO OPEN $filename");
    }
}

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

force_download("https:\/\/r8---sn-uxaxjvh5gbxoupo5-gvnl.googlevideo.com\/videoplayback?pcm2cms=yes&source=youtube&ipbits=0&mime=video%2Fmp4&ip=200.58.110.70&expire=1497826027&itag=22&ei=i65GWfXQCsvmwQSyqpWIAg&id=o-AIXY0BabNHSwhehEHgd8tZH5ts00qytb7YAdSgEH-fYx&sparams=dur%2Cei%2Cid%2Cip%2Cipbits%2Citag%2Clmt%2Cmime%2Cmm%2Cmn%2Cms%2Cmv%2Cpcm2cms%2Cpl%2Cratebypass%2Crequiressl%2Csource%2Cexpire&dur=604.740&mm=31&mn=sn-uxaxjvh5gbxoupo5-gvnl&ratebypass=yes&requiressl=yes&signature=54B4CD7E76DF89C9B72C1C45DA09D71143937B14.8B0ADE9C465B8BE66A08010EE67B3703453B80FC&lmt=1497712959098202&ms=au&key=yt6&mt=1497804242&pl=24&mv=u");
