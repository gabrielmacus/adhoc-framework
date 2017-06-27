
angular.element(function () {
    window.fbAsyncInit = function () {
        FB.init({
            appId: scope.facebookData.app_id,
            xfbml: true,
            version: scope.facebookData.default_graph_version
        });
        FB.AppEvents.logPageView();

        FB.getLoginStatus(function (response) {


            if (response.status === 'connected') {

                scope.solicitarPermisos();
            }
            else {
                FB.login(facebookReady, {scope: scope.facebookData.permissions, return_scopes: true});
            }
        });

    };

    scope.fbLogin=function () {

        FB.login(facebookReady, {scope: scope.facebookData.permissions.join(",")}); //Si solicito permisos nuevos, arrojo la ventana de login nuevamente

    }

     scope.solicitarPermisos=function() {
        var permisosSolicitados = false;


        listarPermisos(function (data) {


                for (var i = 0; i < scope.facebookData.length; i++) {
                    var v = scope.facebookData[i];
                    if (data.indexOf(v) == -1) {

                        FB.login(facebookReady, {scope: scope.facebookData}); //Si solicito permisos nuevos, arrojo la ventana de login nuevamente

                        i = scope.facebookData.length;
                        permisosSolicitados = true;


                    }
                }



            if (!permisosSolicitados) //Si no se solicitaron permisos,voy directo a la funcion
            {
                facebookReady();
            }


        });

    }


    function facebookReady(e) {

        console.log("DFATAA");
        console.log(e);
//    publicarEstado("Jugando al pes",[100001209271475]);

        //  publicarImagenEnGrupo("https://scontent-gru2-2.xx.fbcdn.net/v/t1.0-0/p180x540/17630114_1368806563173057_6365164914191947421_n.jpg?oh=2b2410f12f57012c520d8238b15be13d&oe=5953A000","Vendo secador, muy poco uso, excelente estado $500",189905047763101);

        /*
         setInterval(function () {

         publicarEnGrupo("Vendo secador, muy poco uso, excelente estado $500")

         },900000);
         */

        //publicarEstado("Mi estado <img src='http://qnimate.com/wp-content/uploads/2014/03/images2.jpg'>");

        /*

         verAmigos(function (friends) {
         console.log(friends);
         var f=[];
         $.each(friends,function (k,v) {
         f.push(v.id);
         });

         f = f.toString();

         publicarEstado("Probando app",f);

         });
         */


        /*
         FB.api(
         "/me/messages",
         "POST",
         {
         "recipient":{

         "id":1371269772926736
         },
         "message":{
         "text":"Holaa"
         }
         },
         function (response) {

         console.log(response);


         }
         );*/

        /*
         $.ajax(
         {
         url:"https://graph.facebook.com/v2.6/me/messages?access_token=EAAaok1KWbV4BAF3B7ZCAvjpgZCj718sWLQZAdmC5R5nfYZBRuFZAhwcTz0ZBZAQQwiFYll0hxobhhZCIqJcwkZBXw5MO9u1ra1snrjKj3PVaFTGiXjAVd11C1zI6vIjqujWRkOtavCHPkwSRYuOb9A7KSvOYBxGio4hbFkFOciNdZA5wZDZD",
         method: "POST",
         data: {
         "recipient":{

         "id":1371269772926736
         },
         "message":{
         "text":"Holaa"
         },
         success:function(e)
         {
         console.log(e);
         },
         error:function(e)
         {
         console.log(e);
         }
         }

         }
         );*/
    }


    function publicarImagenEnGrupo(img, msg, grupo, callback) {
        FB.api(
            "/" + grupo + "/photos",
            "POST",
            {
                "url": img,
                "message": msg
            },
            function (response) {

                console.log(response);
                if (callback) {
                    callback();

                }

            }
        );
    }

    function publicarEnGrupo(msg, link, grupo, callback) {
        FB.api(
            "/" + grupo + "/feed",
            "POST",
            {
                "message": msg,
                "link": link
            },
            function (response) {
                console.log(response);
                if (callback) {
                    callback();

                }
            }
        );
    }

    function verGrupos(callback, options) {

        if (!options) {
            options = {};
        }
        FB.api('/me/groups', 'get', options, function (e) {
            if (callback) {
                callback(e.data);
            }
        })
    }


    function listarPermisos(callback) {
        FB.api('/me/permissions', function (response) {

            console.log(response);

            var permissions = [];
            for (i = 0; i < response.data.length; i++) {

                if (response.data[i].status == 'granted') {
                    permissions.push(response.data[i].permission)
                }


            }
            if (callback) {
                callback(permissions);
            }
        });
    }

    function verAmigos(callback, options) {

        if (!options) {
            options = {};
        }
        FB.api('/me/friends', 'get', options, function (e) {
            if (callback) {
                callback(e.data);
            }
        })
    }

    function publicarEstado(msg, etiquetados, callback) {
        if (!etiquetados) {
            etiquetados = "";
        }
        if (!callback) {
            callback = function (e) {
                console.log(e);
            }
        }
        console.log(etiquetados);
        FB.api('/me/feed', 'post', {message: msg, tags: etiquetados}, callback);

        /*
         * {

         name: 'Facebook Dialogs',
         link: 'https://developers.facebook.com/docs/reference/dialogs/',
         picture: 'http://fbrell.com/f8.jpg',
         caption: 'Reference Documentation',
         description: 'Dialogs provide a simple, consistent interface for applications to interface with users.',
         message: mensaje}*/

    }

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
});