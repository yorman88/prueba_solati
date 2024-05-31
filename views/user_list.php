<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Solati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container mt-5" id="userListContainer">
    <h1 class="text-center mb-4">Lista de Usuarios</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary" onclick="toggleForm()">Agregar Usuario</button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- Aquí se mostrarán los usuarios -->
        </tbody>
    </table>
</div>

<div class="container" id="userFormContainer">
    <h1 id="formTitle">Agregar Usuario</h1>
    <form id="userForm">
        <input type="hidden" id="userId" value="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" autocomplete="off" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" autocomplete="off" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" autocomplete="off" required><br>

        <input type="button" onclick="submitForm()" value="Guardar">
    </form>
</div>


<script>
        // Verificar si el usuario está autenticado
        if (!localStorage.getItem('logged_in')) {
            // Si no está autenticado, redirigir al formulario de inicio de sesión
            window.location.href = 'login.php';
        }
    </script>

<script type="text/javascript" src="js/user.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
