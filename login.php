<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h1 class="text-center mb-4">Iniciar Sesión</h1>
            <form id="loginForm" class="login-form">
                <label for="username">Usuario:</label>
                <input type="text" name="username" id="username" class="form-control" required><br>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required><br>
                <input type="submit" value="Iniciar Sesión" class="btn btn-primary">
            </form>
        </div>
    </div>

    <script>
    // JavaScript para manejar el envío del formulario mediante Fetch
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

        // Obtener los valores del formulario
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Crear un objeto JSON con los datos del formulario
        const formData = {
            username: username,
            password: password
        };

        // Realizar la solicitud Fetch al servidor
        fetch('index.php?action=login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
    .then(data => {
        // Manejar la respuesta del servidor
        console.log(data);
        if (data.status === 'success') {

            localStorage.setItem('logged_in', 'true');
            // Redirigir al usuario si el inicio de sesión fue exitoso
            window.location.href = 'index.php';
        } else {
            // Mostrar un mensaje de error al usuario
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Mostrar un mensaje de error al usuario
        alert('Error en la solicitud');
    });
});
</script>



</body>
</html>
