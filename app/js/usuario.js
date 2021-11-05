var url = "../controller/usuario.controller.php";

$(document).ready(function () {
    BloquearBotones(true);
    Consultar();
})

function borrarUsuarios() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn btn-primary mr-2 ml-2',
            confirmButton: 'btn btn-success mr-2 ml-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        text: '¿Estas seguro de elimnar todos los usuarios?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                data: { "accion": "BORRARUSUARIOS" },
                type: 'POST',
                dataType: 'json'
            }).done(function (response) {
                if (response == "OK") {
                    MostrarAlerta("Éxito!", "Usuarios Eliminados", "success");
                    Consultar();
                } else {
                    MostrarAlerta("Error!", response, "error");
                }
            }).fail(function (response) {
                console.log(response);
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire('', 'Operación Cancelada', 'info')
        }
    })
}

function Consultar() {
    $.ajax({
        data: { "accion": "CONSULTAR" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        var html = "";
        $.each(response, function (index, data) {
            html += "<tr>";
            html += "<td>" + data.ID_USUARIO + "</td>";
            html += "<td>" + data.NOMBRE_PERSONA + "</td>";
            html += "<td>" + data.NOMBRE_USUARIO + "</td>";
            html += "<td style='-webkit-text-security: disc;'>" + data.CLAVE + "</td>";
            html += "<td>" + data.ROL_USUARIO + "</td>";
            html += "<td style='text-align: right;'>";
            html += "<button class='btn btn-success mr-1' onclick='ConsultarPorId(" + data.ID_USUARIO + ");'><span class='fa fa-edit'></span></button>"
            html += "<button class='btn btn-danger ml-1' onclick='Eliminar(" + data.ID_USUARIO + ");'><span class='fa fa-trash'></span></button>"
            html += "</td>";
            html += "</tr>";
        });
        document.getElementById("datos").innerHTML = html;
    }).fail(function (response) {
        console.log(response);
    });
}

function EscucharConsulta(value) {
    $.ajax({
        data: { "accion": "CONSULTAR_ID_ROW", "ValorBuscar": value },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        var html = "";
        $.each(response, function (index, data) {
            html += "<tr>";
            html += "<td>" + data.ID_USUARIO + "</td>";
            html += "<td>" + data.NOMBRE_PERSONA + "</td>";
            html += "<td>" + data.NOMBRE_USUARIO + "</td>";
            html += "<td style='-webkit-text-security: disc;'>" + data.CLAVE + "</td>";
            html += "<td>" + data.ROL_USUARIO + "</td>";
            html += "<td style='text-align: right;'>";
            html += "<button class='btn btn-success mr-1' onclick='ConsultarPorId(" + data.ID_USUARIO + ");'><span class='fa fa-edit'></span></button>"
            html += "<button class='btn btn-danger ml-1' onclick='Eliminar(" + data.ID_USUARIO + ");'><span class='fa fa-trash'></span></button>"
            html += "</td>";
            html += "</tr>";
        });
        document.getElementById("datos").innerHTML = html;
    }).fail(function (response) {
        console.log(response);
    });
}

function retornarDatosConsulta(accion) {
    return {
        "accion": accion,
        "idUsuario": document.getElementById('idUsuario').value
    }
}

function ConsultarPorId(idUsuario) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn btn-primary mr-2 ml-2',
            confirmButton: 'btn btn-success mr-2 ml-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        text: '¿Estas seguro de modificar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                data: { "idUsuario": idUsuario, "accion": "CONSULTAR_ID" },
                type: 'POST',
                dataType: 'json'
            }).done(function (response) {
                document.getElementById('NombrePersona').value = response.NOMBRE_PERSONA;
                document.getElementById('nombreUsuario').value = response.NOMBRE_USUARIO;
                document.getElementById('clave').value = response.CLAVE;
                document.getElementById('rolUsuario').value = response.ROL_USUARIO;
                document.getElementById('idUsuario').value = response.ID_USUARIO;
                if (response.ROL_USUARIO == "ADMINISTRADOR") {
                    document.getElementById('rolUsuario').disabled = true;
                }
                BloquearBotones(false);
            }).fail(function (response) {
                console.log(response);
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire('', 'Operación Cancelada', 'info')
        }
    })
    document.getElementById('rolUsuario').disabled = false;
}

function Guardar() {
    $.ajax({
        url: url,
        data: retornarDatos("GUARDAR"),
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos guardados con éxito", "success");
            Limpiar();
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Consultar();
    }).fail(function (response) {
        console.log(response);
    });
}

function Modificar() {
    $.ajax({
        url: url,
        data: retornarDatos("MODIFICAR"),
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos actualizados con éxito", "success");
            Limpiar();
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Consultar();
    }).fail(function (response) {
        console.log(response);
    });
    document.getElementById('rolUsuario').disabled = false;
}

function Eliminar(idUsuario) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn btn-primary mr-2 ml-2',
            confirmButton: 'btn btn-success mr-2 ml-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        text: '¿Estas seguro de eliminar el usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                data: { "idUsuario": idUsuario, "accion": "ELIMINAR" },
                type: 'POST',
                dataType: 'json'
            }).done(function (response) {
                if (response == "OK") {
                    swalWithBootstrapButtons.fire('', 'Registro eliminado', 'success')
                } else {
                    swalWithBootstrapButtons.fire('', response, 'error')
                }
                Consultar();
            }).fail(function (response) {
                console.log(response);
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire('', 'Operación Cancelada', 'info')
        }
    })
}

function Validar() {
    NombrePersona = document.getElementById('NombrePersona').value;
    nombreUsuario = document.getElementById('nombreUsuario ').value;
    clave = document.getElementById('clave').value;
    rolUsuario = document.getElementById('rolUsuario').value;
    if (NombrePersona == "" || nombreUsuario == "" || clave == "" || rolUsuario == "") {
        return false;
    }
    return true;
}

function retornarDatos(accion) {
    return {
        "NombrePersona": (document.getElementById('NombrePersona').value).toUpperCase(),
        "nombreUsuario": document.getElementById('nombreUsuario').value,
        "clave": document.getElementById('clave').value,
        "rolUsuario": document.getElementById('rolUsuario').value,
        "accion": accion,
        "idUsuario": document.getElementById("idUsuario").value
    };
}

function Limpiar() {
    document.getElementById('NombrePersona').value = "";
    document.getElementById('nombreUsuario').value = "";
    document.getElementById('clave').value = "";
    document.getElementById('rolUsuario').value = "";
    BloquearBotones(true);
}

function Cancelar() {
    BloquearBotones(false);
    Limpiar();
    document.getElementById('rolUsuario').disabled = false;
}

function BloquearBotones(guardar) {
    if (guardar) {
        document.getElementById('guardar').disabled = false;
        document.getElementById('modificar').disabled = true;
        document.getElementById('cancelar').disabled = true;
    } else {
        document.getElementById('guardar').disabled = true;
        document.getElementById('modificar').disabled = false;
        document.getElementById('cancelar').disabled = false;
    }
}

function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}

function mostrarTodo() {
    document.getElementsByName('idUsuario')[0].value = '';
    Consultar();
}
