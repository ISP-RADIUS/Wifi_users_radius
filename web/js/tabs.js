$('.manual').click(function () {
    $('.tab1').css('display', 'block');
    $('.tab2').css('display', 'none');
    $(this).addClass('active');
    $('.file').removeClass('active');
});
$('.file').click(function () {
    $('.tab1').css('display', 'none');
    $('.tab2').css('display', 'block');
    $(this).addClass('active');
    $('.manual').removeClass('active');
});