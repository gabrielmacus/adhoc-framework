

<header class="top">

</header>


    <form class="body" data-ng-submit="onLogin()">
        <header class="top ">
            <h2>Ingresá a tu cuenta</h2>
        </header>
        <div class="flex form-field">

            <input id="nick" data-ng-model="post.titul" type="text" >
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
            <button title="Ingresar con Facebook" class="facebook" ><i class="fa fa-facebook" aria-hidden="true"></i>
        </div>

        <footer class="pie center">
            <a class="forgotten-password">¿Olvidaste la contraseña?</a>
        </footer>



    </form>
