$(document).ready(function () {
    var DATA_TABLE_OPTIONS = {
        "bLengthChange": false,
        "iDisplayLength": 5,
        "sDom": "Tflt<'row DTTTFooter'<'col-sm-6'i><'col-sm-6'p>>",
        "oTableTools": {
            "aButtons": [
                // "copy",
                // "print",
                // {
                //     "sExtends": "collection",
                //     "sButtonText": "Save <i class=\"fa fa-angle-down\"></i>",
                //     "aButtons": ["csv", "xls", "pdf"]
                // }
            ],
            "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf"
        },
        "language": {
            "search": "",
            "sLengthMenu": "_MENU_",
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            }
        },
        "sPaginationType": "bootstrap"
    };

    //Datatable - Addresses
    $('#addresstable').dataTable(DATA_TABLE_OPTIONS);
    //Datatable - Projects
    $('#projecttable').dataTable(DATA_TABLE_OPTIONS);
    //Datatable - Banks
    $('#banktable').dataTable(DATA_TABLE_OPTIONS);
    //Datatable - User List
    $('#usertable').dataTable(DATA_TABLE_OPTIONS);
    //Datatable - Boost Code Providers (Cities)
    $('#cities-table').dataTable(DATA_TABLE_OPTIONS);
    //Datatable - Boost Code Providers (Others)
    $('#others-table').dataTable(DATA_TABLE_OPTIONS);
});
