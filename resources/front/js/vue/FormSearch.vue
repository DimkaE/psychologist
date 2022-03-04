<template>
    <div>
        <div class="cl-b01 mb60">
            <div class="container">
                <div class="cl-b01__line"></div>
                <div class="flex">
                    <div class="cl-b01__step cl-b01__step_passed col4"
                         :class="[!Object.keys(psychologists).length ? 'cl-b01__step_active' : 'cl-b01__step_passed' ]">
                        <div class="cl-b01__number">
                            <div class="cl-b01__number-inner">
                                01
                            </div>
                        </div>
                        <div class="cl-b01__text">
                            Знакомство
                        </div>
                    </div>

                    <div class="cl-b01__step col4" :class="step2_class">
                        <div class="cl-b01__number">
                            <div class="cl-b01__number-inner">
                                02
                            </div>
                        </div>
                        <div class="cl-b01__text">
                            Выбор терапевта
                        </div>
                    </div>

                    <div class="cl-b01__step col4"
                         :class="[psychologistTimeConfirmed ? 'cl-b01__step_active' : '' ]">
                        <div class="cl-b01__number">
                            <div class="cl-b01__number-inner">
                                03
                            </div>
                        </div>
                        <div class="cl-b01__text">
                            Подтверждение занятия
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="!Object.keys(psychologists).length">
            <div class="cl-b02">
                <p class="text-center fz45 fw800 lh12 mb10">Давайте знакомиться</p>
                <p class="text-center fz20 mb30">После анкеты вы увидите наиболее подходящих из {{ total }}
                    психологов</p>
                <div class="cl-b02__avatars mb50">
                    <span class="cl-b02__ava" v-for="avatar in avatars">
                        <img :src="avatar" class="block" alt="">
                    </span>
                    <span class="cl-b02__btn">
                        {{ total }}
                    </span>
                </div>
            </div>
            <div class="container-small cl-b03">
                <div class="white-bg white-bg_thin">
                    <div class="bb1 pb60 mb40">
                        <p class="fz26 fw600 lh15">1. Что вас беспокоит?</p>
                        <p class="fz17 lh16 mb20" :class="[errorChooseDirection ? 'color-red' : '']">Выберите одну или
                            несколько проблем, которые вас тревожат</p>
                        <div class="flex flex-wrap">
                            <div v-for="direction in directions" class="col6 col12-550">
                                <label class="st-checkbox1 mb15">
                                    <input type="checkbox" :value="direction['id']" v-model="filterDirections"
                                           @click="errorChooseDirection = false">
                                    <span class="st-checkbox1__label">
                                        <svg class="st-checkbox1__svg">
                                            <use xlink:href="#ico-check"></use>
                                        </svg>
                                        <span class="st-checkbox1__name">{{ direction['name'] }}</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="bb1 pb60 mb40">
                        <p class="fz26 fw600 lh15 mb20">2. Что важно в психологе?</p>
                        <div class="flex mb10 flex_5 flex-wrap-550">
                            <div class="col0 col_5 col12-550">
                                <label class="st-checkbox1 mb10">
                                    <input type="radio" v-model="gender" value="">
                                    <span class="st-checkbox1__label">
                                        <span class="st-checkbox1__name">Пол не важен</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col0 col_5 col12-550">
                                <label class="st-checkbox1 mb10">
                                    <input type="radio" v-model="gender" value="male">
                                    <span class="st-checkbox1__label">
                                        <span class="st-checkbox1__name">Мужчина</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col0 col_5 col12-550">
                                <label class="st-checkbox1 mb10">
                                    <input type="radio" v-model="gender" value="female">
                                    <span class="st-checkbox1__label">
                                        <span class="st-checkbox1__name">Женщина</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="flex flex_5 flex-wrap-550">
                            <div class="col0 col_5  col12-550">
                                <label class="st-checkbox1">
                                    <input type="checkbox" v-model="anyAge" :value="true">
                                    <span class="st-checkbox1__label">
                                        <span class="st-checkbox1__name">Возраст не важен</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col0 col_5 flex-full  col12-550">
                                <block-slider :min="20"
                                              :max="80"
                                              v-model="age"></block-slider>
                            </div>
                        </div>
                    </div>
                    <div class="bb1 pb60 mb40">
                        <p class="fz26 fw600 lh15">3. Когда проведём занятие?</p>
                        <div class="mb20 flex1 flex-v-center">
                            <p class="fz17 lh16">Часовой пояс <span class="color-green fw600">UTC/GMT +2</span></p>
                        </div>
                        <div class="flex mb20 flex_5 flex-wrap-550">
                            <div class="col0 col_5 col12-550">
                                <label class="st-checkbox1 mb10">
                                    <input type="radio" name="radio2" v-model="filterDateRaw" :value="today">
                                    <span class="st-checkbox1__label">
                                        <span class="st-checkbox1__name">Сегодня</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col0 col_5 col12-550">
                                <label class="st-checkbox1 mb10">
                                    <input type="radio" name="radio2" v-model="filterDateRaw" :value="tomorrow">
                                    <span class="st-checkbox1__label">
                                        <span class="st-checkbox1__name">Завтра</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col0 col_5 col12-550">
                                <label class="st-checkbox1 mb10">
                                    <input type="radio" name="radio2" v-model="filterDateRaw">
                                    <span class="st-checkbox1__label" data-fancybox data-src="#modal-choose-date">
                                        <span class="st-checkbox1__name flex1 flex-v-center">
                                            <svg width="1.2rem" height="1.2rem" class="mr5 color-gray2">
                                                <use xlink:href="#ico-calendar"></use>
                                            </svg>
                                            {{ filterDate || 'Другой день' }}
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div v-if="filterEnabledTimes.length">
                            <p class="fz18 lh16 mb10">Выберите один или несколько удобных часов</p>
                            <div class="flex mb10 flex_5 flex-wrap">
                                <div class="col0 col_5" v-for="i in filterEnabledTimes">
                                    <label class="st-checkbox1 mb10">
                                        <input type="checkbox" v-model="filterTimes" :value="i">
                                        <span class="st-checkbox1__label st-checkbox1__label_small">
                                            <span class="st-checkbox1__name">{{ i }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mw500">
                        <p class="fz26 fw600 lh15 mb20">4. Как с вами связаться?</p>
                        <p class="fz20 fw600 mb20 lh13" v-if="!userLocal['id']">Если вы уже зарегистрированы, сначала
                            <a class="link link-green" :href="route('login')">авторизуйтесь</a>
                        </p>
                        <div class="mb20">
                            <block-input v-model="userLocal['name']"
                                         :label="'Ваше имя'"
                                         :errors="errors['name']"
                                         :svg="'ico-login'">
                            </block-input>
                        </div>
                        <div class="mb20">
                            <block-input :label="'Телефон'"
                                         :svg="'ico-phone'"
                                         :type="'tel'"
                                         v-model="userLocal['phone']"
                                         :errors="errors['phone']">
                            </block-input>
                        </div>
                        <div>
                            <block-input :label="'Электронная почта'"
                                         :svg="'ico-email'"
                                         :type="'email'"
                                         v-model="userLocal['email']"
                                         :errors="errors['email']">
                            </block-input>
                        </div>
                    </div>
                    <p class="text-error fz20 mb10" v-if="errorFirstForm">{{ errorFirstForm }}</p>
                    <button class="btn btn_transformed" @click="sendFirstForm">Подобрать специалиста</button>
                </div>
            </div>
        </div>
        <div v-else>
            <div v-if="psychologistTimeConfirmed">
                <div>
                    <div class="container cl-b06">
                        <p class="text-center fz45 fw800 lh12 mb10">Оплата сессии</p>
                        <p class="text-center fz20 mb50">Почти готово. Осталось произвести оплату и запись будет
                            завершена</p>
                        <div class="container-small">
                            <div class="white-bg white-bg_thin mb100">
                                <div class="bb1 bb1 pb60 mb40">
                                    <div class="flex">
                                        <div class="col7 col8-768 col12-550">
                                            <p class="fz26 fw600 mb10">Детали сессии</p>
                                            <div class="flex1 flex-v-center mb5">
                                                <p class="fz18 mr10">Терапевт:</p>
                                                <img class="cl-b06__img mr10" :src="psychologistSelected['ava30']"
                                                     alt="">
                                                <p class="fz18 fw600">{{ psychologistSelected['name'] }}
                                                    {{ psychologistSelected['last_name'] }}</p>
                                            </div>
                                            <p class="fz18 mb10">Время сессии: {{ showWeekDay() }},
                                                {{ formatDateLocal(psychologistDate) }} в
                                                {{ formatTimeLocal(psychologistTime) }}</p>
                                            <p class="link link-green fz18 fw600"
                                               @click="psychologistTimeConfirmed = false">Выбрать другое время</p>
                                        </div>
                                        <div class="col5 col4-768 hide-550">
                                            <img class="cl-b06__img2 block" src="img/cl-b06__im1.webp" alt="">
                                        </div>
                                    </div>
                                </div>
                                <p class="color-red fz20 mb10" v-if="errors['datetime']">{{ errors['datetime'][0] }}</p>
                                <ul class="ul1 mb40">
                                    <li class="fz18 lh16" v-if="consultationPrice != 0">Стоимость сессии составит
                                        {{ consultationPrice }} лев.
                                        <span v-if="!promocodeInput" @click="promocodeInput=true"
                                              class="link link-green fw600">Есть промо-код?</span>
                                        <span v-else>
                                            <block-input :label="'Промокод'"
                                                         :type="'text'"
                                                         v-model="promocode">
                                            </block-input>
                                        </span>
                                    </li>
                                    <li class="fz18 lh16" v-else>Консультация уже оплачена</li>
                                    <li class="fz18 lh16">Дата и время сессии "бронируется" на 1 час. Если в течение
                                        этого времени сессия не оплачена - бронь снимается.
                                    </li>
                                    <li class="fz18 lh16">Вы можете отменить или перенести сессию, если до ее начала
                                        более 12 часов – после этого вы уже не сможете ее перенести или отменить
                                    </li>
                                    <li class="fz18 lh16">Все сессии проводятся по видеосвязи из личного кабинета и вам
                                        потребуется стабильное подключение к интернету
                                    </li>
                                </ul>
                                <button @click="createConsultation" class="btn btn_transformed">
                                    Перейти к оплате
                                </button>
                            </div>
                            <div class="cl-b06__discl">
                                <div class="flex">
                                    <div class="col0 flex-none">
                                        <svg width="2rem" height="2rem">
                                            <use xlink:href="#ico-shield"></use>
                                        </svg>
                                    </div>
                                    <div class="col0">
                                        <p class="fz18 fw600 lh16">Безопасная сделка</p>
                                        <p class="fz15 lh17">За день до занятия произойдёт резервирование оплаты.
                                            Психолог получит деньги после того, как занятие пройдёт. Мы не собираем и не
                                            храним данные вашей карточки, платежи производятся через Банк</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="container cl-b03">
                    <p class="text-center fz45 fw800 lh12 mb10">Выберите психолога</p>
                    <p class="text-center fz20 mb30">Эти специалисты лучше всего соответствуют вашей анкете</p>
                    <div class="cl-b04 flex flex-center mb40">
                        <div v-for="item in psychologists" class="col0 flex-none">
                            <div class="cl-b04__item link flex1 flex-v-center"
                                 :class="[item['id'] == psychologistId ? 'cl-b04__item_active' : '']"
                                 @click="choosePsychologist(item)">
                                <img :src="item['ava52']" class="cl-b04__img mr15 block" alt="">
                                <div>
                                    <p class="fz18 fw600 mb5">{{ item['name'] }}</p>
                                    <p class="fz15">Подходит на 100%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-small">
                        <div class="white-bg white-bg_thin">
                            <div v-for="item in psychologists">
                                <div v-if="item['id'] == psychologistId" class="cl-b05">
                                    <div class="flex flex-v-center mb30 flex-wrap-768">
                                        <div class="col0 mb10 col12-768">
                                            <img class="cl-b05__img" :src="item['ava193']" alt="">
                                        </div>
                                        <div class="col0 mb10 col12-768">
                                            <p class="fz30 fw600 mb10">{{ item['name'] }} {{ item['last_name'] }}</p>
                                            <p class="fz19 mb20">Подходит вам на 100%</p>
                                            <div class="flex flex-wrap-550 mb10">
                                                <div class="col0 col12-550 mb5">
                                                    <div class="flex flex_5 flex-v-center">
                                                        <div class="col0 col_5">
                                                            <div class="cl-b05__bg flex1 flex-v-center flex-center">
                                                                <svg>
                                                                    <use xlink:href="#ico-crone"></use>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="col0 col_5">
                                                            <p class="fz16 lh15">{{ item['experience'] }}
                                                                {{ item['experience_text'] }}
                                                                опыта</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col0 col12-550 mb5" v-if="item['educations'].length">
                                                    <div class="flex flex_5 flex-v-center">
                                                        <div class="col0 col_5">
                                                            <div class="cl-b05__bg flex1 flex-v-center flex-center">
                                                                <svg>
                                                                    <use xlink:href="#ico-doc"></use>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="col0 col_5">
                                                            <p class="fz16 lh15">Диплом
                                                                психолога</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col0 col12-550 mb5"
                                                     v-if="item['educations_additional'].length">
                                                    <div class="flex flex_5 flex-v-center">
                                                        <div class="col0 col_5">
                                                            <div class="cl-b05__bg flex1 flex-v-center flex-center">
                                                                <svg>
                                                                    <use xlink:href="#ico-up"></use>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div class="col0 col_5">
                                                            <p class="fz16 lh15">Повышение
                                                                квалификации</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p v-if="scheduleVisible" class="link link-green fz18 fw600"
                                               @click="scheduleVisible = false">Вернуться к описанию</p>
                                        </div>
                                    </div>
                                    <div v-if="!scheduleVisible">
                                        <div class="mb20">
                                            <p class="fz21 fw600 mb5 lh15">О себе</p>
                                            <p class="fz17 lh17">{{ item['about'] }}</p>
                                        </div>
                                        <div class="mb20">
                                            <p class="fz21 fw600 mb5 lh15">Образование</p>
                                            <p v-for="education in item['educations']" class="fz17 lh17 mb5">-
                                                {{ education }}</p>
                                            <p v-for="education in item['educations_additional']" class="fz17 lh17 mb5">
                                                - {{ education }}</p>
                                        </div>
                                        <div>
                                            <p class="fz21 fw600 mb5 lh15">Компетенции</p>
                                            <div class="flex1 flex-wrap">
                                                <div v-for="direction in directions" class="cl-b05__pl"
                                                     v-if="item['directions'].indexOf(direction['id']) >= 0">
                                                    {{ direction['name'] }}
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn_transformed" @click="scheduleVisible = true">Выбрать
                                            {{ item['name'] }}
                                        </button>
                                    </div>
                                    <div v-else>
                                        <p class="fz26 fw600 mb20">Выберите дату и время сессии</p>
                                        <div class="flex mb20 flex_5 flex-wrap-550">
                                            <div class="col0 col_5 col12-550"
                                                 v-if="psychologistAvailableDates.indexOf(formatDateLocal(today)) >= 0">
                                                <label class="st-checkbox1 mb10">
                                                    <input type="radio" name="radio2" v-model="psychologistDate"
                                                           :value="today">
                                                    <span class="st-checkbox1__label">
                                                        <span class="st-checkbox1__name">Сегодня</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col0 col_5 col12-550"
                                                 v-if="psychologistAvailableDates.indexOf(formatDateLocal(tomorrow)) >= 0">
                                                <label class="st-checkbox1 mb10">
                                                    <input type="radio" name="radio2" v-model="psychologistDate"
                                                           :value="tomorrow">
                                                    <span class="st-checkbox1__label">
                                                        <span class="st-checkbox1__name">Завтра</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col0 col_5 col12-550">
                                                <label class="st-checkbox1 mb10">
                                                    <input type="radio" name="radio2" v-model="psychologistDate">
                                                    <span class="st-checkbox1__label" data-fancybox
                                                          data-src="#modal-choose-psychologist-date">
                                                        <span class="st-checkbox1__name flex1 flex-v-center">
                                                            <svg width="1.2rem" height="1.2rem" class="mr5 color-gray2">
                                                                <use xlink:href="#ico-calendar"></use>
                                                            </svg>
                                                            {{ formatDateLocal(psychologistDate) || 'Другой день' }}
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div v-if="psychologistAvailableTimes.length">
                                            <p class="fz18 lh16 mb10">Часовой пояс <span class="color-green fw600">UTC/GMT
                                                +2</span></p>
                                            <div class="flex mb10 flex_5 flex-wrap">
                                                <div class="col0 col_5" v-for="i in psychologistAvailableTimes">
                                                    <label class="st-checkbox1 mb10">
                                                        <input type="radio" v-model="psychologistTime" :value="i">
                                                        <span class="st-checkbox1__label st-checkbox1__label_med">
                                                            <span class="st-checkbox1__name">{{
                                                                    formatTimeLocal(i)
                                                                }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn_transformed" @click="getConsultationPrice"
                                                :class="[(!psychologistDate || !psychologistTime) ? 'btn_disabled' : '']">
                                            Записаться на сессию
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modal-choose-date" style="display: none">
            <p class="fz26 fw600 mb5">Выберите дату и время</p>
            <p class="fz18 mb20">Время приема По Гринвичу <span class="fw600">(GMT+0)</span></p>
            <div class="flex flex-wrap-550">
                <div class="col6 col12-550 mb10">
                    <div class="relative dropdown">
                        <div class="btn2 dropdown__header">
                            <svg width="1.2rem" height="1.2rem" class="mr5">
                                <use xlink:href="#ico-calendar"></use>
                            </svg>
                            {{ filterDate || 'Выбрать дату' }}
                        </div>
                        <div class="dropdown__body">
                            <date-picker :min-date="new Date()" :color="'green'" mode="date"
                                         v-model="filterDateRaw"></date-picker>
                        </div>
                    </div>
                </div>
                <div class="col6 col12-550 mb10">
                    <div class="relative dropdown">
                        <div class="btn2 dropdown__header">
                            <svg width="1.2rem" height="1.2rem" class="mr5">
                                <use xlink:href="#ico-clock"></use>
                            </svg>
                            Выбрать время
                        </div>
                        <div class="dropdown__body">
                            <div class="dropdown__inner">
                                <div v-if="filterEnabledTimes.length">
                                    <p class="fz17 fw600 link mb10" v-for="i in filterEnabledTimes"
                                       :class="[filterTimes.indexOf(i) >= 0 ? 'dropdown__selected' : '']"
                                       @click="setTime(i)">{{
                                            formatTimeLocal(i)
                                        }}</p>
                                </div>
                                <div v-else>
                                    <p class="fz17 fw600">Выберите дату</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-center">
                <button class="btn btn_transformed" @click="closeModalLocal">
                    Применить значения
                </button>
            </div>
        </div>
        <div class="modal" id="modal-choose-psychologist-date" style="display: none">
            <p class="fz26 fw600 mb5">Выберите дату и время</p>
            <p class="fz18 mb20">Время приема по Гринвичу <span class="fw600">(GMT+0)</span></p>
            <div class="flex flex-wrap-550">
                <div class="col6 col12-550 mb10">
                    <div class="relative dropdown">
                        <div class="btn2 dropdown__header">
                            <svg width="1.2rem" height="1.2rem" class="mr5 color-gray2">
                                <use xlink:href="#ico-calendar"></use>
                            </svg>
                            {{ formatDateLocal(psychologistDate) || 'Выбрать дату' }}
                        </div>
                        <div class="dropdown__body">
                            <date-picker :available-dates="psychologistAvailableDatesToCalendar" :color="'green'"
                                         mode="date"
                                         v-model="psychologistDate"></date-picker>
                        </div>
                    </div>
                </div>
                <div class="col6 col12-550 mb10">
                    <div class="relative dropdown">
                        <div class="btn2 dropdown__header">
                            <svg width="1.2rem" height="1.2rem" class="mr5 color-gray2">
                                <use xlink:href="#ico-clock"></use>
                            </svg>
                            {{ psychologistTime ? formatTimeLocal(psychologistTime) : 'Выбрать время' }}
                        </div>
                        <div class="dropdown__body">
                            <div class="dropdown__inner">
                                <div v-if="psychologistAvailableTimes.length">
                                    <p class="fz17 fw600 link mb10" v-for="i in psychologistAvailableTimes"
                                       :class="[i == psychologistTime ? 'dropdown__selected' : '']"
                                       @click="setPsychologistTime(i)">{{
                                            formatTimeLocal(i)
                                        }}</p>
                                </div>
                                <div v-else>
                                    <p class="fz17 fw600">Выберите дату</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-center">
                <button class="btn btn_transformed" @click="closeModalLocal">
                    Выбрать время
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormSearch",
    props: {
        directions: Array,
        total: Number,
        avatars: Array,
        user: Object
    },
    data() {
        const tomorrow = new Date();
        const today = new Date();
        return {
            filterDateRaw: '',
            filterDate: '',
            filterTimes: [],
            filterEnabledTimes: [],
            filterDirections: [],
            gender: '',
            age: {
                min: 20,
                max: 80,
            },
            today: today,
            tomorrow: new Date(tomorrow.setDate(today.getDate() + 1)),
            anyAge: false,
            allTimes: window.allTimes,
            psychologists: {},
            psychologistId: 0,
            psychologistSelected: {},
            psychologistAvailableDates: [],
            psychologistAvailableDatesToCalendar: [],
            psychologistAvailableTimes: [],
            psychologistDate: '',
            psychologistTime: '',
            scheduleVisible: false,
            psychologistTimeConfirmed: false,
            userLocal: this.user || {},
            errors: {},
            errorFirstForm: '',
            errorChooseDirection: false,
            consultationPrice: 0,
            promocodeInput: false,
            promocode: '',
            inputTimer: '',
        }
    },
    watch: {
        age: function () {
            this.anyAge = false;
        },
        filterDateRaw: function () {
            this.filterDate = this.formatDateLocal(this.filterDateRaw);
            $('.dropdown__body').hide()
            $('.dropdown').removeClass('dropdown_opened')
            this.updateTimes();
        },
        psychologistDate: function () {
            $('.dropdown__body').hide()
            $('.dropdown').removeClass('dropdown_opened')
            this.updatePsychologistTimes();
        },
        promocode: function () {
            let component = this;
            clearTimeout(component.inputTimer);
            component.inputTimer = setTimeout(function () {
                component.getConsultationPrice();
            }, 500);

        },
    },
    mounted() {
        /* this.filterDirections = [5,3];
         this.getPsychologists();
         this.psychologistTimeConfirmed = true;*/
    },
    methods: {
        setTime(time) {
            if (this.filterTimes.indexOf(time) >= 0)
                this.filterTimes.slice(this.filterTimes.indexOf(time), this.filterTimes.indexOf(time) + 1);
            else
                this.filterTimes.push(time);
        },
        formatDateLocal(date) {
            return formatDate(date);
        },
        formatTimeLocal(i) {
            return formatTime(i)
        },
        updateTimes() {
            if (this.formatDateLocal(this.today) == this.filterDate) {
                let now = new Date();
                this.filterEnabledTimes = [];
                for (let i in this.allTimes) {
                    if (now.getHours() + 1 < this.allTimes[i])
                        this.filterEnabledTimes.push(this.allTimes[i])
                }
            } else {
                this.filterEnabledTimes = this.allTimes;
            }
            let new_times = [];
            for (let i in this.filterTimes) {
                if (this.filterEnabledTimes.indexOf(this.filterTimes[i]) >= 0) {
                    new_times.push(this.filterTimes[i])
                }
            }
            this.filterTimes = new_times;
        },
        sendFirstForm() {
            this.errorFirstForm = '';
            if (this.user || this.userLocal['id']) {
                this.getPsychologists();
            } else {
                this.register();
            }
        },
        getPsychologists() {
            if (this.filterDirections.length) {
                let filter = {
                    'directions': this.filterDirections,
                    'age_min': this.age.min,
                    'gender': this.gender,
                    'age_max': this.age.max,
                    'any_age': this.anyAge,
                    'date': formatDateInput(this.filterDateRaw),
                    'times': this.filterTimes
                };
                let string = window.getQueryString(route('search'), filter);
                axios.get(route('psychologists.filtered') + `?${string}`)
                    .then((response) => {
                        if (response.data.length) {
                            this.psychologists = response.data;
                            scrollTop();
                            this.choosePsychologist(this.psychologists[0])
                        } else {
                            this.errorFirstForm = 'Не найдено подходящих специалистов. Попробуйте изменить условия поиска';
                        }
                    })
                    .catch(() => {
                        this.errorFirstForm = 'Произошла ошибка. Попробуйте обновить страницу';
                    });
            } else {
                scrollTop();
                this.errorChooseDirection = true;
            }
        },
        register() {
            $('.preloader').show();
            axios.post(route('customers.store'), prepareFormData(this.userLocal), {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    $('.preloader').hide();
                    console.log(response);
                    this.userLocal = response.data.data;
                    this.getPsychologists()
                })
                .catch((err) => {
                    this.showError(err);
                });
        },
        showError(err) {
            $('.preloader').hide();
            if (err.response.status == 422)
                this.errors = err.response.data.errors;
            else
                this.errorFirstForm = 'Произошла ошибка, попробуйте обновить страницу';
            scrollToError();
        },
        choosePsychologist(item) {
            this.psychologistId = item['id'];
            this.psychologistSelected = item;
            this.scheduleVisible = false;
            this.psychologistDate = '';
            this.psychologistTime = '';
            this.psychologistAvailableTimes = [];
            this.getPsychologistDates()
        },
        getPsychologistDates() {
            let raw_dates = [];
            axios.get(route('consultations.available_dates') + `?id=${this.psychologistId}`)
                .then((response) => {
                    if (response.data.length) {
                        for (let i in response.data) {
                            raw_dates.push(new Date(response.data[i]));
                        }
                        this.psychologistAvailableDates = [];
                        for (let i in raw_dates) {
                            this.psychologistAvailableDates
                                .push(this.formatDateLocal(raw_dates[i]))
                        }
                        this.psychologistAvailableDatesToCalendar = []
                        for (let i in raw_dates) {
                            this.psychologistAvailableDatesToCalendar.push({
                                start: new Date(raw_dates[i]),
                                end: new Date(raw_dates[i]),
                            })
                        }
                    } else {
                        this.errorFirstForm = 'Не найдено подходящих специалистов. Попробуйте изменить условия поиска';
                    }
                })
                .catch((err) => {
                    console.log(err)
                    this.errorFirstForm = 'Произошла ошибка. Попробуйте обновить страницу';
                });
        },
        updatePsychologistTimes() {
            this.psychologistAvailableTimes = [];
            axios.get(route('consultations.available_times') + `?id=${this.psychologistId}&date=${formatDateInput(this.psychologistDate)}`)
                .then((response) => {
                    this.psychologistAvailableTimes = response.data;
                })
                .catch((err) => {
                    console.log(err)
                    this.errorFirstForm = 'Произошла ошибка. Попробуйте обновить страницу';
                });
            if (this.psychologistAvailableTimes.indexOf(this.psychologistTime) == -1)
                this.psychologistTime = '';
        },
        setPsychologistTime(time) {
            this.psychologistTime = time;
            $('.dropdown__body').hide()
            $('.dropdown').removeClass('dropdown_opened')
        },
        showWeekDay() {
            let days = [
                'Воскресенье',
                'Понедельник',
                'Вторник',
                'Среда',
                'Четверг',
                'Пятница',
                'Суббота'
            ];
            let n
            if (this.psychologistDate)
                n = this.psychologistDate.getDay();
            return n ? days[n] : '';
        },
        getConsultationPrice() {
            $('.preloader').show();
            axios.get(route('consultations.price') + `?promocode=${this.promocode}`).then((response) => {
                $('.preloader').hide();
                this.psychologistTimeConfirmed = true;
                this.consultationPrice = response.data;
            })
                .catch((err) => {
                    console.log(err)
                    this.showError(err);
                });
        },
        createConsultation() {
            this.cardError = '';
            $('.preloader').show();
            this.psychologistDate.setHours(this.psychologistTime, 0, 0);
            let data = {
                'psychologist_id': this.psychologistId,
                'promocode': this.promocode,
                'datetime': formatDateTime(this.psychologistDate),
            };
            axios.post(route('consultations.store'), prepareFormData(data), {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    $('.preloader').hide();
                    console.log(response)
                    if (response.data.error) {
                        this.cardError = response.data.error
                    }
                    if (response.data.redirect) {
                        window.location = response.data.redirect;
                    }
                })
                .catch((err) => {
                    console.log(err)
                    this.showError(err);
                });
        },
        closeModalLocal() {
            window.closeModal()
        }
    },

    computed: {
        step2_class() {
            return {
                'cl-b01__step_active': (Object.keys(this.psychologists).length && !this.psychologistTimeConfirmed),
                'cl-b01__step_passed': (Object.keys(this.psychologists).length && this.psychologistTimeConfirmed)
            }
        }
    }
}
</script>

<style scoped>

</style>
