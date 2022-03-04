<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <x-nav-link href="{{ route('back.dashboard') }}" :active="request()->routeIs('back.dashboard')">
                    Главная
                </x-nav-link>
                <x-nav-link href="{{ route('back.users.index') }}" :active="request()->routeIs('back.users.index')">
                    Пользователи
                </x-nav-link>
                <x-nav-link href="{{ route('back.messages.index') }}" :active="request()->routeIs('back.messages.index')">
                    Сообщения
                </x-nav-link>
                <x-nav-link href="{{ route('back.promocodes.index') }}" :active="request()->routeIs('back.promocodes.index')">
                    Промокоды
                </x-nav-link>
                <x-nav-link href="{{ route('back.directions.index') }}" :active="request()->routeIs('back.directions.index')">
                    Направления
                </x-nav-link>
                <x-nav-link href="{{ route('back.pages.index') }}" :active="request()->routeIs('back.pages.index')">
                    Страницы
                </x-nav-link>
                <x-nav-link href="{{ route('back.questions.index') }}" :active="request()->routeIs('back.questions.index')">
                    FAQ
                </x-nav-link>
                <x-nav-link href="{{ route('back.reviews.index') }}" :active="request()->routeIs('back.reviews.index')">
                    Отзывы
                </x-nav-link>
                <x-nav-link href="{{ route('back.articles.index') }}" :active="request()->routeIs('back.articles.index')">
                    Статьи
                </x-nav-link>
                <x-nav-link href="{{ route('back.consultations.index') }}" :active="request()->routeIs('back.consultations.index')">
                    Консультации
                </x-nav-link>
                <x-nav-link href="{{ route('back.payments.index') }}" :active="request()->routeIs('back.payments.index')">
                    Платежи
                </x-nav-link>
                <x-nav-link href="{{ route('back.settings.edit') }}" :active="request()->routeIs('back.settings.edit')">
                    Настройки
                </x-nav-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('cache_clear') }}" target="_blank" class="nav-link">
                        Сбросить кэш
                    </a>
                </li>

                <!-- Settings Dropdown -->
                @auth
                    <x-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            {{ Auth::user()->name }}
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </ul>
        </div>
    </div>
</nav>
