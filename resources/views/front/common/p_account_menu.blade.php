@if(auth()->user()->role == 2)
    @if(!auth()->user()->published)
        <p class="mb20 color-red text-center fz20">Ваша учетная запись еще не прошла модерацию</p>
    @endif
    @if(!auth()->user()->periodsRel->count())
        <p class="mb20 color-red text-center fz20">Вы не заполнили периоды, доступные для записи на консультацию.
            Сделайте
            это на вкладке "Личные данные"</p>
    @endif
@endif
<div class="flex flex-center al-b01 mb20 flex-wrap-768">
    <div class="col0 col6-768 mb10 col12-550">
        <a class="al-b01__link @if(url()->current() == route('account.index')) al-b01__link_active @endif"
           href="{{ route('account.index') }}">
            <svg>
                <use xlink:href="#ico-al-01"></use>
            </svg>
            <span>Записи на прием</span>
        </a>
    </div>
    <div class="col0 col6-768 mb10 col12-550">
        <a class="al-b01__link @if(url()->current() == route('account.data')) al-b01__link_active @endif"
           href="{{ route('account.data') }}">
            <svg>
                <use xlink:href="#ico-al-02"></use>
            </svg>
            <span>Личные данные</span>
        </a>
    </div>
    <div class="col0 col6-768 mb10 col12-550">
        <a class="al-b01__link @if(url()->current() == route('account.messages')) al-b01__link_active @endif"
           href="{{ route('account.messages') }}">
            <svg>
                <use xlink:href="#ico-al-03"></use>
            </svg>
            @if(auth()->user()->messagesRel()->unread()->count())
                <span class="relative">
                    <span class="al-b01__link-notify"></span>
                </span>
            @endif
            <span>Уведомления</span>
        </a>
    </div>
    <div class="col0 col6-768 mb10 col12-550">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="al-b01__link" href="#" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                <svg>
                    <use xlink:href="#ico-al-04"></use>
                </svg>
                <span>Выйти</span>
            </a>
        </form>
    </div>
</div>
