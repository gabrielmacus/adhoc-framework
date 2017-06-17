    angularApp.controller('homeCtrl', function( $rootScope,$scope,$timeout,$location) {     
      
           $rootScope.playlist=[];
         $rootScope.search=function(){
            
                      $.ajax(
       {
        "method":"get",
        "url":"http://admin.mapucheonline.com/extras/youtube",
        "data":$scope.search,   
        "dataType":"json",
        "success":function(e){
        
            ///alert(JSON.stringify(e));
             $rootScope.playlist=e;
             $rootScope.$apply();
        
        },
        "error":error   
       });
        }
       
        
        
            $rootScope.playSong=function(song){
            
                      $.ajax(
       {
        "method":"get",
        "url":"http://admin.mapucheonline.com/extras/youtube/download/getdirectlink.php",
        "data":song,   
        "dataType":"json",
        "success":function(e){
        
            
            $rootScope.song={url:e};
            $location.path('/player');
            
                        $rootScope.$apply();
        
        },
        "error":error   
       });
        }
        
    });
        
