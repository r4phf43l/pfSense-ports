/*
  SARG Printable
  version 0.0.1
  29th February 2024
  R4PHF43L, http://github.com/r4phf43l/
  
  Instructions:
  Download this file
  Add <script src="sarg_print.js"></script> to your HTML
  Add the buttons
  
  Licenced as MIT: https://opensource.org/license/mit
  This basically means: do what you want with it, but remember me.

  Enjoy.
*/

function printPage() {
  window.print();
}

function exportToCSV(tableId, sep = ';', title = 'table') {
    let csv = [];
    const rows = document.querySelectorAll(`#${tableId} tr`);
    
    rows.forEach(row => {
        let rowData = [];
        row.querySelectorAll("th, td").forEach(cell => {
            rowData.push(cell.textContent);
        });
        csv.push(rowData.join(sep));
    });
    
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    if (link.download !== undefined) {
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', title + '.csv');
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}
