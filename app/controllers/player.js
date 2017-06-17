    angularApp.controller('playerCtrl', function( $rootScope,$scope,$timeout) {     

            console.log($rootScope.song);

            if($rootScope.song)
            {

      youtubePlayer.loadVideoById($rootScope.song.href);
            }
        
    });
        
