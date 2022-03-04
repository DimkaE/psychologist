@include('front.common.start')
<div class="b01">
    @include('front.common.header_work')
    <div class="b01__wrap">
        <div class="container">
            <div class="flex flex-v-center">
                <div class="col8 col12-550">
                    <div class="b01__inner">
                        <h1 class="fz58 fw800 lh12 mb30">Работа мечты <br>
                            для опытного психолога</h1>
                        <p class="fz18 lh16 mb30 color-dark lh17">Частная практика без лишних забот. Присоединяйся к
                            сообществу
                            психологов Инсайт, чтобы работать где и когда удобно</p>
                        <a href="{{ route('psychologists.register') }}" class="btn">Сотрудничать</a>
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

<div class="wr-b02" id="b02">
    <div class="container-wide">
        <div class="white-bg">
            <div class="container">
                <p class="text-center fz45 fw800 lh12 mb20 text-shadow">Мы ждём <span class="text-underline">настоящих
                        профессионалов</span></p>
                <p class="fz22 lh17 text-center mb30">Для сотрудничества вам понадобятся:</p>
                <div class="flex flex-wrap flex-center">
                    <div class="col4 mb40 text-center col6-768 col12-550">
                        <img class="mb10" src="{{ url('front/img/wr_b01_1.webp') }}" alt="">
                        <p class="fz20 fw600 mb10">Опыт</p>
                        <p class="fz17 fw300 lh15 color-dark">Профессиональная деятельность в психологическом
                            консультировании от 3-х лет</p>
                    </div>
                    <div class="col4 mb40 text-center col6-768 col12-550">
                        <img class="mb10" src="{{ url('front/img/wr_b01_2.webp') }}" alt="">
                        <p class="fz20 fw600 mb10">Образование</p>
                        <p class="fz17 fw300 lh15 color-dark">Высшее психологическое образование: специалист,
                            бакалавр,
                            магистр или переподготовка от 2-х лет</p>
                    </div>
                    <div class="col4 mb40 text-center col6-768 col12-550">
                        <img class="mb10" src="{{ url('front/img/wr_b01_3.webp') }}" alt="">
                        <p class="fz20 fw600 mb10">Сертификация</p>
                        <p class="fz17 fw300 lh15 color-dark">Сертификат, подтверждающий квалификацию психотерапевта
                            в рабочем подходе</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wr-b03">
    <div class="container" id="b03">
        <p class="text-center fz45 fw800 lh12 mb60">Работайте <span class="text-underline">без лишних забот</span>
        </p>
        <div class="flex flex-wrap-768 mb100 flex-center">
            <div class="col4 col6-768 col12-550 text-center mb20">
                <svg class="wr-b03__img1 block">
                    <use xlink:href="#wr-b03_img1"></use>
                </svg>
                <p class="fz20 lh15"><span class="fw600">Не нужно заниматься рекламой</span>.<br>
                    Мы обеспечим вас клиентами</p>
            </div>
            <div class="col4 col6-768 col12-550 text-center mb20">
                <svg class="wr-b03__img1 block">
                    <use xlink:href="#wr-b03_img2"></use>
                </svg>
                <p class="fz20 lh15"><span class="fw600">Работайте удалённо</span>, кабинет вам больше не нужен</p>
            </div>
            <div class="col4 col6-768 col12-550 text-center mb20">
                <svg class="wr-b03__img1 block">
                    <use xlink:href="#wr-b03_img3"></use>
                </svg>
                <p class="fz20 lh15">Больше никаких <span class="fw600">внезапных
                        отмен и переносов</span></p>
            </div>
        </div>

    </div>
    <div class="container-small">
        <div class="white-bg">
            <p class="text-center fz45 fw800 lh12 mb50">Как начать сотрудничество</p>
            <div class="wr-b03__step text-center mb50">
                <div class="wr-b03__number">
                    <div class="wr-b03__number-in">
                        01
                    </div>
                </div>
                <div class="wr-b03__text">
                    <p class="fz26 lh15 fw600">Заполните анкету</p>
                    <p class="fz17 lh16">После отправки анкеты мы свяжемся с вами<br class="hide-550"> в WhatsApp
                        или Telegram</p>
                </div>
            </div>
            <div class="wr-b03__step text-center mb50">
                <div class="wr-b03__number">
                    <div class="wr-b03__number-in">
                        02
                    </div>
                </div>
                <div class="wr-b03__text">
                    <p class="fz26 lh15 fw600">Пройдите интервью</p>
                    <p class="fz17 lh16">Интервью длится 30 минут и проходит по Skype<br class="hide-550"> в удобное
                        для вас время</p>
                </div>
            </div>
            <div class="wr-b03__step text-center mb60">
                <div class="wr-b03__number">
                    <div class="wr-b03__number-in">
                        03
                    </div>
                </div>
                <div class="wr-b03__text">
                    <p class="fz26 lh15 fw600">Платформа</p>
                    <p class="fz17 lh16">Расскажем о правилах работы сервиса и назначим<br class="hide-550"> первых
                        клиентов</p>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('psychologists.register') }}" class="btn btn_with-line">Сотрудничать</a>
            </div>
        </div>
    </div>
    <div class="b05" id="b04">
        <div class="container-med">
            <p class="text-center fz45 fw800 lh12">Психологи о работе в Инсайт</p>
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
</div>
<div>
    <div class="container-wide" id="b05">
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
                        <a href="tg://resolve?domain={{ get_config('telegram') }}" target="_blank" class="socials__link2">
                            <svg>
                                <use xlink:href="#ico-telegram"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="col0 flex-none mb10">
                        <a href="https://wa.me/{{ get_config('whatsapp') }}" target="_blank" class="socials__link3">
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


<div class="wr-b07">
    <div class="container">
        <div class="wr-b07__in">
            <p class="text-center fz45 fw800 lh12 mb20">Порекомендуйте <br class="hide-768">
                психолога для  Helpi </p>
            <p class="fz22 mb40 text-center">Может, вы знаете того, кто нам подходит?</p>
            <div class="text-center">
                <a href="#" data-fancybox data-src="#modal-share" class="btn">Рекомендовать</a>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-share" id="modal-share" style="display: none">
    <p class="fz34 fw800 mb10">Рекомендовать сервис</p>
    <p class="fz19 mb20 lh15">Если у вас есть знаковый практикующий психолог, можете пригласить его к нам, чтобы
        работа стала еще комфортнее, а заработок стабильнее</p>
    <div class="flex flex_5 flex-wrap-550">
        <div class="col0 col_5 mb10 col12-550">
            <a href="#" class="modal-share__link flex1 flex-v-center js-copy-text">
                <svg width="1rem" height="1rem" class="mr5">
                    <use xlink:href="#ico-link"></use>
                </svg>
                <span class="fz16 fw800 ttu color-green">Скопировать ссылку</span>
                <span class="js-text-to-copy hidden">{{ route('work') }}</span>
            </a>
        </div>
        <div class="col0 col_5 mb10">
            <a href="https://vk.com/share.php?url={{ route('work') }}" class="modal-share__soc-link modal-share__soc-link1"
               rel="nofollow noopener" target="_blank" title="ВКонтакте">
                <svg width="1.5rem" height="1.5rem" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1243_828)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.40728 6.31567H1.12528C0.187556 6.31567 0 6.74605 0 7.22048C0 8.06797 1.11268 12.271 5.18081 17.8299C7.8929 21.6262 11.714 23.6841 15.1911 23.6841C17.2773 23.6841 17.5354 23.227 17.5354 22.4398V19.5705C17.5354 18.6564 17.733 18.4739 18.3936 18.4739C18.8804 18.4739 19.7149 18.7112 21.6621 20.5416C23.8874 22.7109 24.2542 23.6841 25.5059 23.6841H28.7879C29.7257 23.6841 30.1945 23.227 29.924 22.3251C29.6281 21.4261 28.5656 20.1217 27.1558 18.5757C26.3908 17.6944 25.2434 16.7453 24.8957 16.2707C24.4089 15.6606 24.548 15.3894 24.8957 14.8471C24.8957 14.8471 28.8943 9.35597 29.3116 7.49179C29.5202 6.81378 29.3116 6.31567 28.319 6.31567H25.037C24.2026 6.31567 23.8178 6.74605 23.6091 7.22048C23.6091 7.22048 21.9402 11.1863 19.5758 13.7624C18.8108 14.5081 18.4631 14.7454 18.0458 14.7454C17.8372 14.7454 17.5353 14.5081 17.5353 13.8303V7.49179C17.5353 6.67822 17.2931 6.31567 16.5976 6.31567H11.4401C10.9187 6.31567 10.605 6.69321 10.605 7.05109C10.605 7.82225 11.7872 8.00014 11.9091 10.1695V14.881C11.9091 15.914 11.7176 16.1013 11.3004 16.1013C10.1878 16.1013 7.48134 12.1177 5.87615 7.55953C5.56162 6.67356 5.24606 6.31567 4.40728 6.31567Z" fill="#2787F5"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1243_828">
                            <rect width="30" height="30" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>

            </a>
        </div>
        <div class="col0 col_5 mb10">
            <a href="https://t.me/share/url?url={{ route('work') }}" class="modal-share__soc-link modal-share__soc-link2"
               rel="nofollow noopener" target="_blank" title="ВКонтакте">
                <svg width="1.4rem" height="1.4rem" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1243_823)">
                        <path d="M0.492039 13.5738L6.91088 15.9695L9.39537 23.9596C9.55434 24.4713 10.1801 24.6605 10.5955 24.3209L14.1734 21.4041C14.5485 21.0985 15.0827 21.0833 15.4746 21.3678L21.928 26.0531C22.3723 26.376 23.0018 26.1326 23.1133 25.5957L27.8407 2.85578C27.9623 2.26929 27.3861 1.78003 26.8276 1.99601L0.484518 12.1584C-0.165575 12.4091 -0.159911 13.3295 0.492039 13.5738ZM8.99497 14.6942L21.5398 6.96786C21.7652 6.82941 21.9972 7.13426 21.8036 7.31385L11.4505 16.9376C11.0866 17.2763 10.8518 17.7296 10.7853 18.2217L10.4327 20.8352C10.386 21.1842 9.89578 21.2188 9.79948 20.8811L8.44312 16.1152C8.28777 15.5716 8.51416 14.991 8.99497 14.6942Z" fill="#2AAFFA"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1243_823">
                            <rect width="27.8571" height="27.8571" fill="white" transform="translate(0 0.142883)"/>
                        </clipPath>
                    </defs>
                </svg>


            </a>
        </div>
        <div class="col0 col_5 mb10">
            <a href="https://wa.me/?text={{ route('work') }}" class="modal-share__soc-link modal-share__soc-link3"
               rel="nofollow noopener" target="_blank" title="ВКонтакте">
                <svg width="1.5rem" height="1.5rem" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1243_817)">
                        <path d="M14.2685 0.0175935C6.34556 0.39484 0.0932213 6.99314 0.117257 14.9251C0.124575 17.3409 0.707807 19.6212 1.73666 21.636L0.157004 29.3038C0.0715536 29.7186 0.445643 30.0818 0.857687 29.9842L8.37126 28.2041C10.3016 29.1657 12.4698 29.7211 14.7645 29.7561C22.8625 29.8798 29.6149 23.4497 29.8673 15.3547C30.1378 6.67738 22.9762 -0.397105 14.2685 0.0175935ZM23.2338 23.1169C21.0334 25.3174 18.1078 26.5292 14.996 26.5292C13.1739 26.5292 11.4294 26.1204 9.81087 25.3141L8.76451 24.7929L4.15791 25.8843L5.12758 21.1772L4.61207 20.1677C3.77184 18.5222 3.34581 16.7428 3.34581 14.879C3.34581 11.7671 4.55762 8.84156 6.75803 6.64107C8.93878 4.46032 11.9121 3.22878 14.9962 3.22878C18.108 3.22885 21.0335 4.44066 23.2339 6.641C25.4343 8.84142 26.6461 11.767 26.6462 14.8788C26.6461 17.9629 25.4146 20.9363 23.2338 23.1169Z" fill="#67DA56"/>
                        <path d="M22.2176 18.1055L19.3356 17.278C18.9567 17.1692 18.5487 17.2767 18.2726 17.558L17.5678 18.2761C17.2707 18.5788 16.8197 18.6761 16.4264 18.517C15.0631 17.9653 12.1952 15.4154 11.4628 14.1399C11.2515 13.772 11.2864 13.312 11.5459 12.9763L12.1612 12.1803C12.4022 11.8684 12.4531 11.4495 12.2937 11.089L11.0812 8.3466C10.7907 7.68975 9.95136 7.49855 9.403 7.96232C8.59864 8.64263 7.64426 9.67643 7.52824 10.8217C7.32369 12.841 8.18968 15.3864 11.4644 18.4429C15.2477 21.9739 18.2773 22.4404 20.2498 21.9626C21.3686 21.6916 22.2628 20.6052 22.827 19.7157C23.2118 19.1092 22.908 18.3038 22.2176 18.1055Z" fill="#67DA56"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1243_817">
                            <rect width="30" height="30" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>

            </a>
        </div>
    </div>
</div>
@include('front.common.footer')

@include('front.common.end')
