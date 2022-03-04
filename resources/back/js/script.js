let params = new URLSearchParams(window.location.search),
    sort_dir,
    sort_col;

if (params['sort_dir']) {
    sort_dir = params['sort_dir']
}
if (params['sort_col']) {
    sort_col = params['sort_col']
}

const D = $(document);

function reload_filter(sort_col, sort_dir) {
    let url = window.location.pathname + '?';
    $('.filters input').each(function () {
        let name, value1;
        if ($(this).attr('type') == 'checkbox') {
            if ($(this).prop('checked')) {
                name = $(this).attr('name')
                value1 = $(this).val();
                url += name + '=' + value1 + '&';
            }
        } else {
            name = $(this).attr('name')
            value1 = $(this).val();
            if (value1)
                url += name + '=' + value1 + '&';
        }
    });
    $('.filters select').each(function () {
        let name = $(this).attr('name'),
            value1 = $(this).val();
        if (value1)
            url += name + '=' + value1 + '&';
    });
    if (sort_col && sort_dir) {
        url += 'sort_col=' + sort_col + '&sort_dir=' + sort_dir;
    }
    window.location = url;
}

jQuery(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'accept': 'application/json',
        }
    });

    D.on('click', '.show-form', function (e) {
        e.preventDefault();
        $(this).next().show();
        $(this).remove();
    });

    D.on('click', '.avatar-remove', function (e) {
        e.preventDefault();
        $(this).prev().remove();
        $(this).next().val('delete');
        $(this).remove();
    });

    $('.filters select').on('change', function () {
        reload_filter(sort_col, sort_dir);
    });

    $('.filters input').on('keydown', function (e) {
        if (e.keyCode == 13) {
            reload_filter(sort_col, sort_dir);
        }
    });

    D.on('click', '.t_header a', function (e) {
        e.preventDefault();
        if ($(this).attr('class') == 'asc') {
            sort_dir = 'desc';
        } else {
            sort_dir = 'asc';
        }
        sort_col = $(this).attr('href');
        reload_filter(sort_col, sort_dir);
    });

    D.on('submit', '.js-form-send', function (e) {
        e.preventDefault();
        $('.error_wrap').html('');
        $('.is-invalid').removeClass('is-invalid');
        let form = $(this);
        let formData = new FormData(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (msg) {
                if (form.data('callback'))
                    window[form.data('callback')]();
                else
                    showSuccess(msg);
            },
            error: function (xhr) {
                showError(xhr, form);
            }
        });
    })

    D.on('change', '[name="role"]', function (){
        $(this).after('<p class="text-primary">Внимание! Вы изменили тип пользователя<br> Чтобы форма отобразилась правильно - <b>ПОСЛЕ СОХРАНЕНИЯ</b> обновите страницу!</p>')
    });

    $('body').on('keyup', '.js-autocomplete', function () {
        let field = $(this);
        let str = field.val();
        if (str != '') {
            field.next('.dropdown-menu').removeClass('show');
            $.ajax({
                type: 'get',
                url: field.data('url'),
                data: {str: str},
                success: function (arr) {
                    console.log(arr);
                    let drop = '';
                    for (let i = 0; i < arr.length; i++) {
                        drop += '<a class="dropdown-item" href="' + arr[i][0] + '">' + arr[i][1] + '</a>'
                    }
                    field.next('.dropdown-menu').html(drop);
                    field.next('.dropdown-menu').addClass('show')
                },
                error: function (response) {
                    console.log(response)
                },
            })
        } else {
            field.next('.dropdown-menu').removeClass('show');
            field.closest('.dropdown').find('input').val('');
        }
    });

    $('body').on('click', '.js-autocomplete-dropdown a', function (e) {
        e.preventDefault();
        let parent = $(this).closest('.dropdown-menu');
        if (parent.hasClass('dropdown-menu_multi')) {
            window[parent.data('callback')]($(this));
        } else {
            parent.removeClass('show');
            parent.next('input').val($(this).attr('href')).trigger('change');
            parent.prev('input').val($(this).html());
        }
    });

});

window.showSuccess = function (msg) {
    if (msg.success) {
        $('html,body').stop().animate({scrollTop: 0}, 400);
        $('.error_wrap').html('<div class="alert alert-success">' + msg.success + '</div>');
        setTimeout(function () {
            $('.alert.alert-success').fadeOut(function () {
                $('.alert.alert-success').remove();
            })
        }, 5000)
    }
    if (msg.error) {
        $('html,body').stop().animate({scrollTop: 0}, 400);
        $('.error_wrap').html('<div class="alert alert-danger">' + msg.error + '</div>');
    }
    if (msg.redirect)
        window.location = msg.redirect;
}

window.showError = function (xhr, form) {
    $('.ajax-loader').hide();
    if (xhr.status == 422) {
        let mes = JSON.parse(xhr.responseText).errors;
        let html = '<div class="alert alert-danger"><strong>Ошибка</strong><ul>';
        for (let prop in mes) {
            html += '<li>' + mes[prop] + '</li>';
            form.find('input, textarea, select').each(function () {
                if ($(this).attr('name').replace(/\[/g, '.').replace(/]/g, '') == prop) {
                    $(this).addClass('is-invalid');
                }
            })
        }
        html += ' </ul></div>';
        $('.error_wrap').html(html);
    } else {
        let html = '<div class="alert alert-danger"><strong>Ошибка</strong></div>';
        $('.error_wrap').html(html);
    }
}
