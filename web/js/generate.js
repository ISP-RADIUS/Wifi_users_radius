function addLine(studentInfo) {
    var new_line = '' +
        '<tr>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo.lastname + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo.firstname + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo.middlename + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo.login + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo.pswrd + '"></td>' +
        '<td><select class="form-control newline final-data">' + $('#addusersform-tarif').clone().html() + '</select></td>' +
        '<td>' +
        '<button class="btn btn-default btn-sm btn-delete">' +
        '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>' +
        '</td>' +
        '</tr>';

    $('#table-body').append(new_line);
    $('.newline').val($('#addusersform-tarif').val());
    $('.newline').removeClass('newline');
}

$('#clear-button').click(function () {
    $('.error-table-body').empty();
    $('#table-body').empty();
});

$('#button-manual-add').click(function (e) {
    e.preventDefault();
    var lastname = $('#addusersform-lastname').val().trim();
    var firstname = $('#addusersform-firstname').val().trim();
    var middlename = $('#addusersform-middlename').val().trim();
    var data1 = JSON.stringify({'lastname': lastname, 'firstname': firstname, "middlename": middlename});
    $.ajax({
        url: "/main/manual-upload",
        type: "POST",
        cache: false,
        data: {studentData: data1},
        async: true
    })
        .done(function (response) {
            $('.table-data').css('display', 'block');
            $('.error-data').css('display', 'none');
            var studentInfo = $.parseJSON(response);
            addLine(studentInfo);
        })
        .fail(function () {
            alert("error")
        })
        .always(function () {
        });

});
$('#file-upload-button').click(function (e) {
    e.preventDefault();
    var ggg = $('#fileupload-file').prop('files')[0];
    if (ggg) {
        var reader = new FileReader();
        reader.readAsText(ggg, "UTF-8");
        reader.onload = function (evt) {
            $.ajax({
                url: "/main/file-upload",
                type: "POST",
                cache: false,
                data: {studentData: evt.target.result},
                async: true
            })
                .done(function (response) {
                    var students = $.parseJSON(response);
                    $('.error-table-body').empty();
                    for (var key in students) {
                        if (key != 'error') {
                            $('.table-data').css('display', 'block');
                            $('.error-data').css('display', 'none');
                            addLine(students[key]);
                        }
                        else {
                            var errorLog = students[key];
                            $('.table-data').css('display', 'none');
                            $('.error-data').css('display', 'block');
                            for (var i = 0; i < errorLog.linenumber.length; i++) {
                                $('.error-table-body').append('<tr>' +
                                '<td>' + errorLog.linenumber[i] + '</td>' +
                                '<td>' + errorLog.content[i] + '</td>' +
                                '</tr>');
                            }

                        }
                    }
                    $('.btn-delete').click(function () {
                        $(this).parent().parent().remove();
                    });
                })
                .fail(function () {
                    alert("error")
                })
                .always(function () {
                });
        };
        reader.onerror = function (evt) {
        }
    }
});