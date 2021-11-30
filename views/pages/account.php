<?php require __DIR__ . "/../partials/header.php"; ?>

    <div class="main__content ml-mb">
   
        <?php require __DIR__ . "/../alerts/alerts.php"; ?>
       
                <form method="POST" class="auth__form-create">
                    <label for="nombre">Nombre</label>
                    <input class="auth_input ms-pt" type="text" name="nombre" />

                    <label for="email">Email</label>
                    <input class="auth_input ms-pt" type="email" name="email" />

                    <label for="password">Contraseña</label>
                    <input class="auth_input ms-pt" type="password" name="password" />

                    <label for="repeat password">Confirmar Contraseña</label>
                    <input class="auth_input ms-pt" type="password" name="confirmPassword" />

                    <button class="btn-md-w btn btn-blue btn--animated ms-my" type="submit">Actualizar Cuenta</button>
                
                </form><!-- form -->
       
    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
