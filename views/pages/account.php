<?php require __DIR__ . "/../partials/header.php"; ?>

    <div class="main__content ml-mb">
   
        <?php require __DIR__ . "/../alerts/alerts.php"; ?>
       
        <form method="POST" class="auth__form-create">
            
            <label for="nombre">Nombre</label>
            <input class="auth_input ms-pt" type="text" name="nombre" value="<?php echo sanitizar($user->nombre); ?>" />

            <label for="email">Email</label>
            <input class="auth_input ms-pt" type="email" name="email" value="<?php echo sanitizar($user->email); ?>" />
            
            <button class="btn-md-w btn btn-blue btn--animated ms-my" type="submit">Actualizar Cuenta</button>
            <a href="/upTask/user/update" class="text-center btn-md-w btn btn-green btn--animated ms-my">Cambiar Contraseña</a>
        
        </form><!-- form -->
       
    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
