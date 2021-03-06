
<script>
    angular.element(function () {
        scope.usuarioLogin={};
        scope.loginError=false;
        scope.$apply();
        console.log(scope);
        scope.onLogin=function () {


            $.ajax(
                {
                    url:"<?php echo $configuracion->getSiteAddress()?>/admin/login.php?login=true&async=true",
                    method:"post",
                    dataType:"json",
                    data:scope.usuarioLogin,
                    success:function (e) {
                        scope.user=e.data;
                        parent.postMessage("login","<?php echo $configuracion->getSiteAddress()?>");

                        parent.jQuery.fancybox.close()


                    },
                    error:function () {
                        scope.user={};
                        scope.loginError=true;
                        console.log("Login error");
                     setTimeout(function () {
                         scope.$apply();
                     });
                    }
                }
            );
        }

    });
</script>

    <form class="body" data-ng-submit="onLogin()">
        <header class="top ">
            <h2>Ingresá a tu cuenta</h2>
        </header>
        <div class="flex form-field">
            
            <input id="nick" data-ng-model="usuarioLogin.user" type="text" >
            <label for="nick">
                Usuario o Email
            </label>
        </div>
        <div class="flex form-field">
          
            <input id="pass" data-ng-model="usuarioLogin.password" type="password" >
            <label for="pass" >
                Contraseña
            </label>
        </div>

        <div class="flex form-buttons center">
            <button title="Ingresar" type="submit">Ingresar</button>
            <button type="button" data-ng-click="fbLogin()" title="Ingresar con Facebook" class="facebook" ><i class="fa fa-facebook" aria-hidden="true"></i>
            </button>
            <button type="button" title="Ingresar con Google+" class="google" ><i class="fa fa-google-plus" aria-hidden="true"></i>
            </button>
        </div>

        <p data-ng-if="loginError" class="error">Usuario o contraseña incorrectos</p>

        <footer class="pie center">
            <a class="forgotten-password">¿Olvidaste la contraseña?</a>
        </footer>
        


    </form>
