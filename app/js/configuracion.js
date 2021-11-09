
var url = "../controller/configuracion.controller.php";

$(document).ready(() => {
    listarConfiguracion();
    BloquearBotones(true);
})

Restablecer = () => {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn btn-primary mr-2 ml-2',
            confirmButton: 'btn btn-success mr-2 ml-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        text: '¿Estas seguro de restablecer el sistema?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                data: { "accion": "RESTABLECER" },
                url: url,
                type: 'POST',
                dataType: 'json'
            }).done((response) => {
                if (response == "OK") {
                    MostrarAlerta("Éxito!", "Sistema Restablecido", "success");
                    listarConfiguracion();
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

listarConfiguracion = () => {
    $.ajax({
        data: { "accion": "LISTARCONFIGURACION" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        document.getElementById('totalActas').value = response.TOTAL_ACTAS;
        document.getElementById('numeroCandidatos').value = response.NUMERO_CANDIDATOS;
        document.getElementById('totalPosiblesActas').value = response.TOTAL_POSIBLES_ACTAS;
        document.getElementById('estadoGeneracion').value = response.ESTADO_GENERACION;

    }).fail((err) => {
        console.log(err);
    });
}

Guardar = () => {
    BloquearBotones(true);
    totalActas = document.getElementById('totalActas').value;
    numeroCandidatos = document.getElementById('numeroCandidatos').value;
    totalPosiblesActas = document.getElementById('totalPosiblesActas').value;
    $.ajax({
        data: { "accion": "GUARDAR", "totalActas": totalActas, "numeroCandidatos": numeroCandidatos, "totalPosiblesActas": totalPosiblesActas },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        if (response == "OK") {
            MostrarAlerta("Éxito!", "Datos guardados con éxito", "success");
        } else {
            MostrarAlerta("Error!", response, "error");
        }
    }).fail((err) => {
        console.log(err);
    });
}

Modificar = () => {
    BloquearBotones(false);
    if (document.getElementById('estadoGeneracion').value == 1) {
        document.getElementById('numeroCandidatos').disabled = true;
        document.getElementById('totalPosiblesActas').disabled = true;
    }
}

Cancelar = () => {
    BloquearBotones(true);
}

BloquearBotones = (guardar) => {
    if (guardar) {
        document.getElementById('guardar').disabled = true;
        document.getElementById('modificar').disabled = false;
        document.getElementById('cancelar').disabled = true;
        document.getElementById('totalActas').disabled = true;
        document.getElementById('numeroCandidatos').disabled = true;
        document.getElementById('totalPosiblesActas').disabled = true;
        document.getElementById('estadoGeneracion').disabled = true;
    } else {
        document.getElementById('guardar').disabled = false;
        document.getElementById('modificar').disabled = true;
        document.getElementById('cancelar').disabled = false;
        document.getElementById('totalActas').disabled = false;
        document.getElementById('numeroCandidatos').disabled = false;
        document.getElementById('totalPosiblesActas').disabled = false;
        document.getElementById('estadoGeneracion').disabled = true;
    }
}


MostrarAlerta = (titulo, descripcion, tipoAlerta) => {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}
