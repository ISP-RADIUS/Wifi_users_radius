$('.btn-delete-group').click(function (e) {
    e.preventDefault();
    var groupToDelete = $(this).prev().text();
    if (confirm('Are you sure you want to delete ' + groupToDelete + ' group?')) {
        $(this).parent().parent().parent().remove();
        $.ajax({
            url: "/main/delete-group",
            type: "POST",
            data: {postData: groupToDelete},
            async: true
        })
            .done(function (response) {
                console.log(response);
            })
            .fail(function () {
                alert("error")
            })
            .always(function () {
            });
    }
});

$('.delete-selected-button').click(function (e) {
    e.preventDefault();
    var studentsToDelete = [];
    $('.groupChildCheckbox:checked').each(function () {
        studentsToDelete.push($(this).val());
    });
    if (confirm('Are you sure you want to delete ' + studentsToDelete.length + ' students?')) {
        $.ajax({
            url: "/main/delete-students",
            type: "POST",
            data: {postData: JSON.stringify(studentsToDelete)},
            async: true
        })
            .done(function (response) {
                console.log(response);
            })
            .fail(function () {
                alert("error")
            })
            .always(function () {
            });
    }
});

$('#save-group-button').click(function () {
    var newGroup = $('#new-group-input')[0]['value'];
    $.ajax({
        url: "/main/add-group",
        type: "POST",
        data: {postData: newGroup},
        async: true
    })
        .done(function (response) {
            if (response == 'Group already exists') {
                alert(response);
            }
            else {
                location.reload();
            }
        })
        .fail(function () {
            alert("error")
        })
        .always(function () {
        });

});

$('.enable-selected-button').click(function(){
    var studentsToEnable = [];
    $('.groupChildCheckbox:checked').each(function () {
        studentsToEnable.push($(this).val());
    });
    if (confirm('Are you sure you want to enable ' + studentsToEnable.length + ' students?')) {
        $.ajax({
            url: "/main/enable-students",
            type: "POST",
            data: {postData: JSON.stringify(studentsToEnable)},
            async: true
        })
            .done(function (response) {
                console.log(response);
            })
            .fail(function () {
                alert("error")
            })
            .always(function () {
            });
    }
});

$('.disable-selected-button').click(function(){
    var studentsToDisable = [];
    $('.groupChildCheckbox:checked').each(function () {
        studentsToDisable.push($(this).val());
    });
    if (confirm('Are you sure you want to disable ' + studentsToDisable.length + ' students?')) {
        $.ajax({
            url: "/main/disable-students",
            type: "POST",
            data: {postData: JSON.stringify(studentsToDisable)},
            async: true
        })
            .done(function (response) {
                console.log(response);
            })
            .fail(function () {
                alert("error")
            })
            .always(function () {
            });
    }
});