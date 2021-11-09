
var url = "../controller/main.controller.php";
var idUsuario = "";

$(document).ready(() => {
    traerConfiguracion();
    traerErrores();
    traerMejorTiempo();
    tpa();
    idUsuario = $("#idUsuario").text();
    if (idUsuario == 1) {
        traerUsuarios();
        traerSesiones();
    }
})

traerConfiguracion = () => {
    $.ajax({
        data: { "accion": "TRAERCONFIGURACION" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        document.getElementById('totalActas').innerHTML = response.total_actas
        document.getElementById('totalCandidatos').innerHTML = response.numero_candidatos
        document.getElementById('estadoGeneracion').innerHTML = response.estado_generacion
    }).fail((err) => {
        console.log(err);
    });
}

traerUsuarios = () => {
    $.ajax({
        data: { "accion": "TRAERUSUARIOS" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        document.getElementById('totalUsuarios').innerHTML = response
    }).fail((err) => {
        console.log(err);
    });
}

traerSesiones = () => {
    $.ajax({
        data: { "accion": "TRAERSESIONES" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        document.getElementById('totalSesiones').innerHTML = response
    }).fail((err) => {
        console.log(err);
    });
}

traerErrores = () => {
    idUsuario = $("#idUsuario").text();
    $.ajax({
        data: { "accion": "TRAERERRORES", "idUsuario": idUsuario },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        document.getElementById('errores').innerHTML = response
    }).fail((err) => {
        console.log(err);
    });
}


traerMejorTiempo = () => {
    idUsuario = $("#idUsuario").text();
    $.ajax({
        data: { "accion": "TRAERMEJORTIEMPO", "idUsuario": idUsuario },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        if (response != false) {
            document.getElementById('mejorTiempo').innerHTML = response.tiempo_total
        } else {
            document.getElementById('mejorTiempo').innerHTML = "00:00:00";
        }
    }).fail((err) => {
        console.log(err);
    });
}

tpa = () => {
    idUsuario = $("#idUsuario").text();
    $.ajax({
        data: { "accion": "TPA", "idUsuario": idUsuario },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done((response) => {
        document.getElementById('tpa').innerHTML = response
    }).fail((err) => {
        console.log(err);
    });
}




