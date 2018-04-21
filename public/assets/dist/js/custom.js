var CustomDataTable = {
    language : {
        "sProcessing" : "Espere...",
        "sLengthMenu" : "_MENU_ Registros por página",
        "sZeroRecords" : "No se encontraron resultados",
        "sEmptyTable" : "Ningún dato disponible en esta tabla",
        "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix" : "",
        "sSearch" : "Buscar:",
        "sUrl" : "",
        "sInfoThousands" : ",",
        "sLoadingRecords" : "Cargando...",
        "oPaginate" : {
            "sFirst" : "Primero",
            "sLast" : "Último",
            "sNext" : "Siguiente",
            "sPrevious" : "Anterior"
        },
        "oAria" : {
            "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
        },
        buttons: {
            copyTitle: 'El contenido de la tabla ha sido copiado',
            copySuccess: {
                _: '%d Lineas copiadas',
                1: '1 Linea copiada'
            }
        }
    },
    applyCustomStyleTo : function(selector, customOptions) {
        var options = {
            "bFilter" : true,
            "bSearchable" : true,
            "destroy": true,
            "responsive": true,
            "language" : CustomDataTable.language,
            "dom" : 'f<"custom-table"t><"custom-table-bottom filtrosPag pagiNation"rlp><"clear">'
        };



        var mergedOptions = options;
        if (customOptions) {
            mergedOptions = $.extend(options, customOptions);
        }
        return $(selector).DataTable(mergedOptions);
    }
};

var ProgressDataTable = {
    language : {
        "sProcessing" : "Espere...",
        "sLengthMenu" : "_MENU_ Registros por página",
        "sZeroRecords" : "No se encontraron resultados",
        "sEmptyTable" : "Ningún dato disponible en esta tabla",
        "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix" : "",
        "sSearch" : "Buscar:",
        "sUrl" : "",
        "sInfoThousands" : ",",
        "sLoadingRecords" : "Cargando...",
        "oPaginate" : {
            "sFirst" : "Primero",
            "sLast" : "Último",
            "sNext" : "Siguiente",
            "sPrevious" : "Anterior"
        },
        "oAria" : {
            "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
        }
    },
    applyCustomStyleTo : function(selector, customOptions) {
        var options = {
            "bFilter" : false,
            "bSearchable" : false,
            "destroy": true,
            "responsive": true,
            "paging": false,
            "ordering": false,
            "language" : ProgressDataTable.language,
            "dom" : 'f<"custom-table"t><"custom-table-bottom filtrosPag pagiNation"rlp><"clear">'
        };

        var mergedOptions = options;
        if (customOptions) {
            mergedOptions = $.extend(options, customOptions);
        }
        return $(selector).DataTable(mergedOptions);
    }
};

var DashboardDataTable = {
    language : {
        "sProcessing" : "Espere...",
        "sLengthMenu" : "_MENU_ Registros por página",
        "sZeroRecords" : "No se encontraron resultados",
        "sEmptyTable" : "Ningún dato disponible en esta tabla",
        "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix" : "",
        "sSearch" : "Buscar:",
        "sUrl" : "",
        "sInfoThousands" : ",",
        "sLoadingRecords" : "Cargando...",
        "oPaginate" : {
            "sFirst" : "Primero",
            "sLast" : "Último",
            "sNext" : "Siguiente",
            "sPrevious" : "Anterior"
        },
        "oAria" : {
            "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
        }
    },
    applyCustomStyleTo : function(selector, customOptions) {
        var options = {
            "bFilter" : true,
            "bSearchable" : true,
            "destroy": true,
            "responsive": true,
            "bLengthChange": false,
            "language" : DashboardDataTable.language,
            "dom" : 'f<"custom-table"t><"custom-table-bottom filtrosPag pagiNation"rlp><"clear">'
        };



        var mergedOptions = options;
        if (customOptions) {
            mergedOptions = $.extend(options, customOptions);
        }
        return $(selector).DataTable(mergedOptions);
    }
};
