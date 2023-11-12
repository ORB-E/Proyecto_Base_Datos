<?php
    // Incluir el archivo de conexión a la base de datos
    include 'connect.php';

    // Verificar si la solicitud HTTP es de tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $Titulo = $_POST["Titulo"];
        $Descripcion = $_POST["Descripcion"];
        $Completado = "NO";
        $Fecha_Vencimiento = $_POST["Fecha_Vencimiento"];

        // Crear la consulta SQL para insertar una nueva tarea
        $sql = "INSERT INTO Tareas (Titulo, Descripcion, Completado, Fecha_Vencimiento)
        VALUES ('$Titulo', '$Descripcion', '$Completado', '$Fecha_Vencimiento')";

        // Ejecutar la consulta
        $consulta = mysqli_query($conn, $sql);

        // Verificar si la consulta fue exitosa
        if ($consulta) {
            echo "<br>";
            $mensaje = "REGISTRO INSERTADO CON ÉXITO";
        } else {
            $mensaje = "ERROR AL INSERTAR EL REGISTRO" . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            width: 80%;
            max-width: 600px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #d35400;
        }

        th {
            background-color: #d35400;
            color: #fff;
        }

        input[type="text"],
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
            background-color: #f39c12;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #d35400;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        footer {
            margin-top: 20px;
            text-align: center;
        }

        input[type="button"][value="REGRESAR A LA PAGINA PRINCIPAL"] {
            background-color: #f39c12;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        input[type="button"][value="REGRESAR A LA PAGINA PRINCIPAL"]:hover {
            background-color: #d35400;
        }
    </style>
</head>

<body>
    <header>
        <h1>
            INSERTAR MASCOTAS
        </h1>
    </header>
    <main align="center">
        <!-- Formulario para ingresar nuevos datos de tareas -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                <tr>
                    <th> Titulo: </th>
                    <td> <input type="text" name="Titulo"> </td>
                </tr>
                <tr>
                    <th> Descripcion: </th>
                    <td> <input type="text" name="Descripcion" id=""> </td>
                </tr>
                <tr>
                    <th> Fecha de vencimiento: </th>
                    <td> <input type="date" name="Fecha_Vencimiento"> </td>
                </tr>
                <tr>
                    <th> <input type="submit" value="Guardar"> </th>
                </tr>
            </table>
        </form>
        <!-- Mostrar mensaje de éxito o error después de la inserción -->
        <p> <?php echo $mensaje; ?> </p>

        <!-- Pie de página con un enlace para regresar a la página principal -->
        <footer>
            <a href="../index.html"> <input type="button" value="REGRESAR A LA PAGINA PRINCIPAL"> </a>
        </footer>
    </main>
</body>

</html>