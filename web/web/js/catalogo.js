$().ready(function () {
    $("#tablaLibros td").click(function () {  
        if ($(this).children().first().attr('id') == "detalleLibro"){
             $("#frmMenu #controlador").val("controladorLibros");
            $("#frmMenu #metodo").val("libroDet");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
            $("#frmMenu").submit();
            return;
        }
        else {
                if ($(this).children().first().attr('id') == "reservaLibro"){
                    $("#frmMenu #controlador").val("controladorLibros");
                    $("#frmMenu #metodo").val("reservarLibro");
                    $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
                    $("#textoDialogo").html("Se generará la reserva del libro, ¿desea continuar?");
                    $('#dialog').dialog('open');
                    return;
            }
        }
    });
    $("#frmVolverCatalogo").click(function () {
        $("#frmMenu #controlador").val("controladorPrincipal");
        $("#frmMenu #metodo").val("catalogo");
        $("#frmMenu").submit();
    });
     $("#frmReservar").click(function () {
        $("#frmMenu #controlador").val("controladorLibros");
        $("#frmMenu #metodo").val("reservarLibro");
        $("#frmMenu #ID").val($("#idLibr").val());
        $("#textoDialogo").html("Se generará la reserva del libro, ¿desea continuar?");
        $('#dialog').dialog('open');
        return;
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
    $( "#frmEditorial" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorLibros',
            metodo: 'editorialAutocomplete',
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
    $( "#frmGenero" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorLibros',
            metodo: 'generoAutocomplete',
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
    $( "#frmSubgenero" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorLibros',
            metodo: 'subGeneroAutocomplete',
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
    $( "#frmISBN" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorLibros',
            metodo: 'isbnAutocomplete',
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
    $("#frmBusquedaLibroCat").click(function () {
        $("#frmCatalogoLibro #controlador").val("controladorPrincipal");
        $("#frmCatalogoLibro #metodo").val("catalogo");
        $("#frmCatalogoLibro").submit();
    });
});