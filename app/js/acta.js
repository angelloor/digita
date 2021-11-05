var url = "../controller/acta.controller.php";

$(document).ready(function () {
    comprobacionGeneracion();
})

function comprobacionGeneracion() {
    $.ajax({
        url: url,
        data: { "accion": "COMPROBACION" },
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        if (response == "OK") {
            document.getElementById('generarActas').disabled = true;
        }
    }).fail(function (response) {
        console.log(response);
    });
}

function generarActas() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn btn-primary mr-2 ml-2',
            confirmButton: 'btn btn-success mr-2 ml-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        text: '¿Esta seguro de generar las actas? ',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                data: { "accion": "GENERARACTAS" },
                type: 'POST',
                dataType: 'json'
            }).done(function (response) {
                if (response == "OK") {
                    MostrarAlerta("Éxito!", "Actas Generas Correctamente", "success");
                    comprobacionGeneracion();
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

function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}

