

    <header class="top ">
        <h2>Ingresá a tu cuenta</h2>
    </header>
    <form class="body" data-ng-submit="onLogin()">

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

        <div class="flex">
            <button type="submit">Ingresar</button>
        </div>

    </form>
