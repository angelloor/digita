var url = "../controller/reporte.controller.php";

$(document).ready(function () {
    // consultarTodo();
})

function consultarTodo() {
    $.ajax({
        url: url,
        data: { "accion": "CONSULTAR" },
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        var html = "";
        $.each(response, function (index, data) {
            html += "<tr>";
            html += "<td>" + data.id_sesion + "</td>";
            html += "<td>" + data.nombre_usuario + "</td>";
            html += "<td>" + data.hora_inicio + "</td>";
            html += "<td>" + data.hora_final + "</td>";
            html += "<td>" + data.tiempo_total + "</td>";
            html += "<td>" + data.fecha_sesion + "</td>";
            html += "</tr>";
        });
        document.getElementById("datos").innerHTML = html;
    }).fail(function (response) {
        console.log(response);
    });
}

function visualizar() {
    if (comprobarFechas() == 1) {
        MostrarAlerta("", "Ingrese el rango de las fechas", "info");
    } else {
        if (comprobarFechas() == 2) {
            MostrarAlerta("", "Ingrese la fecha inicial", "info");
        } else {
            if (comprobarFechas() == 3) {
                MostrarAlerta("", "Ingrese la fecha final", "info");
            } else {
                fechaInicio = document.getElementById('fechaInicio').value;
                fechaFinal = document.getElementById('fechaFinal').value;
                $.ajax({
                    url: url,
                    data: { "accion": "VISUALIZAR", "fechaInicio": fechaInicio, "fechaFinal": fechaFinal },
                    type: 'POST',
                    dataType: 'json'
                }).done(function (response) {
                    var html = "";
                    $.each(response, function (index, data) {
                        html += "<tr>";
                        html += "<td>" + data.id_sesion + "</td>";
                        html += "<td>" + data.nombre_usuario + "</td>";
                        html += "<td>" + data.hora_inicio + "</td>";
                        html += "<td>" + data.hora_final + "</td>";
                        html += "<td>" + data.tiempo_total + "</td>";
                        html += "<td>" + data.fecha_sesion + "</td>";
                        html += "</tr>";
                    });
                    document.getElementById("datos").innerHTML = html;
                }).fail(function (response) {
                    console.log(response);
                });
            }
        }
    }
}

function pdf() {
    if (comprobarFechas() == 1) {
        MostrarAlerta("", "Ingrese el rango de las fechas", "info");
    } else {
        if (comprobarFechas() == 2) {
            MostrarAlerta("", "Ingrese la fecha inicial", "info");
        } else {
            if (comprobarFechas() == 3) {
                MostrarAlerta("", "Ingrese la fecha final", "info");
            } else {
                fechaInicio = document.getElementById('fechaInicio').value;
                fechaFinal = document.getElementById('fechaFinal').value;
                window.open('../model/reporte.php?fechaInicio=' + fechaInicio + '&fechaFinal=' + fechaFinal + '&accion=pdf', '_blank');
            }
        }
    }
}

function excel() {
    if (comprobarFechas() == 1) {
        MostrarAlerta("", "Ingrese el rango de las fechas", "info");
    } else {
        if (comprobarFechas() == 2) {
            MostrarAlerta("", "Ingrese la fecha inicial", "info");
        } else {
            if (comprobarFechas() == 3) {
                MostrarAlerta("", "Ingrese la fecha final", "info");
            } else {
                fechaInicio = document.getElementById('fechaInicio').value;
                fechaFinal = document.getElementById('fechaFinal').value;
                window.open('../model/reporte.php?fechaInicio=' + fechaInicio + '&fechaFinal=' + fechaFinal + '&accion=excel', '_blank');
            }
        }
    }
}

function comprobarFechas() {
    fechaInicio = document.getElementById('fechaInicio').value;
    fechaFinal = document.getElementById('fechaFinal').value;
    if (fechaInicio == "" && fechaFinal == "") {
        return 1;
    } else {
        if (fechaInicio == "") {
            return 2;
        } else {
            if (fechaFinal == "") {
                return 3;
            }
        }
    }
    return 0;
}

function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}
