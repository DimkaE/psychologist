const D = $(document)
D.ready(function ($) {
    $('.preloader').fadeOut();
    $('input[type=tel]').mask('+0 (000) 000-00-00', {
        translation: {
            'Z': {
                pattern: /[7-8]/,
                fallback: '7'
            }
        }
    });
    $('.input-mask-2').mask('00');
    $('.card_number').mask('0000 0000 0000 0000');
    $('.card_date').mask('00/00');
    $('.card_cvc').mask('000');

    $('.st-select').chosen();

    $('.b03__owl').owlCarousel({
        nav: false,
        navText: ["", ""],
        margin: 15,
        dots: false,
        items: 4,
        autoWidth: true,
        responsive: {
            0: {
                items: 1,
            },
            520: {
                items: 2
            },
            780: {
                items: 3
            },
            1040: {
                items: 4
            }
        }
    });

    $('.b03__owl2').owlCarousel({
        nav: false,
        navText: ["", ""],
        margin: 15,
        dots: false,
        items: 7,
        responsive: {
            0: {
                items: 1,
            },
            520: {
                items: 2
            },
            780: {
                items: 3
            },
            1040: {
                items: 7
            }
        }
    });

    let b05__owl = $('.b05__owl');
    b05__owl.owlCarousel({
        nav: true,
        navText: ["", ""],
        margin: 15,
        dots: false,
        items: 1,
    });
    $('.b05__prev').on('click', function () {
        b05__owl.trigger('prev.owl.carousel');
    });
    $('.b05__next').on('click', function () {
        b05__owl.trigger('next.owl.carousel');
    })

    D.on('click', '.dropdown__header', function () {
        let parent = $(this).closest('.dropdown');
        if (!parent.hasClass('dropdown_opened')) {
            $('.dropdown__body').hide()
            $('.dropdown').removeClass('dropdown_opened')
        }
        $(this).next('.dropdown__body').slideToggle();
        parent.toggleClass('dropdown_opened')
    });

    D.on('mouseup', function (e) {
        let div = $('.dropdown');
        if (!div.is(e.target)
            && div.has(e.target).length === 0) {
            div.find('.dropdown__body').hide();
            div.removeClass('dropdown_opened');
        }
    });

    $('.js-copy-text').on('click', function (e) {
        e.preventDefault();
        let object = $(this);
        let left = object[0].getBoundingClientRect().left,
            top = object[0].getBoundingClientRect().top + object[0].getBoundingClientRect().height / 2;
        e.preventDefault();
        copyToClipboard($(this).find('.js-text-to-copy')[0]);
        $('.copied-wrap').css({'left': left, 'top': top}).show();
        copyToClipboard($(this).find('.js-text-to-copy')[0]);
        $('.copied-wrap').fadeIn();
        setTimeout(function () {
            $('.copied-wrap').fadeOut()
        }, 2000);
    });
});

jQuery(function ($) {
    $('[data-link]').on('click', function (e) {
        e.preventDefault();
        let n_id = $(this).attr('data-link');
        if ($(n_id).length > 0) {
            let from_top = $(n_id).offset().top;
            $('html,body').stop().animate({scrollTop: from_top}, 1200);
            if ($('.menu-burger').is(':visible')) $(".menu-wrap").slideUp();
        } else {
            window.location = $(this).attr('href');
        }
    });

    D.scroll(function () {
        let currentScrollTop = jQuery(document).scrollTop();
        $('[data-light-title]').each(function () {
            let n_id = $(this).attr('data-light-title'),
                link = $(this);
            if ($(n_id).length > 0) {
                let from_top = $(n_id)[0].offsetTop,
                    height = $(n_id)[0].offsetHeight;
                if (currentScrollTop > from_top && currentScrollTop < from_top + height) {
                    link.addClass('light-title_current')
                } else {
                    link.removeClass('light-title_current')
                }
            }
        })
    });

    $('.question__head').on('click', function () {
        let parent = $(this).closest('.question');
        if (!parent.hasClass('question_opened')) {
            $('.question__body').slideUp();
            $('.question').removeClass('question_opened')
        }
        $(this).next('.question__body').slideToggle();
        parent.toggleClass('question_opened')
    })

    $('.checkbox_group input').on('change', function () {
        $(this).closest('.checkbox_group').find('.st-input1__error-msg').remove();
    });

    $('.b03__item').tabs();
    $('.b03__pill').on('click', function () {
        $(this).toggleClass('b03__pill_active')
    });

    $('.menu-burger').on('click', function () {
        $('body').addClass('fixed_body');
        $('.body-shadow').addClass('body-shadow_opened');
        setTimeout(function () {
            $('.menu-wrap').addClass('menu-wrap_opened');
        }, 1)
    });

    $('.menu-close').on('click', function () {
        closeMenu();
    });

    $(document).mouseup(function (e) {
        if ($('.menu-burger').is(':visible')) {
            let div = $('.menu-wrap');
            if (!div.is(e.target)
                && div.has(e.target).length === 0
                && !$('.menu-burger').is(e.target)
                && $('.menu-burger').has(e.target).length === 0
            ) {
                closeMenu();
            }
        }
    });

    function closeMenu() {
        $('.menu-wrap').removeClass('menu-wrap_opened');
        setTimeout(function () {
            $('.body-shadow').removeClass('body-shadow_opened');
        }, 200)
        $('body').removeClass('fixed_body');
    }

    let page = 1;
    $('.js-blog-load-more').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/blog_more',
            type: 'get',
            data: {page: page},
            success: function (msg) {
                if (msg) {
                    console.log(msg);
                    page++;
                    $('.blog__container').append(msg);
                } else {
                    $('.js-blog-load-more').fadeOut();
                }
            },
        });
    })

});

window.Fancybox.Fancybox.bind("[data-fancybox]", {
    dragToClose: false
});

