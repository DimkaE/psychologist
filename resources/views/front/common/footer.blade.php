<div class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="flex flex-wrap-768">
                <div class="col6 footer__col1">
                    <p class="fz32 fw600 mb10">Helpi</p>
                    <p class="fz12 fw500 color-gray4 lh15 mb10">{!! get_config('powered') !!}</p>
                    <div class="mb10">
                        <a class="fz12 fw500 link link-gray lh15" data-fancybox data-src="#modal-policy">Политика
                            обработки персональных данных</a>
                    </div>
                    <p class="fz12 fw500 color-gray4 lh15">© 2017 – {{ date('Y') }} {{ config('app.name') }}</p>
                </div>

                <div class="col2 col6-768">
                    <ul>
                        <li class="mb20">
                            <a href="{{ route('home') }}#b01" class="link link-dark5 fz17 fw500" data-link="#b01">Терапевты</a>
                        </li>
                        <li class="mb20">
                            <a href="{{ route('home') }}#b02" class="link link-dark5 fz17 fw500" data-link="#b02">О
                                сервисе</a>
                        </li>
                        <li class="mb20">
                            <a href="{{ route('home') }}#b03" class="link link-dark5 fz17 fw500" data-link="#b03">Как
                                работает</a>
                        </li>
                        <li class="mb20">
                            <a href="{{ route('home') }}#b04" class="link link-dark5 fz17 fw500"
                               data-link="#b04">Отзывы</a>
                        </li>
                        <li class="mb20">
                            <a href="{{ route('home') }}#b05" class="link link-dark5 fz17 fw500" data-link="#b05">Частые
                                вопросы</a>
                        </li>
                        <li class="mb20">
                            <a href="{{ route('work') }}" class="link link-dark5 fz17 fw500">Сотрудничать с нами</a>
                        </li>
                    </ul>
                </div>
                <div class="col3 col6-768">
                    <p class="fz17 fw500 color-gray5 mb15">Мы всегда на связи:</p>
                    <p class="mb15">
                        <a class="fz17 fw500 link link-green"
                           href="mailto:{{ get_config('email') }}">{{ get_config('email') }}</a>
                    </p>
                    <div class="flex flex-v-center socials">
                        <div class="col0 flex-none">
                            <a href="{{ get_config('vk_link') }}" target="_blank" class="socials__link1">
                                <svg>
                                    <use xlink:href="#ico-vk"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="col0 flex-none">
                            <a href="tg://resolve?domain={{ get_config('telegram') }}" target="_blank"
                               class="socials__link2">
                                <svg>
                                    <use xlink:href="#ico-telegram"></use>
                                </svg>
                            </a>
                        </div>
                        <div class="col0 flex-none">
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
</div>
<div class="modal" id="modal-policy" style="display: none">
    <div>
        <p class="fz12 lh12">{!! nl2br(get_config('policy')) !!}</p>
    </div>
</div>
