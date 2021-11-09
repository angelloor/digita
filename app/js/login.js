
var url = "app/controller/login.controller.php";

var estadoPopup = false;

$(document).ready(() => { })

enter = (valor) => {
    if (valor == 1) {
        input = document.getElementById("usuario");
        input.addEventListener('keypress', logKey);
    } else {
        input = document.getElementById("clave");
        input.addEventListener('keypress', logKey);
    }
    logKey = (e) => {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == 13) {
            iniciarSesion();
        }
    }
}

iniciarSesion = () => {
    let usuario, clave;
    usuario = document.getElementById("usuario").value;
    clave = document.getElementById("clave").value;

    if (usuario == "") {
        Swal.fire("", "Ingrese el usuario", "info");
        return;
    }
    if (clave == "") {
        Swal.fire("", "Ingrese la contraseña", "info");
        return;
    }

    $.ajax({
        data: { "accion": "LOGIN", "usuario": usuario, "clave": clave },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        if (typeof (response) == 'object') {
            window.location.href = "app/view/index.php";
            localStorage.setItem('nombre_persona', response.nombre_persona);
            localStorage.setItem('rol_usuario', response.rol_usuario);
            localStorage.setItem('id_usuario', response.id_usuario);
        } else {
            MostrarAlerta("", response, "error");
        }
    }).fail((err) => {
        console.log(err);
    });
}

MostrarAlerta = (titulo, descripcion, tipoAlerta) => {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}


