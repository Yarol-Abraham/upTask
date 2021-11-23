<?php require __DIR__ . "/../partials/header.php"; ?>

    <div class="main__content ml-mb">
       
            <?php if(count($project) != 0): ?>
                <h2 class="text-center text-uppercase">Proyectos Creados</h2>
               <div class="projects__list">
                    <?php foreach($project as $key): ?>
                        <a class="projects__list__link" href="/upTask/dashboard/project?url=<?php echo sanitizar($key->url); ?>">
                            <?php echo sanitizar($key->proyecto); ?>
                        </a>
                    <?php endforeach; ?>
               </div>
            <?php else: ?>
                <div class="projects__message">
                    <p class="text-center text-uppercase md-mb">En este apartato apareceran tus proyecto creados! 😊✔</p>
                    <div class="projects__img">
                        <img src="/upTask/src/images/dashboard/lanzamiento.png" alt="lanzamiento">
                    </div>
                </div>    
            <?php endif; ?>
        
    </div><!----- content ----->

<?php require __DIR__ . "/../partials/footer.php"; ?>
