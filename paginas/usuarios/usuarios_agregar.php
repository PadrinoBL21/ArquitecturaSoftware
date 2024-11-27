<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/tablas.css" />
    <link rel="icon" href="../../img/logologin.jpg">

</head>

<body>

    <div class="container">
        <h1>Agregar Usuario</h1>
        <form method="POST" action="usuarios_agregar_procesar.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="password2">Repetir Contraseña:</label>
                <input type="password" class="form-control" id="password2" name="password2">
            </div>
            
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select class="form-control" id="rol" name="rol">
                    <option value="Administrador">Administrador</option>
                    <option value="Mecanico">Mecanico</option>
                    <option value="Perforista">Perforista</option>
                    <option value="Perforista/Supervisor">Perforista/Supervisor</option>
                    <option value="Operador">Operador</option>
                    <option value="Hilero">Hilero</option>
                    <option value="Hilero 2">Hilero 2</option>
                    <option value="Hilero 3">Hilero 3</option>
                    <option value="Hilero 4">Hilero 4</option>
                    <option value="Director">Director</option>
                    <option value="Supervisor de mantenimiento">Supervisor de mantenimiento</option>
                    <option value="Mantenimiento">Mantenimiento</option>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-actualizar">Agregar Usuario</button>
            <a href="usuarios_principal.php" class="btn btn-actualizar">Cancelar</a>
        </form>
    </div>

</body>

</html>
    