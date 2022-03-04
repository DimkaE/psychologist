window.formatTime = function (time) {
    return time + ':00'
}

window.scrollTop = function () {
    $('html,body').stop().animate({scrollTop: 0}, 400);
}

window.closeModal = function () {
    window.Fancybox.Fancybox.close();
}

window.formatDate = function (date) {
    if (date) {
        return date.getDate() + '.'
            + getFullMonth(date) + '.'
            + date.getFullYear();
    }
    return '';
}

window.getFullMonth = function (date){
    let realMonth = date.getMonth() + 1;
    return ('0' + realMonth).slice(-2);
}

window.formatDateInput = function (date) {
    if (date) {
        return date.getFullYear() + '-'
            + getFullMonth(date) + '-'
            + ('0' + date.getDate()).slice(-2);
    }
    return '';
}

window.formatDateTime = function (date) {
    if (date) {
        return date.getFullYear() + '-'
            + getFullMonth(date) + '-'
            + ('0' + date.getDate()).slice(-2) + ' '
            + date.getHours() + ':00:00';
    }
    return '';
}

window.maxFileSize = 2000000;
window.allTimes = [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22];

window.showModalError = function (msg) {
    $('#modal-error .modal__inner').html(msg)
    window.Fancybox.Fancybox.show([{
        src: '#modal-error',
        type: 'inline'
    }]);
}

window.copyToClipboard = function (elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            //target.style.top = "0";
            target.id = targetId;
            elem.closest(".js-copy-text").appendChild(target);
        }
        target.textContent = elem.textContent;
    }

    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch (e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

window.scrollToError = function () {
    setTimeout(function () {
        let from_top, from_top_temp;
        $('.st-input1_error, .text-error').each(function () {
            from_top_temp = $(this).offset().top;
            if (!from_top || from_top > from_top_temp)
                from_top = from_top_temp;
        })
        if (from_top)
            $('html,body').stop().animate({scrollTop: (from_top - 100)}, 600);
    }, 200)
}

window.prepareFormData = function (form) {
    let formData = new FormData();
    for (let i in form) {
        if (form[i] instanceof Object && Object.keys(form[i]).length) {
            for (let j in form[i]) {
                formData.append(i + '[]', form[i][j]);
            }
        } else if (form[i] instanceof Date) {
            formData.append(i, formatDateInput(form[i]));
        } else {
            let val = form[i];
            if (val !== null && val !== undefined)
                formData.append(i, val);
        }
    }
    return formData;
}

window.getQueryString = function (url, data) {
    const getQueryArray = (obj, path = [], result = []) =>
        Object.entries(obj).reduce((acc, [k, v]) => {
            path.push(k);
            if (v && !(k == 'page' && v == 1)) { //убрать page=1 из запроса
                if (v instanceof Object) {
                    getQueryArray(v, path, acc);
                } else {
                    acc.push(`${path.map((n, i) => i ? `[${n}]` : n).join('')}=${v}`);
                }
            }
            path.pop();
            return acc;
        }, result);
    const getQueryString = obj => getQueryArray(obj).join('&');
    return getQueryString(data);
}
