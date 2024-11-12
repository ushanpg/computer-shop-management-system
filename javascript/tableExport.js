
function exportBtn() {
    document.addEventListener("DOMContentLoaded", function () {
        var table = document.querySelector(".table-responsive .table");
        // Checks whether data tables are available
        if (table) {
            document.querySelector(".exportBtn").classList.remove("invisible");
            document.querySelector(".printBtn").classList.remove("invisible");
        }
    });
}
exportBtn();

function ExportMenu() {
    var exportBtn = document.querySelector(".exportBtn");
    var exportMenu = document.querySelector(".exportMenu");
    exportMenu.classList.remove("invisible");
    
    document.addEventListener('click', function (event) {
    // Check if the click was outside the Area
    if (!exportMenu.contains(event.target) && !exportBtn.contains(event.target)) {
    exportMenu.classList.add("invisible");
  }
});
}

function ExportData() {
    var format = document.getElementById('exportForm').format.value;
        document.querySelector(".table-responsive .table").id='dataTable';
    if (format == 1) {
        // CSV format
        $('#dataTable').tableExport({type:'csv'});
    }
    if (format == 2) {
        // Excel 2000 html format
        $('#dataTable').tableExport({type:'excel'});
    }
    if (format == 3) {
        // PDF export using jsPDF's core html support
        $('#dataTable').tableExport({type:'pdf',
                           jspdf: {orientation: 'p',
                                   margins: {left:20, top:10},
                                   autotable: false}
                          });
    }
    if (format == 4) {
        // PNG format
        $('#dataTable').tableExport({type:'png'});
    }
}