    angularApp.controller('playerCtrl', function( $rootScope,$scope,$timeout) {     

            console.log($rootScope.song);

        $rootScope.youtubePlayerloadVideoById($rootScope.song.href);
        
    });
        
