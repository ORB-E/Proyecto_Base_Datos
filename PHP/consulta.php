<?php
// Incluir el archivo de conexión a la base de datos
include 'connect.php';

// Iniciar la sesión
session_start();

// Obtener el nombre de usuario del usuario autenticado
$usuario = $_SESSION['username'];

// Verificar si el usuario está autenticado
if ($_SESSION['logueado'] === false) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header("Location: index.php");
    exit();
}

// Consultar todas las tareas del usuario actual ordenadas por fecha de vencimiento
$sql = "SELECT * FROM Tareas WHERE Usuario_ID = (
    SELECT id FROM Usuarios WHERE Username = ?
) ORDER BY Completado ASC, Fecha_Vencimiento;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();

// Verificar si hubo un error en la consulta
if ($stmt === false) {
    $mensaje = "Error: " . $conn->error; // Usar $conn->error para obtener el mensaje de error
} else {
    $lista = $stmt->get_result();
    $mensaje = "Bienvenido";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE TAREAS</title>

    <!-- Estilos CSS para la tabla -->
    <style>
        /* Estilos generales */
        body {
            font-family: 'Comic Sans MS', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #ffecb3;
            color: #333;
        }

        header {
            background-color: #4caf50;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }

        /* Contenedor para la tabla */
        .table-container {
            margin-top: 20px;
        }

        /* Estilos para la tabla */
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #3498db;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .desc {
            width: 300px;
        }

        /* Estilo para filas completadas */
        table tr.completado {
            background-color: #2ecc71;
            color: #fff;
        }

        /* Alineación de filas completadas al final de la tabla */
        table tr.no-completado {
            background-color: #fff;
            color: #000;
        }

        /* Estilos para el pie de página */
        footer {
            margin-top: 20px;
            text-align: center;
        }

        .btn-footer {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .btn-footer:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <header>
        <h1>APP PARA LISTA DE TAREAS</h1>
    </header>
    <main>
        <!-- Contenedor para la tabla -->
        <div class="table-container">
            <!-- Tabla para mostrar la lista de tareas -->
            <table>
            <tr>
                <th> ID </th>
                <th> TITULO </th>
                <th class="desc"> DESCRIPCION </th>
                <th> COMPLETADO </th>
                <th> FECHA_VENCIMIENTO </th>
                <th>EDITAR</th>
            </tr>
            <!-- Iterar sobre cada tarea y mostrarla en una fila de la tabla -->
            <?php while ($row = mysqli_fetch_assoc($lista)) { ?>
                <tr class="<?php echo ($row['Completado'] === 'SI') ? 'completado' : 'no-completado'; ?>">
                    <td>
                        <?php echo $row['id']; ?>
                    </td>
                    <td>
                        <?php echo $row['Titulo']; ?>
                    </td>
                    <td class="desc">
                        <?php echo $row['Descripcion']; ?>
                    </td>
                    <td>
                        <?php echo $row['Completado']; ?>
                    </td>
                    <td>
                        <?php echo $row['Fecha_Vencimiento']; ?>
                    </td>
                    <td><a href="editar.php?id=<?php echo $row['id']; ?>" class="btn-footer">EDITAR TAREA</a></td>
                </tr>
            <?php } ?>
        </table>
        </div>
    </main>
    <!-- Pie de página con un enlace para regresar a la página principal -->
    <footer>
        <a href="../index.php" class="btn-footer">REGRESAR A LA PAGINA PRINCIPAL</a>
    </footer>
</body>

</html>