<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/tablas.css" />
    <link rel="icon" href="../../img/logologin.jpg">

</head>

<body>

    <div class="container">
        <h1>Editar Usuario</h1>
        <?php
        include '../../CONEXION.php';

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email'])) {
            $email = $_GET['email'];

            $query = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form method="POST" action="usuarios_editar_procesar.php">
                    <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <select class="form-control" id="rol" name="rol">
                            <option value="Administrador" <?php echo ($row['rol'] == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                            <option value="Mecanico" <?php echo ($row['rol'] == 'Mecanico') ? 'selected' : ''; ?>>Mecanico</option>
                            <option value="Perforista" <?php echo ($row['rol'] == 'Perforista') ? 'selected' : ''; ?>>Perforista</option>
                            <option value="Perforista/Supervisor" <?php echo ($row['rol'] == 'Perforista/Supervisor') ? 'selected' : ''; ?>>Perforista/Supervisor</option>
                            <option value="Operador" <?php echo ($row['rol'] == 'Operador') ? 'selected' : ''; ?>>Operador</option>
                            <option value="Hilero" <?php echo ($row['rol'] == 'Hilero') ? 'selected' : ''; ?>>Hilero</option>
                            <option value="Hilero 2" <?php echo ($row['rol'] == 'Hilero 2') ? 'selected' : ''; ?>>Hilero 2</option>
                            <option value="Hilero 3" <?php echo ($row['rol'] == 'Hilero 3') ? 'selected' : ''; ?>>Hilero 3</option>
                            <option value="Hilero 4" <?php echo ($row['rol'] == 'Hilero 4') ? 'selected' : ''; ?>>Hilero 4</option>
                            <option value="Director" <?php echo ($row['rol'] == 'Director') ? 'selected' : ''; ?>>Director</option>
                            <option value="Supervisor de mantenimiento" <?php echo ($row['rol'] == 'Supervisor de mantenimiento') ? 'selected' : ''; ?>>Supervisor de mantenimiento</option>
                            <option value="Mantenimiento" <?php echo ($row['rol'] == 'Mantenimiento') ? 'selected' : ''; ?>>Mantenimiento</option>

                        </select>
                    </div>
                    <br>
                   
                    <button type="submit" class="btn-actualizar">Guardar Cambios</button>
                    <a href="usuarios_principal.php" class="btn-actualizar">Cancelar</a>
                </form>
        <?php
            } else {
                echo "<p>No se encontró un usuario con el correo proporcionado.</p>";
            }
            $stmt->close();
            $conn->close();
        } else {
            echo "<p>No se proporcionó un correo válido para editar.</p>";
        }
        ?>
    </div>

</body>

</html>
