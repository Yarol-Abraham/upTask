<main class="main">

<?php require __DIR__ . "/aside.php"; ?>

    <section class="main__section">
        
        <header class="main__header ml-mb">
            <div class="main__header__content">
                <h3>Crea y Administra tus Proyectos</h3>
                <div class="main__header__img">
                    <img src="/upTask/src/images/dashboard/<?php echo $name ?? 'Inicio' ?>.png" alt="proyectos"/>
                </div>
            </div>
            <h4>Bienvenido, <?php echo $_SESSION["nombre"]; ?></h4>
        </header><!----- header ----->