$().ready(function () {
    $("#frmNuevoSocio").click(function () {
    	$("#frmMenu #controlador").val("controladorUsuarios");
        $("#frmMenu #metodo").val("addSocio");
        $("#frmMenu").submit();
    });
    $("#frmGuardarSocio2").click(function () {
        $("#frmAltaSocios2 #controlador").val("controladorUsuarios");
        $("#frmAltaSocios2 #metodo").val("addSocioDo");
        if($("#frmClave").val().length < 6 ){
            $('#frmClave').get(0).setCustomValidity('La clave debe tener al menos 6 caracteres');
            return;
        }
        if($("#frmClave2").val().length < 6 ){
            $('#frmClave2').get(0).setCustomValidity('La clave debe tener al menos 6 caracteres');
            return;
        }
      //  if($("#frmClave").val() != $("#frmClave2").val()){
      //      $('#frmClave2').get(0).setCustomValidity('Las claves ingresadas no coinciden.');
      //      return;
      //  }
        if($("#frmProvincia").val() == 0){
            $('#frmProvincia').get(0).setCustomValidity('Debe seleccionar una provincia.');
            return;
        }
        $("#frmAltaSocios2").submit();
    });
     $("#frmVolverSocio").click(function () {
        $("#frmMenu #controlador").val("controladorUsuarios");
        $("#frmMenu #metodo").val("gestionSocios");
        $("#frmMenu").submit();
    });
    $("#frmVolverStaff").click(function () {
        $("#frmMenu #controlador").val("controladorPrincipal");
        $("#frmMenu #metodo").val("admin");
        $("#frmMenu").submit();
    });
    $( "#frmLocalidad" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorUsuarios',
            metodo: 'socioAutocomplete',
            term: request.term
        },
        type: 'POST',
          dataType: "json",
          success: function( data ) {
            response( data );
          },
          error: function (xhr, status) {
            alert('Error cargando las localidades.');
        },
        } );
      },
      minLength: 2,
      select: function( event, ui ) {
        $( "#frmNac" ).val(ui.item.value)
        $( "#autPais" ).val(ui.item.id)
      }
    });
    $("#tablaSocios img").click(function () {  
        $("#frmMenu #controlador").val("controladorUsuarios");
        $("#frmMenu #metodo").val("delSocio");
        $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
        $("#textoDialogo").html("Esta acción borrará un socio, ¿Desea continuar?");
        $('#dialog').dialog('open');
    });
    $("#tablaPrestamosActivos td").click(function () {  
        if ($(this).children().first().attr('id') == "sancionSocio"){
            $("#frmMenu #controlador").val("controladorUsuarios");
            $("#frmMenu #metodo").val("addSancion");
            $("#frmMenu #ID").val($(this).closest("tr").attr("id")); 
            $("#frmMenu").submit();
        }
    });
    $( "#frmNombreSocio" ).autocomplete({
        source: function( request, response ) {
        $.ajax( {
          url: 'index.php',
        data: {
            controlador: 'controladorUsuarios',
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
    $("#frmBusquedaSocio").click(function () {
        $("#frmSocioSancion #controlador").val("controladorUsuarios");
        $("#frmSocioSancion #metodo").val("addSancion");
        $("#frmSocioSancion").submit();
    });
     $("#frmSancionSocio").click(function () {
        $("#frmSocioSancion #controlador").val("controladorUsuarios");
        $("#frmSocioSancion #metodo").val("addSancion");
        $("#frmSocioSancion #id").val($("#frmSocioSancion #idSocio").val());
        $("#frmSocioSancion").submit();
    });
    $("#frmNuevoUsuario").click(function () {
    	$("#frmMenu #controlador").val("controladorUsuarios");
        $("#frmMenu #metodo").val("addUsuario");
        $("#frmMenu").submit();
    });
    $("#frmGuardarUsuario2").click(function () {
        $("#frmAltaSocios2 #controlador").val("controladorUsuarios");
        $("#frmAltaSocios2 #metodo").val("addUsuarioDo");
        if($("#frmClave").val().length < 6 ){
            $('#frmClave').get(0).setCustomValidity('La clave debe tener al menos 6 caracteres');
            return;
        }
        if($("#frmClave2").val().length < 6 ){
            $('#frmClave2').get(0).setCustomValidity('La clave debe tener al menos 6 caracteres');
            return;
        }
      //  if($("#frmClave").val() != $("#frmClave2").val()){
      //      $('#frmClave2').get(0).setCustomValidity('Las claves ingresadas no coinciden.');
      //      return;
      //  }
        if($("#frmProvincia").val() == 0){
            $('#frmProvincia').get(0).setCustomValidity('Debe seleccionar una provincia.');
            return;
        }
        $("#frmAltaSocios2").submit();
    });
    $("#tablaUsuarios img").click(function () {  
        $("#frmMenu #controlador").val("controladorUsuarios");
        $("#frmMenu #metodo").val("delUsuario");
        $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
        $("#textoDialogo").html("Esta acción borrará un usuario, ¿Desea continuar?");
        $('#dialog').dialog('open');
    });
    $("#frmVolverUsuario").click(function () {
        $("#frmMenu #controlador").val("controladorUsuarios");
        $("#frmMenu #metodo").val("gestionUsuarios");
        $("#frmMenu").submit();
    });
});