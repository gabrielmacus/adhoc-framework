

var facebookPermissions=[ 'publish_actions','user_friends'];

window.fbAsyncInit = function() {
    FB.init({
        appId      : '1874200559512926',
        xfbml      : true,
        version    : 'v2.8'
    });
    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {


        if (response.status === 'connected') {

           solicitarPermisos();
        }
        else {
            FB.login(facebookReady, {scope:facebookPermissions});
        }
    });

};

function solicitarPermisos() {
    var permisosSolicitados=false;
    listarPermisos(function (data) {

        for(var i=0;i<facebookPermissions.length;i++)
        {
            var v= facebookPermissions[i];
            if(data.indexOf(v)==-1)
            {

                FB.login(facebookReady, {scope:facebookPermissions}); //Si solicito permisos nuevos, arrojo la ventana de login nuevamente

                i=facebookPermissions.length;
                permisosSolicitados=true;


            }
        }

        if(!permisosSolicitados) //Si no se solicitaron permisos,voy directo a la funcion
        {
            facebookReady();
        }


    })
}
function facebookReady(e) {

  /*  verAmigos(function (friends) {
        console.log(friends);
        var f=[];
        $.each(friends,function (k,v) {
     f.push(v.id);
        });

       f = f.toString();

        publicarEstado("Probando app",f);

    });*/

}
function listarPermisos(callback) {
    FB.api('/me/permissions', function(response) {
        var permissions = [];
        for (i = 0; i < response.data.length; i++) {

            if(response.data[i].status=='granted')
            {
                permissions.push(response.data[i].permission)
            }


        }
        if(callback)
        {
            callback(permissions) ;
        }
    });
}

function verAmigos(callback) {

    FB.api('/me/friends','get',{},function (e) {
        if(callback)
        {
            callback(e.data);
        }
    })
}
function publicarEstado(msg,etiquetados,callback) {
    if(!etiquetados)
    {
        etiquetados="";
    }
    if(!callback)
    {
        callback=function (e) {
            console.log(e);
        }
    }
    console.log(etiquetados);
    FB.api('/me/feed', 'post', {message:msg,tags:etiquetados},callback);

    /*
    * {

     name: 'Facebook Dialogs',
     link: 'https://developers.facebook.com/docs/reference/dialogs/',
     picture: 'http://fbrell.com/f8.jpg',
     caption: 'Reference Documentation',
     description: 'Dialogs provide a simple, consistent interface for applications to interface with users.',
     message: mensaje}*/

}

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));