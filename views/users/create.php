<main>
    <section class="auth">
        <?php require __DIR__ . "/../alerts/alerts.php"; ?>
        <div class="auth__container">
            <div class="auth__box auth__box--bg auth__box--imgCreate"></div><!-- auth__box -->
            <div class="auth__box auth__box--form">
                <form method="POST" class="auth__form-create">
                    <h1 class="auth__title">UpTask</h1>
                    <p class="ml-mb">Crea y Administra tus proyectos</p>

                    <label for="nombre">Nombre</label>
                    <input class="auth_input ms-pt" type="text" name="nombre" value="<?php echo sanitizar($user->nombre); ?>" />

                    <label for="email">Email</label>
                    <input class="auth_input ms-pt" type="email" name="email" value="<?php echo sanitizar($user->email); ?>" />

                    <label for="password">Contraseña</label>
                    <input class="auth_input ms-pt" type="password" name="password" />

                    <label for="repeat password">Confirmar Contraseña</label>
                    <input class="auth_input ms-pt" type="password" name="confirmPassword" />

                    <button class="btn-md-w btn btn-blue btn--animated ms-my" type="submit">Crear Cuenta</button>

                    <div class="auth__form-login__item">
                        <a class="auth__link" href="/upTask/auth/login">¿Tienes una cuenta?. Inicia Sesión</a>
                        <a class="auth__link" href="/upTask/auth/forgett">¿Olvidastes tu contraseña?</a>
                    </div>
                </form><!-- form -->
            </div><!-- auth__box -->
        </div><!-- auth__container -->
    </section><!-- auth -->
</main>