<?php require __DIR__ . "/../partials/header.php"; ?>

    <div class="main__content ml-mb">

        <div class="page__container"> 
            <?php require __DIR__ . "/../alerts/alerts.php"; ?>   
            <form method="POST" class="page__form">
                <fieldset class="page__form__fieldset">
                    <legend class="page__form__legend">Nombre del proyecto</legend>
                    <input class="page__form__input" type="text" placeholder="Escribir..." name="proyecto" value="<?php echo sanitizar($project->proyecto); ?>" />
                    <button class="btn-md-w btn btn-blue btn--animated ms-my" type="submit">Crear</button>
                </fieldset>
            </form>
        </div>

    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
