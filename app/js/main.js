
var url = "../controller/main.controller.php";
var idUsuario = "";

$(document).ready(function () {
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

function traerConfiguracion() {
    $.ajax({
        data: { "accion": "TRAERCONFIGURACION" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        document.getElementById('totalActas').innerHTML = response.total_Actas
        document.getElementById('totalCandidatos').innerHTML = response.numero_candidatos
        document.getElementById('estadoGeneracion').innerHTML = response.estado_generacion
    }).fail(function (response) {
        console.log(response);
    });
}

function traerUsuarios() {
    $.ajax({
        data: { "accion": "TRAERUSUARIOS" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        document.getElementById('totalUsuarios').innerHTML = response
    }).fail(function (response) {
        console.log(response);
    });
}

function traerSesiones() {
    $.ajax({
        data: { "accion": "TRAERSESIONES" },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        document.getElementById('totalSesiones').innerHTML = response
    }).fail(function (response) {
        console.log(response);
    });
}

function traerErrores() {
    idUsuario = $("#idUsuario").text();
    $.ajax({
        data: { "accion": "TRAERERRORES", "idUsuario": idUsuario },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        document.getElementById('errores').innerHTML = response
    }).fail(function (response) {
        console.log(response);
    });
}


function traerMejorTiempo() {
    idUsuario = $("#idUsuario").text();
    $.ajax({
        data: { "accion": "TRAERMEJORTIEMPO", "idUsuario": idUsuario },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        if (response) {
            document.getElementById('mejorTiempo').innerHTML = response
        } else {
            document.getElementById('mejorTiempo').innerHTML = "00:00:00";
        }
    }).fail(function (response) {
        console.log(response);
    });
}

function tpa() {
    idUsuario = $("#idUsuario").text();
    $.ajax({
        data: { "accion": "TPA", "idUsuario": idUsuario },
        url: url,
        type: 'POST',
        dataType: 'json'
    }).done(function (response) {
        document.getElementById('tpa').innerHTML = response
    }).fail(function (response) {
        console.log(response);
    });
}




