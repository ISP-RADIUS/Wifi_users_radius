$('.btn-print').click(function () {
    var data = '';
    $('.groupChildCheckbox:checked').each(function () {
        data += '<tr>';
        data += '<td>' + $(this).next().next().val() + '</td>';
        data += '<td>' + $(this).next().next().next().val() + '</td>';
        data += '<td>' + $(this).val() + '</td>';
        data += '<td>' + $(this).next().val() + '</td>';
        data += '</tr>';
    });

    var mywindow = window.open();
    mywindow.document.write('<html><head><title>Print groups</title>');
    mywindow.document.write('</head><body>');
    mywindow.document.write('<table border="1" cellpadding="5">' +

    '<tr>' +
    '<th width="300" align="left"><h3>Full Name</h3></th>' +
    '<th width="75" align="left"><h3>Group</h3></th>' +
    '<th width="200" align="left"><h3>Login</h3></th>' +
    '<th width="200" align="left"><h3>Password</h3></th>' +
    '</tr>');
    mywindow.document.write(data);
    mywindow.document.write('</table>');
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10

    mywindow.print();
    mywindow.close();

    return true;
});
