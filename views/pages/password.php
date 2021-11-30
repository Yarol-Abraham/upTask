<?php require __DIR__ . "/../partials/header.php"; ?>

    <div class="main__content ml-mb">

        <form method="POST" class="auth__form-create">
        
            <?php require __DIR__ . "/../alerts/alerts.php"; ?>
    
            <label for="password">Contraseña Actual</label>
            <input class="auth_input ms-pt" type="password" name="passwordActual" placeholder="Escribi tu contraseña actual.." />

            <label for="password">Nueva Contraseña</label>
            <input class="auth_input ms-pt" type="password" name="passwordNueva" />

            <label for="repeat password">Confirmar Contraseña</label>
            <input class="auth_input ms-pt" type="password" name="confirmPassword" />

            <button class="btn-md-w btn btn-blue btn--animated ms-my" type="submit">Actualizar</button>
            <a href="/upTask/dashboard/account" class="text-center btn-md-w btn btn-red btn--animated ms-my">Regresar</a>
        
        </form><!-- form -->
       
    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
