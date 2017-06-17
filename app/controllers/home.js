
var scope;

angularApp.controller('homeCtrl', function( $rootScope,$scope,$timeout,$location) {

    scope=$rootScope;
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

            console.log(e);
return false;
            $rootScope.song={url:e};
            $location.path('/player');
            
                        $rootScope.$apply();
        
        },
        "error":error   
       });
        }
        
    });
        
