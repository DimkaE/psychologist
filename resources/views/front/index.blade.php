@extends('front.layouts.primary')

@section('content')
    <div class="b01">
        @include('front.common.header')
        <div class="b01__wrap">
            <div class="container">
                <div class="flex flex-v-center">
                    <div class="col8 col12-550">
                        <div class="b01__inner">
                            <h1 class="fz58 fw800 lh12 mb30">Видеоконсультации <br>
                                с психотерапевтом онлайн</h1>
                            <p class="fz18 lh16 mb30 color-dark">Два первых занятия по цене одного
                                за {{ get_config('first_price') + get_config('second_price') }} ₽ вместо
                                {{ get_config('price') }}
                                ₽</p>
                            <div class="flex flex-v-center flex-wrap-768">
                                <div class="col0 b01__btn1 col12-768">
                                    <a href="{{ route('search') }}" class="btn">Посмотреть психологов</a>
                                </div>
                                <div class="col0 col12-768">
                                    <p class="fz17 lh15 color-dark">занятие длится 50 минут,<br>
                                        <span class="fw600">первое — бесплатное</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col0 hide-550">
                        <div>
                            <img class="b01__img1" src="{{ url('front/img/hp_b01_img.webp') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b02">
        <div class="container">
            <p class="text-center fz45 fw800 lh12 mb30 text-shadow">Психотерапия помогает <br class="hide-550">
                и сильно повышает качество жизни</p>
            <div class="flex flex-wrap">
                <div class="col4 mb40 text-center col6-768 col12-550">
                    <img class="mb10" src="{{ url('front/img/hp_b01_1.webp') }}" alt="">
                    <p class="fz20 fw600 mb10">Наладить отношения</p>
                    <p class="fz17 fw300 lh15 color-dark">С партнером, семьей, друзьями<br> и коллегами</p>
                </div>
                <div class="col4 mb40 text-center col6-768 col12-550">
                    <img class="mb10" src="{{ url('front/img/hp_b01_2.webp') }}" alt="">
                    <p class="fz20 fw600 mb10">Найти себя</p>
                    <p class="fz17 fw300 lh15 color-dark">Чтобы понимать и воплощать<br> свои желания</p>
                </div>
                <div class="col4 mb40 text-center col6-768 col12-550">
                    <img class="mb10" src="{{ url('front/img/hp_b01_3.webp') }}" alt="">
                    <p class="fz20 fw600 mb10">Справиться с тревогой</p>
                    <p class="fz17 fw300 lh15 color-dark">С партнером, семьей, друзьями <br> и коллегами</p>
                </div>
                <div class="col4 mb40 text-center col6-768 col12-550">
                    <img class="mb10" src="{{ url('front/img/hp_b01_4.webp') }}" alt="">
                    <p class="fz20 fw600 mb10">Разобраться с планами</p>
                    <p class="fz17 fw300 lh15 color-dark">Чтобы работа была продуктивной,<br> а состояние —
                        комфортным
                    </p>
                </div>
                <div class="col4 mb40 text-center col6-768 col12-550">
                    <img class="mb10" src="{{ url('front/img/hp_b01_5.webp') }}" alt="">
                    <p class="fz20 fw600 mb10">Справиться с выгоранием</p>
                    <p class="fz17 fw300 lh15 color-dark">Научиться находить мотивацию<br> и добиваться целей</p>
                </div>
                <div class="col4 mb40 text-center col6-768 col12-550">
                    <img class="mb10" src="{{ url('front/img/hp_b01_6.webp') }}" alt="">
                    <p class="fz20 fw600 mb10">И со многим другим</p>
                    <p class="fz17 fw300 lh15 color-dark">Что вызывает непонятные эмоции<br> и мешает наслаждаться
                        жизнью
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="b03" id="b01">
        <div class="container-wide">
            <div class="white-bg">
                <div class="container">
                    <p class="text-center fz45 fw800 lh12 mb60">Мы строго отбираем терапевтов <br class="hide-768">
                        и работаем <span class="text-underline">только с самыми опытными</span></p>
                    <div class="flex flex-v-center flex-wrap-550">
                        <div class="col7 col5-768 col12-550">
                            <img class="block" src="{{ url('front/img/hp_b03.webp') }}" alt="">
                        </div>
                        <div class="col5 col7-768 col12-550">
                            <div class="mb20 flex1">
                                <p class="font-caveat fw700 fz27 color-gray mr10 b03__number">01.</p>
                                <div>
                                    <p class="fz26 fw600 lh15">Образование</p>
                                    <p class="fz17 lh15 color-dark">На рынке много недоучек. Мы их отсеиваем</p>
                                </div>
                            </div>
                            <div class="mb20 flex1">
                                <p class="font-caveat fw700 fz27 color-gray mr10 b03__number">02.</p>
                                <div>
                                    <p class="fz26 fw600 lh15">Опыт работы</p>
                                    <p class="fz17 lh15 color-dark">От трех лет. За это время накапливается хороший
                                        практический опыт</p>
                                </div>
                            </div>
                            <div class="mb20 flex1">
                                <p class="font-caveat fw700 fz27 color-gray mr10 b03__number">03.</p>
                                <div>
                                    <p class="fz26 fw600 lh15">Собеседование</p>
                                    <p class="fz17 lh15 color-dark">Проверяем самое важное: навыки и успешные кейсы
                                        из
                                        практики</p>
                                </div>
                            </div>
                            <div class="mb20 flex1">
                                <p class="font-caveat fw700 fz27 color-gray mr10 b03__number">04.</p>
                                <div>
                                    <p class="fz26 fw600 lh15">Обучение</p>
                                    <p class="fz17 lh15 color-dark">И мастерам важно учиться. Развиваем через
                                        семинары и
                                        супервизии</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('search') }}" class="btn">Посмотреть психологов</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b04" id="b02">
        <div class="container">
            <p class="text-center fz45 fw800 lh12 mb60">Сервис устроен легко и удобно. <br>
                Это не наши слова — <span class="text-underline">так считают пользователи</span></p>
            <div class="flex flex-v-center flex-wrap-550">
                <div class="col5 col12-550">
                    <img class="block" src="{{ url('front/img/hp_b04_1.webp') }}" alt="">
                </div>
                <div class="col7 col12-550">
                    <p class="fz30 lh14 fw600 mb10">Консультации по безопасному видеочату</p>
                    <p class="fz18 lh16 b04__txt1 color-dark">На нашей платформе видеоконсультации проходят в
                        защищенном
                        личном
                        кабинете. Конфиденциальные сессии с вашим психотерапевтом доступны из любой точки мира</p>
                </div>

            </div>
            <div class="flex flex-v-center b04__line1 flex-wrap-550">
                <div class="col6 col12-550">
                    <p class="fz30 lh14 fw600 mb10">Простое управление расписанием</p>
                    <p class="fz18 lh16 b04__txt1 color-dark">Назначайте и переносите ваши встречи со специалистом,
                        а мы напомним и не дадим вам забыть</p>
                </div>
                <div class="col6 first-550 col12-550">
                    <img class="block" src="{{ url('front/img/hp_b04_2.webp') }}" alt="">
                </div>
            </div>
            <div class="flex flex-v-center b04__line1 flex-wrap-550">
                <div class="col5 col12-550">
                    <img class="block" src="{{ url('front/img/hp_b04_3.webp') }}" alt="">
                </div>
                <div class="col7 col12-550">
                    <p class="fz30 lh14 fw600 mb10">Сопровождение на всех этапах</p>
                    <p class="fz18 lh16 b04__txt1 color-dark">Ответим на вопросы о психотерапии, поможем, поддержим,
                        объясним,
                        направим</p>
                </div>
            </div>
            <div class="flex flex-v-center b04__line1 flex-wrap-550">
                <div class="col6 col12-550">
                    <p class="fz30 lh14 fw600 mb10">Сессии длинной до 50 минут</p>
                    <p class="fz18 lh16 b04__txt1 color-dark">Назначайте и переносите ваши встречи со специалистом,
                        а мы напомним и не дадим вам забыть</p>
                </div>
                <div class="col6 first-550 col12-550">
                    <img class="block" src="{{ url('front/img/hp_b04_4.webp') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="b05_06-wrap">
        <div class="b03" id="b03">
            <div class="container-wide">
                <div class="white-bg white-bg_owl">
                    <div class="container">
                        <p class="text-center fz45 fw800 lh12 mb60">Подберем психотерапевта, <br>
                            с которым <span class="text-underline">вам будет комфортно</span></p>
                        <div class="flex b03__tabs mb40 flex-wrap-550">
                            <div class="col4 col12-550 mb20">
                                <div class="b03__item relative" data-href="#b03__tab1">
                                    <p class="b03__txt1 color-gray fz26 font-caveat">Первый шаг</p>
                                    <p class="fz22 fw600 lh15 mb5">Заполните анкету</p>
                                    <p class="fz15 lh17 color-dark">Расскажите, что вас беспокоит и что важно в
                                        психологе</p>
                                </div>
                            </div>
                            <div class="col4 col12-550 mb20">
                                <div class="b03__item relative" data-href="#b03__tab2">
                                    <p class="b03__txt1 color-gray fz26 font-caveat">Второй</p>
                                    <p class="fz22 fw600 lh15 mb5">Выберите психолога</p>
                                    <p class="fz15 lh17 color-dark">Предложим подходящих специалистов и поможем,
                                        если
                                        будет
                                        сложно
                                        определиться</p>
                                </div>
                            </div>
                            <div class="col4 col12-550 mb20">
                                <div class="b03__item relative" data-href="#b03__tab3">
                                    <p class="b03__txt1 color-gray fz26 font-caveat">Последний шаг</p>
                                    <p class="fz22 fw600 lh15 mb5">Начните общение</p>
                                    <p class="fz15 lh17 color-dark">Пришлём информацию для подготовки и напомним о
                                        предстоящем
                                        занятии</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb60">
                        <div id="b03__tab1">
                            <div class="mb15">
                                <div class="b03__owl owl-carousel">
                                    @foreach($directions as $direction)
                                        <div>
                                            <div class="b03__pill">{{ $direction->name }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="b03__owl owl-carousel">
                                @foreach($directions2 as $direction)
                                    <div>
                                        <div class="b03__pill">{{ $direction->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="b03__tab2">
                            <div class="b03__owl2 owl-carousel">
                                @foreach($avatars as $avatar)
                                    <a href="{{ route('search') }}" class="block">
                                        <img src="{{ $avatar }}" alt="" class="b03__img-rnd">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div id="b03__tab3">
                            <div class="container">
                                <div class="b03__message">
                                    <div class="flex">
                                        <div class="col0 b03__message-col1 flex-none relative">
                                            <div class="b03__notification">
                                                <svg width="1.05rem" height="1.05rem" viewBox="0 0 21 21"
                                                     fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8.71778 16.8244C9.15521 16.7319 11.8206 16.7319 12.258 16.8244C12.632 16.9108 13.0364 17.1126 13.0364 17.5532C13.0146 17.9727 12.7685 18.3446 12.4285 18.5808C11.9876 18.9245 11.4702 19.1422 10.9293 19.2206C10.6301 19.2594 10.3362 19.2602 10.0474 19.2206C9.50567 19.1422 8.98824 18.9245 8.54821 18.5799C8.20731 18.3446 7.96121 17.9727 7.93947 17.5532C7.93947 17.1126 8.34384 16.9108 8.71778 16.8244ZM10.5396 1.75C12.3597 1.75 14.219 2.61364 15.3234 4.04658C16.04 4.96927 16.3687 5.89107 16.3687 7.32401V7.69679C16.3687 8.79573 16.6592 9.44346 17.2983 10.1899C17.7827 10.7398 17.9375 11.4457 17.9375 12.2115C17.9375 12.9765 17.6862 13.7026 17.1827 14.2922C16.5235 14.999 15.5939 15.4502 14.6451 15.5286C13.2702 15.6458 11.8945 15.7445 10.5004 15.7445C9.10555 15.7445 7.73067 15.6855 6.35578 15.5286C5.40615 15.4502 4.47652 14.999 3.81821 14.2922C3.31469 13.7026 3.0625 12.9765 3.0625 12.2115C3.0625 11.4457 3.21816 10.7398 3.70168 10.1899C4.36086 9.44346 4.63218 8.79573 4.63218 7.69679V7.32401C4.63218 5.8523 4.99916 4.88995 5.75487 3.94788C6.87843 2.57398 8.67943 1.75 10.4613 1.75H10.5396Z"
                                                        fill="white"/>
                                                </svg>

                                            </div>
                                            <img src="{{ url('front/img/ava_115_115.png') }}"
                                                 class="block b03__message-ava" alt="">
                                        </div>
                                        <div class="col0">
                                            <div class="flex1 mb10 flex-v-center">
                                                <svg class="mr10 b03__message-svg" id="#ico-logo-small"
                                                     viewBox="0 0 24 25"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.2006 1C10.3782 4.93399 5.07899 10.2279 4.09805 15.1845C3.21683 19.6372 9.3177 19.2928 11.8777 18.6147C15.0133 17.7842 19.4397 15.1315 18.9014 11.2907C18.3339 7.24137 12.2277 6.75929 9.60994 8.91119C3.7647 13.7163 8.77481 24.3906 15.5628 17.1005C23.8219 8.23046 4.30722 6.58176 5.07444 14.721C5.49178 19.1485 12.1859 19.2779 15.0588 17.7804C20.7685 14.8043 10.7466 12.7206 9.16899 13.1758C8.50913 13.3662 7.78181 14.3071 8.09811 14.9064C9.31688 17.2155 13.7682 16.9413 15.4683 16.3897C21.0643 14.5743 20.7907 8.31292 15.1218 7.21152C9.20202 6.06136 6.00125 13.4691 12.2872 14.2265C13.5621 14.3801 15.9413 13.4859 15.0274 11.6925C13.3157 8.3336 6.12078 9.08227 3.31063 9.83828C-0.137619 10.7659 0.601896 12.8882 3.37362 14.1956C7.8224 16.2941 13.7201 16.6795 18.429 15.2154C28.6679 12.0318 19.4521 -0.50607 12.6966 9.28202C9.69928 13.6249 7.73397 18.9176 6.27131 23.9301C6.14013 24.3796 6.25041 22.6775 8.65366 18.3629C11.2505 13.7008 11.795 15.9142 13.0746 10.7654C15.3139 1.75418 7.98322 7.60881 5.32641 10.9508C0.541081 16.9702 9.32475 18.7156 13.8935 18.8002C16.4418 18.8473 15.8183 15.2858 14.3974 14.9373C13.3992 14.6924 14.5395 16.9689 14.8384 17.9349C15.1806 19.041 15.8418 21.3375 17.0116 21.9832C18.0748 22.5699 16.7859 19.5191 16.1612 18.4911C12.6667 12.7409 7.12911 10.3525 1.86179 6.56255"
                                                        stroke="#6ABE5C" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"/>
                                                </svg>
                                                <p class="fz18 fw600 mr10">Helpi</p>
                                                <p class="fz16 color-gray2">5 минут назад</p>
                                            </div>
                                            <p class="fz24 fw600 mb5">Вы готовы? Скоро начинаем :)</p>
                                            <p class="fz18 color-gray3 lh15">Мы выслали вам короткую инструкцию —
                                                ознакомьтесь,
                                                и мы сможем приступить</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('search') }}" class="btn">Подобрать бесплатно</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="b05" id="b04">
            <div class="container-med">
                <p class="text-center fz45 fw800 lh12">Мы уже помогли <span class="text-underline">15000
                        клиентов</span>,<br>
                    и вот что говорят об «Инсайт» они сами</p>
                <div class="b05__owl owl-carousel">
                    @foreach($reviews as $review)
                        <div class="b05__item">
                            <div class="flex flex-v-center flex-wrap-550">
                                <div class="col4 col10-550 b05__photo">
                                    <div class="relative b05__wrap">
                                        <img class="b05__img1 block" src="{{ $review->thumb1 }}"
                                             alt="">
                                        <svg class="b05__svg1">
                                            <use xlink:href="#b05__svg1"></use>
                                        </svg>
                                        <svg class="b05__svg2">
                                            <use xlink:href="#b05__svg2"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div class="col8 b05__right col12-550">
                                    <div class="mb30">
                                        <p class="fz22 lh16 mb20">{{ $review->text }}</p>
                                        <p class="fz20 fw600 mb5">{{ $review->name }}</p>
                                        <p class="fz16 color-dark">{{ $review->description }}</p>
                                    </div>
                                    <div class="flex1 flex-v-center">
                                        <div class="b05__prev mr5">
                                            <svg width="1.05rem" height=".8rem">
                                                <use xlink:href="#ico-left"></use>
                                            </svg>
                                        </div>
                                        <div class="b05__next">
                                            <svg width="3rem" height=".8rem">
                                                <use xlink:href="#ico-right"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="b06">
            <div class="container">
                <p class="text-center fz45 fw800 lh12 mb40">А еще о нас пишут популярные издания:</p>
                <div class="flex flex-justify flex-wrap-768">
                    <div class="col0 mb20 text-center">
                        <img src="{{ url('front/img/b06_im1.png') }}" alt="">
                    </div>
                    <div class="col0 mb20 text-center">
                        <img src="{{ url('front/img/b06_im2.png') }}" alt="">
                    </div>
                    <div class="col0 mb20 text-center">
                        <img src="{{ url('front/img/b06_im3.png') }}" alt="">
                    </div>
                    <div class="col0 mb20 text-center">
                        <img src="{{ url('front/img/b06_im4.png') }}" alt="">
                    </div>
                    <div class="col0 mb20 text-center">
                        <img src="{{ url('front/img/b06_im5.png') }}" alt="">
                    </div>
                    <div class="col0 mb20 text-center">
                        <img src="{{ url('front/img/b06_im6.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div id="b05">
            <div class="container-wide">
                <div class="white-bg">
                    <div class="container-small">
                        <p class="text-center fz45 fw800 lh12 mb40">Ответы на самые частые вопросы</p>
                        @foreach($questions as $question)
                            <div class="question mb25">
                                <div class="question__head">
                                    <div class="flex flex-v-center">
                                        <div class="col0 flex-full">
                                            <p class="fz22 fw600">{{ $question->question }}</p>
                                        </div>
                                        <div class="col0 flex-none">
                                            <div class="question__plus">+</div>
                                            <div class="question__minus">-</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="question__body">
                                    <p class="fz17 lh15 color-dark">{{ $question->answer }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex flex-v-center flex-center socials socials_hp flex-wrap-768">
                            <div class="col0 col12-768 text-center mb10">
                                <p class="fz22">Если у вас остались вопросы, напишите нам:</p>
                            </div>
                            <div class="col0 flex-none mb10">
                                <a href="{{ get_config('vk_link') }}" target="_blank" class="socials__link1">
                                    <svg>
                                        <use xlink:href="#ico-vk"></use>
                                    </svg>
                                </a>
                            </div>
                            <div class="col0 flex-none mb10">
                                <a href="tg://resolve?domain={{ get_config('telegram') }}" target="_blank"
                                   class="socials__link2">
                                    <svg>
                                        <use xlink:href="#ico-telegram"></use>
                                    </svg>
                                </a>
                            </div>
                            <div class="col0 flex-none mb10">
                                <a href="https://wa.me/{{ get_config('whatsapp') }}" target="_blank"
                                   class="socials__link3">
                                    <svg>
                                        <use xlink:href="#ico-whatsapp"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="b07">
        <div class="container">
            <img class="b07__img1 block" src="{{ url('front/img/b07_img.webp') }}" alt="">
            <p class="text-center fz45 fw800 lh12 mb40">81% наших клиентов чувствуют результат <br class="hide-768">
                уже после <br class="show-768"><span class="text-underline">пятой сессии</span></p>
            <p class="fz22 mb40 text-center">Начните путь к лучшему себе уже сейчас, скажите спасибо себе завтра</p>
            <div class="text-center">
                <a href="{{ route('search') }}" class="btn">Посмотреть профили психологов</a>
            </div>
        </div>
    </div>

    @include('front.common.footer')

@endsection
