<!DOCTYPE html>
<html>
    <head>
        <title>Export Table to Excel</title>
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    </head>
    <body>
        <h1 class="titlestyle">Export Table to Excel</h1>
        <a href="#" class="" id="exel" onclick="tableToExcel('tbl', 'name', 'result.xls')"><img style="width:50px;height:50px;" alt ="Export Excel" src="http://www.iconarchive.com/download/i86104/graphicloads/filetype/excel-xls.ico"/></a>

        <table style="width:100%;" id="tbl">
            <tr style="background-color:#434345;color:#ffffff;">
                <th>id</th>
                <th>language</th>
                <th>mark</th>
            </tr>
            <tbody id="Result"  class="tdz"></tbody>
        </table>

    </body>

    <script>
    var data=[[1,"HTML",1000],[2,"CSS",700],[3,"JavaScript",800],[4,"Jquery",1500],[5,"Java",700]];

    $("#Result").empty();
    var p="";

    for(var i=0,len=data.length;i<len;i++){
        p = "<tr>";
        p += "<td>"+ data[i][0] +"</td>";
        p += "<td>"+ data[i][1] +"</td>";
        p += "<td>"+ data[i][2] +"</td>";
        p += "</tr>";

        $("#Result").append(p);
    }

    alert("export button work in browser.");

    </script>

    <script>
var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines></x:DisplayGridlines></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
    return function (table, name, filename) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

        document.getElementById("exel").href = uri + base64(format(template, ctx));
        document.getElementById("exel").download = filename;

    }
})()
</script>
</html>
