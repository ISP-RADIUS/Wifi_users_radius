$('.groupCheckbox').click(function () {
    var isMainChecked = $(this).prop('checked');
    var groupName = $(this).attr('id');
    $('.' + groupName + '').each(function () {
        if (isMainChecked) {
            $(this).prop('checked', true);
        }
        else {
            $(this).prop('checked', false);
        }
    });
    if ($('.groupChildCheckbox:checked').length > 0) {
        $('.enable-selected-button').prop('disabled', false);
        $('.disable-selected-button').prop('disabled', false);
        $('.delete-selected-button').prop('disabled', false);
    }
    else {
        $('.enable-selected-button').prop('disabled', true);
        $('.disable-selected-button').prop('disabled', true);
        $('.delete-selected-button').prop('disabled', true);
    }
});

$('.groupChildCheckbox').click(function () {
    if ($('.groupChildCheckbox:checked').length > 0) {
        $('.enable-selected-button').prop('disabled', false);
        $('.disable-selected-button').prop('disabled', false);
        $('.delete-selected-button').prop('disabled', false);
    }
    else {
        $('.enable-selected-button').prop('disabled', true);
        $('.disable-selected-button').prop('disabled', true);
        $('.delete-selected-button').prop('disabled', true);
    }
});