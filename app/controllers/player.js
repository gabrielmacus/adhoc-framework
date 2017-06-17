

    angularApp.controller('playerCtrl', function( $rootScope,$scope,$timeout) {

        var youtubePlayer = new YT.Player('youtubePlayer', {

            height: '360',
            width: '640',
            videoId: $rootScope.song.href
        });

            console.log($rootScope.song);

            if($rootScope.song)
            {

            }
        
    });
        
