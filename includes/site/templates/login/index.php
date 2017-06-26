

    <header class="top center">
        <h2>Ingresá a tu cuenta</h2>
    </header>
    <form class="body" data-ng-submit="onLogin()">

        <div class="flex form-field">
            <label>
                Usuario o Email
            </label>
            <input data-ng-model="usuario.nick" type="text" >
        </div>
        <div class="flex form-field">
            <label>
                Contraseña
            </label>
            <input data-ng-model="usuario.password" type="password" >
        </div>

        <div class="flex">
            <button type="submit">Ingresar</button>
        </div>

    </form>
