<div class="container">

    <div class="d-flex justify-content-between mt-3 mb-3">
        <h1 class="text-dark d-inline-block">Editar Usuario '<?php echo $this->d['user']->getUsername(); ?>'</h1>
        <a href="<?php echo constant('URL'); ?>users" class="btn btn-secondary d-flex align-items-center">Volver</a>
    </div>

    <div class="row">
        <form class="col-md-6" method="post" action="<?php echo constant('URL'); ?>users/updatePassword/<?php echo Encryption::encrypt($this->d['user']->getID()); ?>">
            <div class="form-group">
                <label for="inputPassword">Password actual</label>
                <input type="password" name="password_actual" class="form-control" id="inputPassword" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password nueva</label>
                <input type="password" name="password_nueva" class="form-control" id="inputPassword" placeholder="Password">
            </div>

            <?php foreach($this->d['errors'] as $error) { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>

    </div>
</div>