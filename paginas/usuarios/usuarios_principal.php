<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/tablas.css" />
    <link rel="icon" href="../../img/logologin.jpg">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="container">
        <h1 class="my-4">Usuarios</h1>
        <form method="GET">
            <div class="form-group">
                <label for="busquedaNombre">Buscar por nombre:</label>
                <input type="text" class="form-control" id="busquedaNombre" name="busquedaNombre">
            </div>
            <button type="submit" class="btn btn-primary mb-4">Buscar</button>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../CONEXION.php';

                $busquedaNombre = isset($_GET['busquedaNombre']) ? $_GET['busquedaNombre'] : '';
                $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $registrosPorPagina = 10;
                $offset = ($paginaActual - 1) * $registrosPorPagina;

                $totalUsuariosQuery = "SELECT COUNT(*) as total FROM usuarios WHERE nombre LIKE '%$busquedaNombre%'";
                $totalUsuariosResult = $conn->query($totalUsuariosQuery);
                $totalUsuarios = $totalUsuariosResult->fetch_assoc()['total'];
                $totalPaginas = ceil($totalUsuarios / $registrosPorPagina);

                $usuariosQuery = "SELECT u.nombre, tu.tipoUsuario_nombre, u.email FROM usuarios u INNER JOIN tipousuarios tu ON u.rol=tu.id_tipoUsuario WHERE
                 u.nombre LIKE '%$busquedaNombre%' LIMIT $registrosPorPagina OFFSET $offset";
                $resultado = $conn->query($usuariosQuery);

                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["tipoUsuario_nombre"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>
                                <a href='usuarios_editar.php?email=" . $row["email"] . "' class='btn btn-warning btn-sm'>Editar</a> 
                                <button onclick='confirmarEliminacion(\"" . $row["email"] . "\")' class='btn btn-danger btn-sm'>Borrar</button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se encontraron usuarios.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <nav>
            <ul class="pagination">
                <?php
                if ($paginaActual > 1) {
                    echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaActual - 1) . "&busquedaNombre=$busquedaNombre'>Anterior</a></li>";
                }
                for ($i = 1; $i <= $totalPaginas; $i++) {
                    echo "<li class='page-item " . ($i == $paginaActual ? 'active' : '') . "'><a class='page-link' href='?pagina=$i&busquedaNombre=$busquedaNombre'>$i</a></li>";
                }
                if ($paginaActual < $totalPaginas) {
                    echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($paginaActual + 1) . "&busquedaNombre=$busquedaNombre'>Siguiente</a></li>";
                }
                ?>
            </ul>
        </nav>

        <div class="mt-4">
            <a href="../../principal.php" class="btn btn-secondary">Regresar</a>
            <a href="usuarios_agregar.php" class="btn btn-success">Agregar Usuario</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmarEliminacion(email) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'usuarios_eliminar.php?email=' + email;
                }
            })
        }
    </script>
</body>

</html>
