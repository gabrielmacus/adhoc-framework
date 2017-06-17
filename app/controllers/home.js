
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
                $rootScope.song=song;
                $location.path('/player');

                setTimeout(function () {
                    $rootScope.$apply();
                });

            }
        
    });
        
