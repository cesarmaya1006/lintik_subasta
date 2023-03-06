$(document).ready(function() {
    $('.display').DataTable( {
        //dom: 'Blfrtip',
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            customize: function(xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
 
                // Loop over the cells in column `C`
                $('row c[r^="C"]', sheet).each( function () {
                    // Get the value
                    if ( $('is t', this).text() == 'New York' ) {
                        $(this).attr( 's', '20' );
                    }
                });
            }
        }],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ resultados",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
            "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
    //TOOLTIPS
    $('body').tooltip({
        trigger: 'hover',
        selector: '.tooltipsC',
        placement: 'top',
        html: true,
        container: 'body'
    });

    //------------------------------------------------------------------------------------------
    $("#tabla-data").on('submit', '.form-eliminar', function() {
        event.preventDefault();
        const form = $(this);

        Swal.fire({
            title: '¿Está seguro que desea eliminar el registro?',
            text: "Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, Estoy seguro',
            cancelButtonText: 'NO, Cancele',
          }).then((result) => {
            if (result.isConfirmed) {
                ajaxRequest(form);
            }
          })

          /*
        swal({
            title: '¿Está seguro que desea eliminar el registro?',
            text: "Esta acción no se puede deshacer!",
            icon: 'warning',
            buttons: {
                cancel: "Cancelar",
                confirm: "Aceptar"
            },
        }).then((value) => {
            if (value) {
                ajaxRequest(form);
            }
        });*/
    });

    function ajaxRequest(form) {
        $.ajax({
            url: form.attr('action'),
            type: 'GET',
            data: form.serialize(),
            success: function(respuesta) {
                console.log(respuesta);
                if (respuesta[0] == "eliminado") {
                    form.parents('tr').remove();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El registro fue eliminado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                      });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'El registro no pudo ser eliminado, hay recursos usandolo',
                        showConfirmButton: false,
                        timer: 1500
                      });
                }
            },
            error: function() {

            }
        });
    }
    //------------------------------------------------------------------------------------------
    
} );