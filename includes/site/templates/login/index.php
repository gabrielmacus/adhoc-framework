


    <form class="body" data-ng-submit="onLogin()">
        <header class="top ">
            <h2>Ingresá a tu cuenta</h2>
        </header>
        <div class="flex form-field">
            
            <input id="nick" data-ng-model="usuario.nick" type="text" >
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
            <button type="submit">Ingresar</button>
            <button class="facebook" ><i class="fa fa-facebook" aria-hidden="true"></i>
            </button>
            <button class="google" ><i class="fa fa-google-plus" aria-hidden="true"></i>
            </button>
        </div>



    </form>
