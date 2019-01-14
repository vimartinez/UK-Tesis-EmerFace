$().ready(function () {
    $("#frmNuevoLibro").click(function () {
    	$("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("addLibro");
        $("#frmMenu").submit();
    });
     $("#frmVolverStaff").click(function () {
        $("#frmMenu #controlador").val("controladorPrincipal");
        $("#frmMenu #metodo").val("admin");
        $("#frmMenu").submit();
    });
     $("#frmVolverLibro").click(function () {
        $("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("gestionLibros");
        $("#frmMenu").submit();
    });
     $("#frmGuardarLibro").click(function () {
        $("#frmAltaLibro #controlador").val("controladorLibros");
        $("#frmAltaLibro #metodo").val("addLibroDo");
        $("#frmAltaLibro").submit();
    });
      $("#tablaLibros td").click(function () {  
        if ($(this).children().first().attr('id') == "delLibro"){
             $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("delLibro");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            $("#textoDialogo").html("Se eliminarán todas las copias del libro seleccionado, ¿desea continuar?");
            $('#dialog').dialog('open');
            return;
        }
        else {
                if ($(this).children().first().attr('id') == "imprEtiquetas"){
                    $("#frmMenu #controlador").val("controladorLibros");
                    $("#frmMenu #metodo").val("imprimirEtiquetas");
                    $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
                    $("#textoDialogo").html("Se imprimirán las etiquetas para el libro seleccionado, ¿desea continuar?");
                    $('#dialog').dialog('open');
                    return;
            }
            else {
                $("#frmMenu #controlador").val("controladorLibros");
                $("#frmMenu #metodo").val("detalleLibro");
                $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
                $("#frmMenu").submit();
                return;
            }
        }
    });
    $("#frmNuevoAutor").click(function () {
        $("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("addAutor");
        $("#frmMenu").submit();
    });
    $("#tablaLibrosDet td").click(function () {  
        if ($(this).children().first().attr('id') == "updEstadoCopia"){
            $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("updEstadoCopia");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            $("#frmMenu").submit();
            return;
        }
    });
    $("#frmActualizarEstado").click(function () {
        $("#frmEstadoCopia #controlador").val("controladorLibros");
        $("#frmEstadoCopia #metodo").val("updEstadoCopiaDo");
        $("#frmEstadoCopia").submit();
    });
    $( "#frmNombrelibro" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorLibros',
            metodo: 'libroAutocomplete',
            term: request.term
        },
        type: 'POST',
          dataType: "json",
          success: function( data ) {
            response( data );
          },
          error: function (xhr, status) {
            alert('Error cargando los paises.');
        },
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        $( "#frmNac" ).val(ui.item.value)
        $( "#autPais" ).val(ui.item.id)
      }
    });
    $("#frmBusquedaLibro").click(function () {
        $("#frmReservaLibro #controlador").val("controladorLibros");
        $("#frmReservaLibro #metodo").val("getLibro");
        $("#frmReservaLibro").submit();
    });
    $("#frmReservarLibro").click(function () {  
        $("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("reservarLibro");
        $("#frmMenu #ID").val($("#frmReservaLibro #ID").val());
        $("#textoDialogo").html("Se generará la reserva del libro, ¿desea continuar?");
        $('#dialog').dialog('open');
        return;
    });
    $( "#frmNombreSocio" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorSocios',
            metodo: 'socioAutocomplete2',
            term: request.term
        },
        type: 'POST',
          dataType: "json",
          success: function( data ) {
            response( data );
          },
          error: function (xhr, status) {
            alert('Error cargando los paises.');
        },
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        $( "#frmNac" ).val(ui.item.value)
        $( "#autPais" ).val(ui.item.id)
      }
    });
     $("#frmBuscarSocio").click(function () {
        $("#frmSocio #controlador").val("controladorLibros");
        $("#frmSocio #metodo").val("prestamo");
        $("#frmSocio").submit();
    });
    $("#tablaLibrosPrest td").click(function () {  
        if ($(this).children().first().attr('id') == "prestarLibro"){
            $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("addPrestamo");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            //$("#textoDialogo").html("Se generará el préstamo, ¿desea continuar?");
            //$('#dialog').dialog('open');
            //return;    
            $("#frmMenu").submit();
        }
        if ($(this).children().first().attr('id') == "prestarLibroSinRes"){
            $("#frmlibroPrest #controlador").val("controladorLibros");
            $("#frmlibroPrest #metodo").val("addPrestamo");
            $("#frmlibroPrest #lib_id").val($(this).closest("tr").attr("id"));
            //$("#textoDialogo").html("Se generará el préstamo, ¿desea continuar?");
           // $('#dialog').dialog('open');
            $("#frmlibroPrest").submit();
            //return;    
        }
    });
    $("#frmBuscarLibroPrest").click(function () {
        $("#frmlibroPrest #controlador").val("controladorLibros");
        $("#frmlibroPrest #metodo").val("prestamo");
        $("#frmlibroPrest").submit();
    });
    $( "#codLibro" ).focus();  
    $("#tablaPrestamosActivos td").click(function () {  
        if ($(this).children().first().attr('id') == "sancionSocio"){
            $("#frmMenu #controlador").val("controladorSocios");
            $("#frmMenu #metodo").val("addSancion");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id")); 
            $("#frmMenu").submit();
        }
    });
    $("#ResrvasActivas td").click(function () {  
        if ($(this).children().first().attr('id') == "eliminarReserva"){
            $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("delReserva");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            $("#frmMenu").submit();
            return;
        }
    });
});