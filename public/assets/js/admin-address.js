$(document).ready(function(){
    //Datatable - Address
    var url = window.location.href;
    var array = url.split('/');
    var lastsegment = array[array.length-1];
    if(lastsegment=="list"){
        var oTable = $('#address-table').dataTable({
            "bLengthChange": false,
            "iDisplayLength": 10,
            "sPaginationType": "bootstrap",
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
            "aoColumns": [
                null,
                null,
                null,
                { "bSortable": false }
            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });
    }

    $(".delete").click(function(){
        if(confirm("Are you sure you want to delete this?")){
            var geturl = $(this).data("url");
            window.location.href = geturl;
        }
        else{
            return false;
        }
    });
});
