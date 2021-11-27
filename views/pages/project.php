<?php require __DIR__ . "/../partials/header.php"; ?>

    <div class="main__content ml-mb">
        <h2 class="text-center text-uppercase"><?php echo sanitizar($project->proyecto) ?></h2>
        <div class="project__main">
            <button class="btn--show btn btn-blue btn--animated" type="button" >&#43; Nueva Tarea </button>
            <div class="modal modal--hidden">
                <div class="modal__header">
                    <button class="btn--close btn--close-modal">&times;</button>
                </div>
                <div class="modal__body">
                    <!-- generate js -->
                </div>
            </div>
            <div class="overlay modal--hidden"></div>

            <div class="project__list">
                <!--<div class="project__list--item">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                    <div class="project__list--buttons">
                        <button type="button" class="btn btn-ms-w btn-yellow">Pendiente</button>
                        <button type="button" class="btn btn-ms-w btn-red">Eliminar</button>
                    </div>
                </div> -->
                
            </div>
        </div>
    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
