<?php
 include('functions.php');
$provinces = getProvinces();
require('inc/header.php');
?>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-4">Signup</h1>
            <p class="lead">This is the signup process</p>
            <hr class="my-4">
        </div>
        <form method="post" action="save.php">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input id="nombre" class="form-control" type="text" name="Nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input id="apellido" class="form-control" type="text" name="Apellido" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" class="form-control" type="email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="province">Provincia</label>
                <select id="province" class="form-control" name="ID_provincia" required>
                    <?php
                    foreach ($provinces as $id => $province) {
                        echo "<option value=\"$id\">$province</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input id="password" class="form-control" type="password" name="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </form>
    </div>
</body>
<?php require('inc/footer.php'); ?>
