window.onload = function() {
    fetch('http://localhost/projects/PERSONAL_SoapService/InsertCategoria.php?action=obtenerUsuarios')
    .then(response => {
        if (!response.ok) {
            throw new Error('Respuesta del servidor no es OK');
        }
        return response.text();
    })
    .then(data => {
        try {
            const jsonData = JSON.parse(data);
            mostrarUsuarios(jsonData);
        } catch (e) {
            console.error('Error al analizar JSON:', e);
        }
    })
    .catch(error => console.error('Error:', error));

};

function mostrarUsuarios(usuarios) {
    const container = document.getElementById('usuarios');
    usuarios.forEach(usuario => {
        const div = document.createElement('div');
        div.innerHTML = `Nombre: ${usuario.usu_nom}, Apellido: ${usuario.usu_ape}, Correo: ${usuario.usu_correo}`;
        container.appendChild(div);
    });
}
