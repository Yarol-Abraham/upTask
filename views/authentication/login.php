<main>
    <section class="auth">
        <?php require __DIR__ . "/../alerts/alerts.php"; ?>
        <div class="auth__container">
            <div class="auth__box auth__box--bg auth__box--imgLogin"></div><!-- auth__box -->
            <div class="auth__box auth__box--form">
                <form method="POST" class="auth__form-login">
                    <h1 class="auth__title">UpTask</h1>
                    <p class="ml-mb">Crea y Administra tus proyectos</p>

                    <label class="ms-my" for="email">Email</label>
                    <input class="auth_input ms-pt" type="email" name="email" />

                    <label class="ms-my" for="password">Contraseña</label>
                    <input class="auth_input ms-pt" type="password" name="password" />

                    <button class="btn-md-w btn btn-blue btn--animated ms-my" type="submit">Iniciar Sesión</button>

                    <div class="auth__form-login__item">
                        <a data-cy="link_create_account" class="auth__link" href="/upTask/user/create">¿Aún no tienes una cuenta?. Crea una</a>
                        <a data-cy="link_forgett_pass" class="auth__link" href="/upTask/auth/forgett">¿Olvidastes tu contraseña?</a>
                    </div>
                </form><!-- form -->
            </div><!-- auth__box -->
        </div><!-- auth__container -->
    </section><!-- auth -->
</main>