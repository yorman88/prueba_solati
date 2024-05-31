// Función para obtener y mostrar la lista de usuarios
function fetchAndDisplayUsers() {
    fetch('index.php?action=userList')
    .then(response => response.json())
    .then(response => {
        if (response.status === 'success') {
            const users = response.data;
            const userTableBody = document.getElementById('userTableBody');
            userTableBody.innerHTML = '';

            users.forEach(user => {
                const row = `
                    <tr>
                        <td>${user.nombre}</td>
                        <td>${user.apellido}</td>
                        <td>${user.email}</td>
                        <td>
                            <a href="#" class="link-button" onclick="editUser(${user.id})">Editar</a>
                            <a href="#" class="link-button" onclick="deleteUser(${user.id})">Eliminar</a>
                        </td>
                    </tr>
                `;
                userTableBody.innerHTML += row;
            });
        } else {
            console.error('Error:', response.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Función para eliminar un usuario
function deleteUser(id) {
    fetch('index.php?action=deleteUser&id=' + id, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        // Volver a cargar la lista de usuarios después de eliminar uno
        fetchAndDisplayUsers();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Variable para almacenar el estado del formulario
let isFormVisible = false;

// Función para mostrar u ocultar el formulario
function toggleForm() {
    const userListContainer = document.getElementById('userListContainer');
    const userFormContainer = document.getElementById('userFormContainer');

    if (!isFormVisible) {
        userListContainer.style.display = 'none';
        userFormContainer.style.display = 'block';
        isFormVisible = true;
    } else {
        userListContainer.style.display = 'block';
        userFormContainer.style.display = 'none';
        isFormVisible = false;
    }
}


function editUser(id) {
    // Hacer una solicitud AJAX para obtener los datos del usuario por su ID
    fetch('index.php?action=getUser&id=' + id)
    .then(response => response.json())
    .then(response => {
        if (response.status === 'success') {
            const user = response.data;
            // Llenar el formulario con los datos del usuario
            document.getElementById('userId').value = user.id;
            document.getElementById('nombre').value = user.nombre;
            document.getElementById('apellido').value = user.apellido;
            document.getElementById('email').value = user.email;
            // Mostrar el formulario de edición
            toggleForm();
        } else {
            console.error('Error:', response.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



// Función para enviar el formulario (agregar o editar usuario)
function submitForm() {
    const id = document.getElementById('userId').value; // Obtener el ID del usuario (si existe)
    const formData = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        email: document.getElementById('email').value,
        id: document.getElementById('userId').value
    };

    // Determinar si es una solicitud para agregar o editar usuario
    const url = id ? 'index.php?action=editUser&id=' + id : 'index.php?action=addUser';

    fetch(url, {
        method: id ? 'PUT' : 'POST', // Usar PUT para editar y POST para agregar
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        fetchAndDisplayUsers();
        toggleForm(); // Ocultar el formulario después de guardar o editar
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}



fetchAndDisplayUsers();


