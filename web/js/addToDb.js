function addErrorLine(studentInfo) {
    var new_line = '' +
        '<tr>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo[0] + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo[1] + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo[2] + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo[3] + '"></td>' +
        '<td><input type="text" class="form-control final-data" value="' + studentInfo[4] + '"></td>' +
        '<td><select class="form-control newline final-data">' + $('#addusersform-tarif').clone().html() + '</select></td>' +
        '</tr>';
    $('#table-body').append(new_line);
    $('.newline').val($('#addusersform-tarif').val());
    $('.newline').removeClass('newline');
}

$('#database-upload').click(function (e) {
    e.preventDefault();
    var groupName = $('#addusersform-group').val();
    var validated = true;
    if (groupName == '') {
        $('#addusersform-group').next().text('Group cannot be blank');
        $('#addusersform-group').next().css('display', 'block');
        $('#addusersform-group').next().css('color', '#a94442');
        validated = false;
    }
    if (validated) {
        $('#addusersform-group').next().css('display', 'none');
        $('#addusersform-group').next().css('color', '#737373');
        var postData = [];
        var currentData = [];
        var i = 0;
        $('.final-data').each(function () {
            currentData.push($(this).val());
            i++;
            if (i == 6) {
                i = 0;
                currentData.push(groupName);
                postData.push(currentData);
                currentData = [];
            }
        });
        postData = JSON.stringify(postData);
        $.ajax({
            url: "/main/upload",
            type: "POST",
            data: {postData: postData},
            async: true
        })
            .done(function (response) {
                var students = $.parseJSON(response);
                $('.error-table-body').empty();
                $('#table-body').empty();
                for (var key in students) {
                    if (students[key].length > 7) {
                        //console.log(students[key]);
                        addErrorLine(students[key]);
                    }
                }
            })
            .fail(function () {
                alert("error")
            })
            .always(function () {
            });
    }
})