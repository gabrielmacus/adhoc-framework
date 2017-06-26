
<script>
    angular.element(function () {

        scope.onLogin=function () {

            $.ajax(
                {
                    url:"<?php echo $configuracion->getSiteAddress()?>/admin/login.php",
                    method:"post",
                    dataType:"json",
                    success:function (e) {
                        console.log(e);
                    },
                    error:error
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
            
            <input id="nick" data-ng-model="usuario.user" type="text" >
            <label for="nick">
                Usuario o Email
            </label>
        </div>
        <div class="flex form-field">
          
            <input id="pass" data-ng-model="usuario.password" type="password" >
            <label for="pass" >
                Contraseña
            </label>
        </div>

        <div class="flex form-buttons center">
            <button title="Ingresar" type="submit">Ingresar</button>
            <button title="Ingresar con Facebook" class="facebook" ><i class="fa fa-facebook" aria-hidden="true"></i>
            </button>
            <button title="Ingresar con Google+" class="google" ><i class="fa fa-google-plus" aria-hidden="true"></i>
            </button>
        </div>

        <footer class="pie center">
            <a class="forgotten-password">¿Olvidaste la contraseña?</a>
        </footer>
        


    </form>
