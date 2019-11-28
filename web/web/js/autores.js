$().ready(function () {
    $("#frmNuevoAutor").click(function () {
    	$("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("addAutor");
        $("#frmMenu").submit();
    });
    $("#frmVolverAutores").click(function () {
        $("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("gestionAutores");
        $("#frmMenu").submit();
    });
    $("#frmVolverStaff").click(function () {
        $("#frmMenu #controlador").val("controladorPrincipal");
        $("#frmMenu #metodo").val("admin");
        $("#frmMenu").submit();
    });
    $("#tablaAutores img").click(function () {  
        $("#frmMenu #controlador").val("controladorAutores");
        $("#frmMenu #metodo").val("delAutor");
        $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
        $("#textoDialogo").html("Esta acción borrará un autor, ¿Desea continuar?");
        $('#dialog').dialog('open');
    });
    $("#frmGuardarAutores").click(function () {
        $("#frmAutores #controlador").val("controladorAutores");
        $("#frmAutores #metodo").val("addAutorDo");
        $("#frmAutores").submit();
    });
    $( "#frmNombre" ).focus();
    $( "#frmNac" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorAutores',
            metodo: 'autorAutocomplete',
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

});