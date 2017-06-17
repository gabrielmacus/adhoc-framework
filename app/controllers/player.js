
function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}

    angularApp.controller('playerCtrl', function( $rootScope,$scope,$timeout) {
        var videoId=youtube_parser($rootScope.song.href);

        console.log(videoId);

        var youtubePlayer = new YT.Player('youtubePlayer', {

            videoId: videoId
        });

            console.log($rootScope.song);

            if($rootScope.song)
            {

            }
        
    });
        
