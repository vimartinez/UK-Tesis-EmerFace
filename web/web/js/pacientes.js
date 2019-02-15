$().ready(function () {
    $("#frmNuevoAutor").click(function () {
    	$("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("addPaciente");
        $("#frmMenu").submit();
    });
    $("#frmVolverUsuario").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("gestionPacientes");
        $("#frmMenu").submit();
    });
    $("#frmVolverLibro").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("gestionPacientes");
        $("#frmMenu").submit();
    });
    $("#frmVolverAutores").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("gestionPacientes");
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
    
    
    $("#tablaAutores td").click(function () {  
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("detallePaciente");
        $("#frmMenu #ID").val($(this).closest("tr").attr("id"));
        $("#frmMenu").submit();
        return;
    });
    $("#frmNuevaPat").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("addPatologiaPaciente");
        $("#frmMenu #ID").val($("#pacId").val());
        $("#frmMenu").submit();
    });
    $("#frmNuevoTrat").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("addTratamiento");
        $("#frmMenu #ID").val($("#pacId").val());
        $("#frmMenu").submit();
    });
    $("#frmNuevaPersCont").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("addPersonContacto");
        $("#frmMenu #ID").val($("#pacId").val());
        $("#frmMenu").submit();
    });
     $("#frmGuardarPatologia2").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("addPatologiaPacienteDo");
        $("#frmMenu").submit();
    });
    $("#frmVolverUsuarioDet").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("gestionPacientes");
        $("#frmMenu").submit();
    });
    $("#frmGuardarTratam").click(function () {
      //  $("#frmMenu #controlador").val("controladorPacientes");
       // $("#frmMenu #metodo").val("addTratamientoDo");
       $("#frmMenu #ID").val($("#pacId").val());
        $("#frmMenu").submit();
    });
    
    $("#frmGuardarPesContact").click(function () {
      //  $("#frmMenu #controlador").val("controladorPacientes");
       // $("#frmMenu #metodo").val("addTratamientoDo");
       $("#frmMenu #ID").val($("#pacId").val());
       $("#frmMenu").submit();
    });
    $("#frmNuevaImagen").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("addImagenes2");
        $("#frmMenu #ID").val($("#pacId").val());
        $("#frmMenu").submit();
    });
    $("#img1, #img2, #img3, #img4, #img5, #img6, #img7, #img8").click(function () {
        $("#idImagen").val(this.id);
        $("#imgInp").click();
    });
    $("#imgInp").change(function () {
        var preview = document.getElementById($("#idImagen").val());
       // var hiddenFrm = document.getElementById("path"+$("#idImagen").val());
        var file    = $('#imgInp')[0].files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
          preview.src = reader.result;
       //   hiddenFrm.value = reader.result;
        }

        if (file) {
          reader.readAsDataURL(file);
        } else {
          preview.src = "";
        }
    }); 
    
    $("#frmGuardarImgs").click(function () {
      //  $("#frmMenu #controlador").val("controladorPacientes");
      //  $("#frmMenu #metodo").val("addImagenesDo");
        $("#frmMenu #ID").val($("#pacId").val());
        $("#frmMenu").submit();
    });
    
     $("#frmNuevaImagen2").click(function () {
        $("#frmMenu #controlador").val("controladorPacientes");
        $("#frmMenu #metodo").val("addImagenes2");
        $("#frmMenu #ID").val($("#pacId").val());
        $("#frmMenu").submit();
    });
    
     $("#frmFechaNac").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
      yearRange: "-100:+0",
      onClose: function (selectedDate) {
          $("#from").datepicker("option","maxdate",selectedDate);
      }
    });
    
    
    
});