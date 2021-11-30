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
            <h3>Filtrar tareas</h3>
            <div class="project__filter">
                <div class="project__filter__item">
                    <label for="pendientes">Pendientes</label>
                    <input type="radio" name="filtro" id="pendientes" value="0" />
                </div>
                <div class="project__filter__item">
                    <label for="completadas">Completadas</label>
                    <input type="radio" name="filtro" id="completadas" value="1" />
                </div>
                <div class="project__filter__item">
                    <label for="todas">Todas</label>
                    <input type="radio" name="filtro" id="todas" value="2" checked />
                </div>
            </div>
            <div class="project__list">
                <!-- generate js -->
            </div>
        </div>
    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
