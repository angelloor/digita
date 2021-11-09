var url = "../controller/usuario.controller.php";

$(document).ready(() => {
    BloquearBotones(true);
    Consultar();
})

borrarUsuarios = () => {
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
            }).done((response) => {
                if (response == "OK") {
                    MostrarAlerta("Éxito!", "Usuarios Eliminados", "success");
                    Consultar();
                } else {
                    MostrarAlerta("Error!", response, "error");
                }
            }).fail((err) => {
                console.log(err);
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire('', 'Operación Cancelada', 'info')
        }
    })
}

Consultar = () => {
    $.ajax({
        data: { "accion": "CONSULTAR" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        var html = "";
        $.each(response, (index, data) => {
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
    }).fail((err) => {
        console.log(err);
    });
}

EscucharConsulta = (value) => {
    $.ajax({
        data: { "accion": "CONSULTAR_ID_ROW", "ValorBuscar": value },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        var html = "";
        $.each(response, (index, data) => {
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
    }).fail((err) => {
        console.log(err);
    });
}

retornarDatosConsulta = (accion) => {
    return {
        "accion": accion,
        "idUsuario": document.getElementById('idUsuario').value
    }
}

ConsultarPorId = (idUsuario) => {
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
            }).done((response) => {
                document.getElementById('NombrePersona').value = response.NOMBRE_PERSONA;
                document.getElementById('nombreUsuario').value = response.NOMBRE_USUARIO;
                document.getElementById('clave').value = response.CLAVE;
                document.getElementById('rolUsuario').value = response.ROL_USUARIO;
                document.getElementById('idUsuario').value = response.ID_USUARIO;
                if (response.ROL_USUARIO == "ADMINISTRADOR") {
                    document.getElementById('rolUsuario').disabled = true;
                }
                BloquearBotones(false);
            }).fail((err) => {
                console.log(err);
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire('', 'Operación Cancelada', 'info')
        }
    })
    document.getElementById('rolUsuario').disabled = false;
}

Guardar = () => {
    $.ajax({
        url: url,
        data: retornarDatos("GUARDAR"),
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos guardados con éxito", "success");
            Limpiar();
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Consultar();
    }).fail((err) => {
        console.log(err);
    });
}

Modificar = () => {
    $.ajax({
        url: url,
        data: retornarDatos("MODIFICAR"),
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos actualizados con éxito", "success");
            Limpiar();
        } else {
            MostrarAlerta("Error!", response, "error");
        }
        Consultar();
    }).fail((err) => {
        console.log(err);
    });
    document.getElementById('rolUsuario').disabled = false;
}

Eliminar = (idUsuario) => {
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
            }).done((response) => {
                if (response == "OK") {
                    swalWithBootstrapButtons.fire('', 'Registro eliminado', 'success')
                } else {
                    swalWithBootstrapButtons.fire('', response, 'error')
                }
                Consultar();
            }).fail((err) => {
                console.log(err);
            });
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire('', 'Operación Cancelada', 'info')
        }
    })
}

Validar = () => {
    NombrePersona = document.getElementById('NombrePersona').value;
    nombreUsuario = document.getElementById('nombreUsuario ').value;
    clave = document.getElementById('clave').value;
    rolUsuario = document.getElementById('rolUsuario').value;
    if (NombrePersona == "" || nombreUsuario == "" || clave == "" || rolUsuario == "") {
        return false;
    }
    return true;
}

retornarDatos = (accion) => {
    return {
        "NombrePersona": (document.getElementById('NombrePersona').value).toUpperCase(),
        "nombreUsuario": document.getElementById('nombreUsuario').value,
        "clave": document.getElementById('clave').value,
        "rolUsuario": document.getElementById('rolUsuario').value,
        "accion": accion,
        "idUsuario": document.getElementById("idUsuario").value
    };
}

Limpiar = () => {
    document.getElementById('NombrePersona').value = "";
    document.getElementById('nombreUsuario').value = "";
    document.getElementById('clave').value = "";
    document.getElementById('rolUsuario').value = "";
    BloquearBotones(true);
}

Cancelar = () => {
    BloquearBotones(false);
    Limpiar();
    document.getElementById('rolUsuario').disabled = false;
}

BloquearBotones = (guardar) => {
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

MostrarAlerta = (titulo, descripcion, tipoAlerta) => {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}

mostrarTodo = () => {
    document.getElementsByName('idUsuario')[0].value = '';
    Consultar();
}
