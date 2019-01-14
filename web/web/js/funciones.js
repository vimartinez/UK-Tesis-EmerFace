$().ready(function () {
    $("#mnuServicios").click(function () {
    	$("#frmMenu #controlador").val("ControladorUsuarios");
        $("#frmMenu #metodo").val("gestionUsuarios");
        $("#frmMenu").submit();
    });
    $("#mnuCatalogo").click(function () {
    	$("#frmMenu #controlador").val("ControladorPacientes");
        $("#frmMenu #metodo").val("gestionPacientes");
        $("#frmMenu").submit();
    });
    $("#mnuLinks").click(function () {
    	$("#frmMenu #controlador").val("ControladorPacientes");
        $("#frmMenu #metodo").val("listadoPatologias");
        $("#frmMenu").submit();
    });
    $("#mnuLogin2").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("Login");
        $("#frmMenu").submit();
    });
    $("#mnuLogin").click(function () {
    	$("#frmMenu #controlador").val("ControladorMedicos");
        $("#frmMenu #metodo").val("gestionMedicos");
        $("#frmMenu").submit();
    });
    $("#mnuContacto").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("contacto");
        $("#frmMenu").submit();
    });
    $("#mnuAcercaDe").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("acercaDe");
        $("#frmMenu").submit();
    });
     $("#mnuAdmin").click(function () {
    	$("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("admin");
        $("#frmMenu").submit();
    });
     $("#mnuSocios").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("ayuda");
        $("#frmMenu").submit();
    });
      $("#mnuSalir").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("salir");
        $('#dialog').dialog('open');
    });
     $("#frmLoginEnviar").click(function () {
    	$("#frmlogin #controlador").val("ControladorPrincipal");
        $("#frmlogin #metodo").val("loginDo");
        $("#frmlogin").submit();
    }); 
    $("#func-1").click(function () {
        $("#frmMenu #controlador").val("ControladorLibros");
        $("#frmMenu #metodo").val("gestionLibros");
        $("#frmMenu").submit();
    }); 
    $("#func-2").click(function () {
        $("#frmMenu #controlador").val("ControladorAutores");
        $("#frmMenu #metodo").val("gestionAutores");
        $("#frmMenu").submit();
    });  
    $("#func-3").click(function () {
        $("#frmMenu #controlador").val("ControladorSocios");
        $("#frmMenu #metodo").val("gestionSocios");
        $("#frmMenu").submit();
    });
    $("#func-4").click(function () {
        $("#frmMenu #controlador").val("ControladorLibros");
        $("#frmMenu #metodo").val("reserva");
        $("#frmMenu").submit();
    });
    $("#func-5").click(function () {
        $("#frmMenu #controlador").val("ControladorLibros");
        $("#frmMenu #metodo").val("prestamo");
        $("#frmMenu").submit();
    });
    $("#func-6").click(function () {
        $("#frmMenu #controlador").val("ControladorLibros");
        $("#frmMenu #metodo").val("devolucion");
        $("#frmMenu").submit();
    });
    $("#func-7").click(function () {
        $("#frmMenu #controlador").val("ControladorPrincipal");
        $("#frmMenu #metodo").val("catalogo");
        $("#frmMenu").submit();
    });
    $("#func-8").click(function () {
        $("#frmMenu #controlador").val("ControladorLibros");
        $("#frmMenu #metodo").val("getPrestamosActivos");
        $("#frmMenu").submit();
    });
    $("#func-9").click(function () {
        $("#frmMenu #controlador").val("ControladorSocios");
        $("#frmMenu #metodo").val("getSociosDeudores");
        $("#frmMenu").submit();
    });
    $("#func-11").click(function () {
        $("#frmMenu #controlador").val("ControladorSocios");
        $("#frmMenu #metodo").val("addSancion");
        $("#frmMenu").submit();
    });
    $("#func-12").click(function () {
        $("#frmMenu #controlador").val("ControladorUsuarios");
        $("#frmMenu #metodo").val("gestionUsuarios");
        $("#frmMenu").submit();
    });
    $("#func-14").click(function () {
        $("#frmMenu #controlador").val("ControladorLibros");
        $("#frmMenu #metodo").val("getReservasActivas");
        $("#frmMenu").submit();
    });
    $("#textoDialogo").html("Está saliendo del sistema, ¿Desea continuar?");
    $("#dialog").dialog({
        modal: true, title: 'Aviso:', zIndex: 10000, autoOpen: false,
        width: 'auto', resizable: false,
        buttons: {
            Si: function () {
                $(this).dialog("close");
                $("#frmMenu").submit();
            },
            No: function () {                                                                 
                $(this).dialog("close");
            }
        },
       // close: function (event, ui) {
       //     $(this).remove();
       // }
});

});