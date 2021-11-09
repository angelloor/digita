var url = "../controller/reporte.controller.php";

var totalSesiones
var datos
var datosFinal = []
var timeToLoading = 1000

$(document).ready(() => {
    // consultarTodo();
})

consultarTodo = () => {
    $.ajax({
        url: url,
        data: { "accion": "CONSULTAR" },
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        var html = "";
        $.each(response, (index, data) => {
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
    }).fail((err) => {
        console.log(err);
    });
}

visualizar = () => {
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
                }).done((response) => {
                    var html = "";
                    $.each(response, (index, data) => {
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
                }).fail((err) => {
                    console.log(err);
                });
            }
        }
    }
}

pdf = async () => {
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
                    data: { "accion": "CONSULTA_SESION", "fechaInicio": transformData(fechaInicio), "fechaFinal": transformData(fechaFinal) },
                    type: 'POST',
                    dataType: 'json'
                }).done((response) => {
                    if (response > 0) {
                        // Consultar los datos
                        $.ajax({
                            url: url,
                            data: { "accion": "CONSULTA_DATOS", "fechaInicio": transformData(fechaInicio), "fechaFinal": transformData(fechaFinal) },
                            type: 'POST',
                            dataType: 'json'
                        }).done(async (response) => {
                            datos = response
                            datos.map(async (item) => {
                                let idSesion = item.id_sesion
                                $.ajax({
                                    url: url,
                                    data: { "accion": "ERRORES", "idSesion": idSesion },
                                    type: 'POST',
                                    dataType: 'json'
                                }).done((response) => {
                                    let element = {
                                        ...item,
                                        errores: response
                                    }
                                    datosFinal = datosFinal.concat(element)
                                }).fail((err) => {
                                    reject(err)
                                });
                            })
                            timeAlert()
                            setTimeout(() => {
                                window.open('../model/reporte.php?fechaInicio=' + transformData(fechaInicio) + '&fechaFinal=' + transformData(fechaFinal) + '&data=' + JSON.stringify({ datosFinal }) + '&accion=pdf', '_blank');
                            }, timeToLoading)
                        }).fail((err) => {
                            reject(err)
                        });
                    } else {
                        MostrarAlerta("", "No se encontraron sesiones con las fechas seleccionadas", "info");
                    }
                }).fail((err) => {
                    reject(err)
                });
            }
        }
    }
    datosFinal = []
}

excel = () => {
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
                    data: { "accion": "CONSULTA_SESION", "fechaInicio": transformData(fechaInicio), "fechaFinal": transformData(fechaFinal) },
                    type: 'POST',
                    dataType: 'json'
                }).done((response) => {
                    if (response > 0) {
                        // Consultar los datos
                        $.ajax({
                            url: url,
                            data: { "accion": "CONSULTA_DATOS", "fechaInicio": transformData(fechaInicio), "fechaFinal": transformData(fechaFinal) },
                            type: 'POST',
                            dataType: 'json'
                        }).done((response) => {
                            datos = response
                            timeAlert()
                            setTimeout(() => {
                                window.open('../model/reporte.php?data=' + JSON.stringify(datos) + '&accion=excel', '_blank');
                            }, timeToLoading)
                        }).fail((err) => {
                            console.log(err);
                        });
                    } else {
                        MostrarAlerta("", "No se encontraron sesiones con las fechas seleccionadas", "info");
                    }
                }).fail((err) => {
                    console.log(err);
                });
            }
        }
    }
    datosFinal = []
}

comprobarFechas = () => {
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

MostrarAlerta = (titulo, descripcion, tipoAlerta) => {
    Swal.fire(
        titulo,
        descripcion,
        tipoAlerta
    );
}

transformData = (fecha) => {
    return `${fecha.substring(0, 4)}-${fecha.substring(5, 7)}-${fecha.substring(8, 10)} ${fecha.substring(11, 16)}`
}

timeAlert = () => {
    let timerInterval
    Swal.fire({
        title: 'Generando...',
        timer: timeToLoading,
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
