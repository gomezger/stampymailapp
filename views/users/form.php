<div class="container">

    <div class="d-flex justify-content-between mt-3 mb-3">
        <h1 class="text-dark d-inline-block">Crear Usuario</h1>
        <a href="<?php echo constant('URL'); ?>users" class="btn btn-secondary d-flex align-items-center">Volver</a>
    </div>

    <div class="row">
        <form class="col-md-6" method="post" action="<?php echo constant('URL'); ?>users/create">
            <div class="form-group">
                <label for="usernameInput">Nombre de usuario</label>
                <input type="text" name="username" class="form-control" id="usernameInput" placeholder="Nombre de usuario">
            </div>
            <div class="form-group">
                <label for="inputName">Nombre</label>
                <input type="text" name="name" class="form-control" id="inputName" placeholder="Nombre del usuario">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>

            <?php foreach($this->d['errors'] as $error) { ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>

    </div>
</div>