<?php
// Incluir el archivo de conexión a la base de datos
include 'connect.php';

// Obtener el ID del formulario
$id = $_POST["id"];

// Consultar la base de datos para obtener los detalles de la tarea con el ID especificado
$sql = "SELECT * FROM tareas WHERE id = $id; ";
$consulta = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>

    <!-- Estilos CSS para la página -->
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
            min-height: 100vh;
        }

        /* Estilos para el mensaje de éxito o error */
        .message {
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            background-color: #3498db;
            color: #fff;
            margin-top: 20px;
            /* Añadido margen superior */
        }

        /* Estilos para los formularios */
        form {
            width: 80%;
            max-width: 600px;
            margin: 20px 0;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
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

        input[type="number"],
        input[type="text"],
        select,
        input[type="date"],
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #2980b9;
        }

        /* Estilos adicionales para el botón de regresar */
        input[type="button"][value="REGRESAR A LA PAGINA PRINCIPAL"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 10px 0;
            /* Añadido margen inferior */
        }

        input[type="button"][value="REGRESAR A LA PAGINA PRINCIPAL"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <header>
        <h1>EDITAR TAREA</h1>
    </header>
    <main>
        <!-- Formulario para buscar una tarea por ID -->
        <form action="editar.php" method="post">
            ID: <input type="number" name="id">
            <input type="submit" value="Buscar"><br>
        </form>

        <!-- Formulario para actualizar la tarea -->
        <form method="post" action="update.php">
            <?php
            // Verificar si hay resultados en la consulta
            if ($row = mysqli_fetch_array($consulta)) {
                ?>
                <!-- Campo oculto para el ID -->
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <table>
                    <tr>
                        <th> Titulo: </th>
                        <td> <input type="text" name="Titulo" value="<?php echo $row['Titulo']; ?>"> </td>
                    </tr>
                    <tr>
                        <th> Descripcion: </th>
                        <td> <input type="text" name="Descripcion" value="<?php echo $row['Descripcion']; ?>" id=""> </td>
                    </tr>
                    <tr>
                        <th> Completado: </th>
                        <td>
                            <!-- Menú desplegable para el estado "Completado" -->
                            <select name="Completado">
                                <option value="NO" <?php if ($row['Completado'] == "NO")
                                    echo "selected" ?>> NO </option>
                                    <option value="SI" <?php if ($row['Completado'] == "SI")
                                    echo "selected" ?>> SI </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th> Fecha de vencimiento: </th>
                            <td> <input type="date" name="Fecha_Vencimiento" value="<?php echo $row['Fecha_Vencimiento']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th><input type="submit" value="Guardar Cambios"></th>
                    </tr>
                </table>
                <?php
            }
            ?>
        </form>

        <!-- Formulario para eliminar la tarea -->
        <form method="post" action="delete.php">
            <?php
            // Reinicia el puntero del conjunto de resultados
            mysqli_data_seek($consulta, 0);

            // Verifica si hay alguna fila en el conjunto de resultados
            if ($row = mysqli_fetch_array($consulta)) {
                ?>
                <!-- Campo oculto para el ID -->
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="submit" value="ELIMINAR">
                <?php
            }
            ?>
        </form>
    </main>
    <a href="../index.html"> <input type="button" value="REGRESAR A LA PAGINA PRINCIPAL"> </a>
</body>

</html>