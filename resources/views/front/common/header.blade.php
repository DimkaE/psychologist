<header class="header">
    <div class="container">
        <div class="flex flex-v-center">
            <div class="col0 flex-full">
                <div class="flex1 flex-v-center">
                    <svg class="mr5" width="5.8rem" height="2.2rem">
                        <use xlink:href="#ico-logo-home"></use>
                    </svg>
                    <p class="fz11 fw300">консультации <br>
                        с психотерапевтом онлайн</p>
                </div>
            </div>
            <div class="col0">
                <div class="body-shadow"></div>
                <div class="menu-block">
                    <div class="menu-burger">
                        <svg width="1rem" height=".8rem" viewBox="0 0 20 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect y="14" width="20" height="2"/>
                            <rect y="7" width="20" height="2"/>
                            <rect width="20" height="2"/>
                        </svg>
                    </div>
                    <div class="menu-wrap">
                        <ul class="header__ul flex1 flex-full">
                            <li>
                                <a href="{{ route('home') }}#b01" class="fz17 link link-dark fw500" data-link="#b01">Терапевты</a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}#b02" class="fz17 link link-dark fw500" data-link="#b02">О сервисе</a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}#b03" class="fz17 link link-dark fw500" data-link="#b03">Как работает</a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}#b04" class="fz17 link link-dark fw500" data-link="#b04">Отзывы</a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}#b05" class="fz17 link link-dark fw500" data-link="#b05">Частые
                                    вопросы</a>
                            </li>
                            <li>
                                <a href="{{ route('blog') }}" class="fz17 link link-dark fw500">Блог</a>
                            </li>
                        </ul>
                        <div class="show-768">
                            <a href="#" class="link link-dark flex1 flex-v-center">
                                <svg class="mr5" width="1.2rem" height="1.2rem">
                                    <use xlink:href="#ico-account"></use>
                                </svg>
                                @auth
                                    <span class="fw800 fz17">{{ Auth::user()->name }}</span>
                                @else
                                    <span class="fw800 fz17">Мой кабинет</span>
                                @endauth
                            </a>
                        </div>
                        <div class="menu-close">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewbox="0 0 43 43">
                                <path fill-rule="evenodd"
                                      d="M42.988,1.420 L22.775,21.634 L42.705,41.565 L41.282,42.988 L21.351,23.058 L2.144,42.265 L0.735,40.856 L19.942,21.649 L0.012,1.718 L1.435,0.295 L21.366,20.225 L41.579,0.012 L42.988,1.420 Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col0 hide-768">
                <a href="{{ route('login') }}" class="link link-dark flex1 flex-v-center">
                    <svg class="mr5" width="1.2rem" height="1.2rem">
                        <use xlink:href="#ico-account"></use>
                    </svg>
                    @auth
                        <span class="fw800 fz17">{{ Auth::user()->name }}</span>
                    @else
                        <span class="fw800 fz17">Мой кабинет</span>
                    @endauth
                </a>
            </div>
        </div>
    </div>
</header>
