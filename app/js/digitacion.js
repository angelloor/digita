var url = "../controller/digitacion.controller.php";

var totalActas = 0;
var numeroCandidatos = 0;
var numeroActas = 0;
var idSesion = 0;
var numActa = 0;
var errores = 0;
var inputVacios = 0;
var estadoSesion = 0;
var estadoNuevaActa = 0;
var estadoFinalizar = 0;
var estadoActaGuardada = 0;

$(document).ready(function () {
    BloquearBotonesAll(true);
    obtenerParametros();
    verificarActas();
})

// Limitar el tamaño del numero ingresado y permitir solo numeros
function manejoInput(inputF, inputS) {
    $('input')
        .keypress(function (event) {
            if (event.which < 48 || event.which > 57 || this.value.length == 3 || event.which == 9) {
                return false;
            }
        });
    let input = document.getElementById("input" + inputF);
    input.addEventListener('keydown', (event) => {
        const keyName = event.key;
        if (keyName == "Enter") {
            if (inputS == parseInt(numeroCandidatos) + 2) {
                focusFinal();
            } else {
                if (input.value == "") {
                    return;
                } else {
                    document.getElementById("input" + inputF).disabled = true;
                    document.getElementById("input" + inputS).focus();
                }
            }
        } else {
            if (keyName == "Tab") {
                if (inputS == parseInt(numeroCandidatos) + 2) {
                } else {
                    if (input.value == "") {
                        return;
                    } else {
                        document.getElementById("input" + inputF).disabled = true;
                    }
                }
            }
        }
    });
}

function focusFinal() {
    window.location.href = "#buttonFinal";
}

function verificarActas() {
    $.ajax({
        url: url,
        data: { "accion": "VERIFICARACTAS" },
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        if (response.estado_generacion == 0) {
            document.getElementById('iniciar').disabled = true;
        }
    }).fail(function (response) {
        console.log(response);
    });
}

function finalizar() {
    $.ajax({
        url: url,
        data: { "accion": "FINALIZAR", "idSesion": idSesion },
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        if (response == "OK") {
            estadoFinalizar = 0;
            estadoSesion = 0;
            numeroActas = 0;
            BloquearBotonesAll(true);
            document.getElementById('iniciar').disabled = false;
            obtenerParametros();
            MostrarAlerta("", "Sesión finalizada", "info");
            limpiarTodosInput();
        } else {
            MostrarAlerta("Error!", response, "error");
        }
    }).fail(function (response) {
        console.log(response);
    });
}

function obtenerParametros() {
    $.ajax({
        url: url,
        data: { "accion": "PARAMETROS" },
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        totalActas = response.TOTAL_ACTAS;
        numeroCandidatos = (response.NUMERO_CANDIDATOS);
        document.getElementById('indicadorActa').innerText = "1" + " / " + totalActas;
    }).fail(function (response) {
        console.log(response);
    });

}

function Nuevo() {
    if (estadoSesion == 0) {
        MostrarAlerta("", "Primero tienes que iniciar sesión", "info");
        return;
    } else {
        if (numeroActas == totalActas) {
            if (comprobarInput() > 1) {
                MostrarAlerta("", "Ingrese todos los campos", "info");
                return;
            } else {
                MostrarAlerta("", "Finaliza la sesión", "info");
                return;
            }
        } else {
            if (estadoNuevaActa == 1) {
                MostrarAlerta("", "Primero tienes que terminar con el acta actual", "info");
                return;
            }
            if (numeroActas != totalActas) {
                numeroActas = numeroActas + 1;
                document.getElementById('indicadorActa').innerText = numeroActas + " / " + totalActas;
                $.ajax({
                    url: url,
                    data: { "accion": "NUEVO" },
                    type: 'POST',
                    dataType: 'json'
                }).done(function (response) {
                    inputVacios = 0;
                    errores = 0;
                    estadoNuevaActa = 1;
                    estadoActaGuardada = 0;
                    numActa = response[0].ACTA_ID;
                    BloquearBotones(false);
                    var html = "";
                    $.each(response, function (index, data) {
                        html += "<div class='element-acta'>";
                        html += "<div class='voto'>";
                        html += "<img src='../assets/cortes/" + data.IMG_VOTO_ID + ".jpg' alt='" + data.IMG_VOTO_ID + "' id='img" + index + "'>";
                        html += "</div>";
                        html += "<div class='valor'>";
                        html += "<input type='text' onkeypress='manejoInput(" + index + "," + (parseInt(index) + 1) + ")' id='input" + index + "'>";
                        html += "</div>  ";
                        html += "</div>";
                    });
                    document.getElementById("content-acta").innerHTML = html;
                    input0 = document.getElementById('input0');
                    input0.focus();
                }).fail(function (response) {
                    console.log(response);
                });
            }
        }
    }
}

function bloquearTodosInput() {
    for (let i = 0; i < parseInt(numeroCandidatos) + 2; i++) {
        var input = document.getElementById("input" + i);
        input.disabled = true;
    }
}

function limpiarTodosInput() {
    for (let i = 0; i < parseInt(numeroCandidatos) + 2; i++) {
        var input = document.getElementById("input" + i);
        input.value = "";
    }
}

function comprobarInput() {
    inputVacios = 0;
    for (let i = 0; i < parseInt(numeroCandidatos) + 2; i++) {
        var input = document.getElementById("input" + i);
        if (input.value == "") {
            inputVacios = inputVacios + 1;
        }
    }
    return inputVacios;
}

function Guardar() {
    if (estadoSesion == 0) {
        MostrarAlerta("", "Primero tienes que iniciar sesión", "info");
        return;
    } else {
        if (numeroActas == totalActas) {
            if (estadoFinalizar == 1) {
                MostrarAlerta("", "Finaliza la sesión", "info");
                return;
            } else {
                let inputsvacios = comprobarInput();
                if (inputsvacios >= 1) {
                    MostrarAlerta("", "Ingrese todos los campos", "info");
                    return;
                } else {
                    if (estadoActaGuardada == 1) {
                        MostrarAlerta("", "Ya se ha guardado la acta<br>Genere una nueva (alt + q)", "info");
                        return 0;
                    }
                    inputVacios = 0;
                    errores = 0;
                    for (let i = 0; i < parseInt(numeroCandidatos) + 2; i++) {
                        var img = document.getElementById("img" + i);
                        var input = document.getElementById("input" + i);
                        var alt = img.getAttribute("alt");
                        if (alt != input.value) {
                            errores = errores + 1;
                        }
                        if (input.value == "") {
                            inputVacios = inputVacios + 1;
                        }

                    }
                    if (inputVacios > 0) {
                        if (inputVacios > 1) {
                            MostrarAlerta("", "Hay " + inputVacios + " campos sin completar", "info");
                        } else {
                            MostrarAlerta("", "Hay " + inputVacios + " campo sin completar", "info");
                        }
                        return;
                    }
                    var novedad = document.getElementById('novedad');
                    stringNovedad = novedad.value;
                    if (errores >= 1) {
                        if (stringNovedad == "Acta valida") {
                            MostrarAlerta("", "Seleccione una novedad valida", "info");
                            bloquearTodosInput();
                            return;
                        }
                    }
                    BloquearBotones(true);
                    $.ajax({
                        url: url,
                        data: { "accion": "GUARDAR", "idUsuario": idUsuario, "idSesion": idSesion, "numActa": numActa, "errores": errores },
                        type: 'POST',
                        dataType: 'json'
                    }).done(function (response) {
                        if (response == "OK") {
                            MostrarAlerta("", "Acta Guardada", "info");
                            estadoActaGuardada = 1;
                            estadoNuevaActa = 0;
                        } else {
                            MostrarAlerta("Error!", response, "error");
                        }
                    }).fail(function (response) {
                        console.log(response);
                    });
                    if (numeroActas == totalActas) {
                        document.getElementById('Nuevo').disabled = true;
                        document.getElementById('Guardar').disabled = true;
                        document.getElementById('Liberar').disabled = true;
                        document.getElementById('indicadorActa').innerText = "Finalize la sesion";
                        document.getElementById('finalizar').disabled = false;
                    }
                    errores = 0;
                    novedad.value = "Acta valida";
                    MostrarAlerta("", "Acta Guardada", "info");
                    estadoFinalizar = 1;
                }
            }
        } else {
            if (estadoActaGuardada == 1) {
                MostrarAlerta("", "Ya se ha guardado la acta<br>Genere una nueva (alt + q)", "info");
                return 0;
            }
            inputVacios = 0;
            errores = 0;
            for (let i = 0; i < parseInt(numeroCandidatos) + 2; i++) {
                var img = document.getElementById("img" + i);
                var input = document.getElementById("input" + i);
                var alt = img.getAttribute("alt");
                if (alt != input.value) {
                    errores = errores + 1;
                }
                if (input.value == "") {
                    inputVacios = inputVacios + 1;
                }

            }
            if (inputVacios > 0) {
                if (inputVacios > 1) {
                    MostrarAlerta("", "Hay " + inputVacios + " campos sin completar", "info");
                } else {
                    MostrarAlerta("", "Hay " + inputVacios + " campo sin completar", "info");
                }
                return;
            }
            var novedad = document.getElementById('novedad');
            stringNovedad = novedad.value;
            if (errores >= 1) {
                if (stringNovedad == "Acta valida") {
                    MostrarAlerta("", "Seleccione una novedad valida", "info");
                    bloquearTodosInput();
                    return;
                }
            }
            BloquearBotones(true);
            $.ajax({
                url: url,
                data: { "accion": "GUARDAR", "idUsuario": idUsuario, "idSesion": idSesion, "numActa": numActa, "errores": errores },
                type: 'POST',
                dataType: 'json'
            }).done(function (response) {
                if (response == "OK") {
                    MostrarAlerta("", "Acta Guardada", "info");
                    estadoActaGuardada = 1;
                    estadoNuevaActa = 0;
                } else {
                    MostrarAlerta("Error!", response, "error");
                }
            }).fail(function (response) {
                console.log(response);
            });
            if (numeroActas == totalActas) {
                document.getElementById('Nuevo').disabled = true;
                document.getElementById('Guardar').disabled = true;
                document.getElementById('Liberar').disabled = true;
                document.getElementById('indicadorActa').innerText = "Finalize la sesion";
                document.getElementById('finalizar').disabled = false;
            }
            errores = 0;
            novedad.value = "Acta valida";
        }
    }
}

function Liberar() {
    if (estadoSesion == 0) {
        MostrarAlerta("", "Primero tienes que iniciar sesión", "info");
        return;
    } else {
        MostrarAlerta("", "Función no habilitada", "info");
    }
}

//combinacion de teclas
$(document).keydown(function (e) {
    e = e || event;
    if (e.altKey && String.fromCharCode(e.keyCode) == 'Q') {
        Nuevo();
    }
    if (e.altKey && String.fromCharCode(e.keyCode) == 'N') {
        Guardar();
    }
    if (e.altKey && String.fromCharCode(e.keyCode) == 'R') {
        Liberar();
    }
})

function iniciar() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn btn-primary mr-2 ml-2',
            confirmButton: 'btn btn-success mr-2 ml-2'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        text: '¿Estas seguro de Iniciar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            idUsuario = $("#idUsuario").text();
            $.ajax({
                url: url,
                data: { "accion": "INICIAR", "idUsuario": idUsuario, "totalActas": totalActas },
                type: 'POST',
                dataType: 'json'
            }).done(function (response) {
                if (response != "") {
                    idSesion = response;
                    estadoSesion = 1;
                    timeAlert();
                    document.getElementById('iniciar').disabled = true;
                    Nuevo();
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

function BloquearBotones(guardar) {
    if (guardar) {
        document.getElementById('Nuevo').disabled = false;
        document.getElementById('Guardar').disabled = true;
    } else {
        document.getElementById('Nuevo').disabled = true;
        document.getElementById('Guardar').disabled = false;
    }
}

function BloquearBotonesAll(guardar) {
    if (guardar) {
        document.getElementById('Nuevo').disabled = true;
        document.getElementById('Guardar').disabled = true;
        document.getElementById('Liberar').disabled = true;
        document.getElementById('finalizar').disabled = true;
    } else {
        document.getElementById('Nuevo').disabled = false;
        document.getElementById('Guardar').disabled = false;
        document.getElementById('Liberar').disabled = false;
    }
}

function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}

function timeAlert() {
    let timerInterval
    Swal.fire({
        title: 'Sesion Iniciada',
        html: 'La sesion inicia en <b></b> milliseconds.',
        timer: 1000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                    const b = content.querySelector('b')
                    if (b) {
                        b.textContent = Swal.getTimerLeft()
                    }
                }
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
        }
    })
}