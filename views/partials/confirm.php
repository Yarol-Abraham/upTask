<div class="auth__container">
    <div class="auth__box auth__box--form flex-column">
        <div class="auth__box__mensaje">
            <h1 class="auth__title">UpTask</h1>
            <p class="ml-mb">Crea y Administra tus proyectos</p>
        </div>
        <div class="auth__box__imagen">
            <img src="/upTask/src/images/tarea-completada.png" alt="enviando">
        </div>
        <div class="auth__box__mensaje">
            <?php if(empty($errors)): ?>
                <a href="/upTask/auth/login" class="message-black ml-mb">Ya esta todo listo, presiona aquí para iniciar sesión 😀</a>
            <?php else: ?>
                <a href="/upTask/user/create" class="message-black ml-mb">Ha ocurrido un error con el servidor, por favor vuelce a intentarlo 😢</a>
            <?php endif; ?>    
        </div>
    </div><!-- auth__box -->
</div><!-- auth__container -->