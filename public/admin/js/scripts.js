$(document).ready(function() {

    $('div.captcha img').click(function(){
        $.get('/application/captcha/index', function(data) {
            $('div.captcha img').attr('src', data.url);
            $('input[name="Captcha[id]"]').val(data.id);
        });

    });

    $("#check-all").change(function () {
        var chec = false;
        if ($(this).is(":checked")) {
            chec = true;
        }
        $(".checkbox_item").prop('checked', chec).trigger('change');
    });

    $('#btn_delete_items').click(function(){
        var url = $("#frm_table").attr('action');

        if (confirmDelete()) {
            $("#frm_table").attr('action', url + '/delete');
            $("#frm_table").submit();
        }
    });

    $('.checkbox_item').change(function() {
        if ($('.checkbox_item:checked').length > 0) {
            $('#bulk_delete_items').show();
            $('.column-title').hide();
        } else {
            $('#bulk_delete_items').hide();
            $('.column-title').show();
        }
    });

    $('.field-en').hide();
});

function changeLanguage(langCode) {
    $('.field-' + langCode).show();

    if (langCode == 'en') {
        $('.field-vn').hide();
        $('#lang_active').html(' Tiếng Anh <span class="caret"></span>');
    }

    if (langCode == 'vn') {
        $('.field-en').hide();
        $('#lang_active').html(' Tiếng Việt <span class="caret"></span>');
    }
}

function confirmDelete() {
    if (!confirm('Bạn có chắc chắn muốn xóa?')) {
        return false;
    }
    return true;
}

function removeCommas(str) {
    str = str.replace(/\./g, '');
    return str;
}

function addCommas(str) {
    str = str.trim();
    str = str.replace(/\./g, '');
    if (str.length > 12)
        str = str.substring(0, 12);
    //str = Left(str,12);
    //alert(str);
    var ret = '';
    var i = str.length;
    while (i > 3) {
        ret = '.' + str.substr(i - 3, i) + ret;
        str = str.substr(0, i - 3);
        i = str.length;

    }
    if (i > 0)
        ret = '.' + str + ret;

    return ret.substr(1);
}