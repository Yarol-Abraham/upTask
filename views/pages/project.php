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
                    <!--
                        <form method="POST" class="page__form">
                        <fieldset class="page__form__fieldset">
                            <legend class="page__form__legend">Agregar una nueva tarea</legend>
                            <input class="page__form__input" type="text" placeholder="Escribir..." name="nombre" />
                            
                            <div class="page__form__box">
                                <button class="btn-md-w btn btn-blue btn--animated ms-m" type="submit">Agregar</button>
                                <button class="btn--close btn-md-w btn btn-red btn--animated ms-m" type="button">Cancelar</button>
                            </div>
                        </fieldset>
                    </form>
                    -->
                </div>
            </div>
            <div class="overlay modal--hidden"></div>

            <div class="project__main__list">
                <h2>listado de tareas</h2>
            </div>
        </div>
    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
