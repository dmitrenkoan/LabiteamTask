
$('#removePicture').click(function () {
    if($(this).prop( "checked" )) {
        $('#warning-picture').fadeIn();
    }
    else {
        $('#warning-picture').fadeOut();
    }
});
$('.btn-danger').click(function () {
    if(confirm('Вы уверены что хотите удалить запись?') == false) {
        return false;
    }
});
