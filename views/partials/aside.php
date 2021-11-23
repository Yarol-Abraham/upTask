<aside class="main__aside">
    <div class="main__aside__options">
        <h2>upTask</h2> 
        <button class="btn btn-transparent btn-active">
                <img src="/upTask/src/images/menu.svg" alt="menu">
        </button>
    </div>
    <nav class="main__aside__nav main__aside__nav--hidden">   
        <a class="<?php echo $name == "Inicio" ? "main__aside__nav--active" : "" ?>" href="/upTask/dashboard/index">&rarr;proyectos</a>
        <a class="<?php echo $name == "Crear" ? "main__aside__nav--active" : "" ?>" href="/upTask/dashboard/create">&rarr;crear proyecto</a>
        <a class="<?php echo $name == "Cuenta" ? "main__aside__nav--active" : "" ?>" href="/upTask/dashboard/account">&rarr;Mi cuenta</a>
        <a href="/upTask/auth/logout">&rarr;Cerrar sesión</a>
    </nav>
</aside><!----- Aside ----->