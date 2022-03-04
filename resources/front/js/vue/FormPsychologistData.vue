<template>
    <div>
        <div class="bb1 pb40 mb30" id="ad-b02-1">
            <div class="flex flex-wrap-550">
                <div class="col0 flex-none">
                    <block-photo :image_old="form['ava193']" v-model="photo"></block-photo>
                    <p v-if="errors['photo']" class="text-error">{{ errors['photo'][0] }}</p>
                </div>
                <div class="col0 flex-full ad-b02__photo-descr  col12-550">
                    <p class="fz26 fw600 mb10">Фото профиля</p>
                    <p class="fz18 lh16">От фотографии зависит, какое первое впечатление вы произведёте на пользователей
                        сервиса.</p>
                    <p class="fz15 lh17">Сфотографируйтесь как на паспорт, только с лёгкой улыбкой. Лучше всего — при
                        естественном свете. Хорошая фотография вызовет у людей доверие.</p>
                </div>
            </div>
        </div>
        <div class="bb1 pb40 mb30" id="ad-b02-2">
            <div class="mw500">
                <p class="fz26 fw600 mb10">Персональные данные</p>
                <p class="fz18 lh16 mb30">Все поля в этом блоке обязательны для заполнения</p>
                <input type="hidden" v-model="form['id']">
                <div class="mb20">
                    <block-input :label="'Фамилия'"
                                 :svg="'ico-login'"
                                 v-model="form['last_name']"
                                 :errors="errors['last_name']">
                    </block-input>
                </div>
                <div class="mb20">
                    <block-input :label="'Имя'"
                                 :svg="'ico-login'"
                                 v-model="form['name']"
                                 :errors="errors['name']">
                    </block-input>
                </div>
                <div class="mb20">
                    <block-input :label="'Отчество'"
                                 :svg="'ico-login'"
                                 v-model="form['second_name']"
                                 :errors="errors['second_name']">
                    </block-input>
                </div>

                <div class="mb20">
                    <block-input :label="'Дата рождения'"
                                 :svg="'ico-calendar'"
                                 :type="'date'"
                                 v-model="form['birthdate']"
                                 :errors="errors['birthdate']">
                    </block-input>
                </div>
                <div class="mb20">
                    <block-input :label="'Опыт работы'"
                                 :svg="'ico-medal'"
                                 :input_class="'input-mask-2'"
                                 v-model="form['experience']"
                                 :errors="errors['experience']">
                    </block-input>
                </div>
                <div class="mb20">
                    <block-input :label="'Телефон'"
                                 :svg="'ico-phone'"
                                 :type="'tel'"
                                 v-model="form['phone']"
                                 :errors="errors['phone']">
                    </block-input>
                </div>
                <div>
                    <block-input :label="'Электронная почта'"
                                 :svg="'ico-email'"
                                 v-model="form['email']"
                                 :errors="errors['email']">
                    </block-input>
                </div>
                <p class="fz18 lh16 mb30">Чтобы не менять пароль - оставьте поле пустым</p>
                <div>
                    <block-input :label="'Пароль'"
                                 v-model="form['password']"
                                 :errors="errors['password']">
                    </block-input>
                </div>
            </div>
        </div>
        <div class="bb1 pb40 mb30" id="ad-b02-3">
            <p class="fz26 fw600 mb10">О себе</p>
            <p class="fz18 lh16 mb30">Заполните раздел в свободной форме, не более 2000 символов</p>
            <block-input :textarea="true"
                         v-model="form['about']"
                         :errors="errors['about']">
            </block-input>
        </div>
        <div class="bb1 pb40 mb30" id="ad-b02-4">
            <p class="fz26 fw600 mb10">Образование</p>
            <p class="fz18 lh16 mb30">По одному в строке. Например,<br>
                2003 - МГУ - факультет психологии, клиническая психология - бакалавр.<br>
                2010 - ВШЭ - психоанализ - магистерская программа (2 года).</p>
            <div class="mb40">
                <div class="mb20 relative" v-for="(education, index) in form['educations']">
                    <block-input v-model="form['educations'][index]"
                                 :errors="errors['educations.' + index]">
                    </block-input>
                    <div v-if="index > 0" class="remove-line" @click="removeEducation(index)">&times;</div>
                </div>
                <div class="btn2" @click="addEducation">Добавить еще</div>
            </div>
            <p class="fz26 fw600 mb30">Дополнительные программы</p>
            <div class="mb20 relative" v-for="(education, index) in form['educations_additional']">
                <block-input v-model="form['educations_additional'][index]"
                             :errors="errors['educations_additional.' + index]">
                </block-input>
                <div class="remove-line" @click="removeEducationAdditional(index)">&times;</div>
            </div>
            <div class="btn2" @click="addEducationAdditional">Добавить еще</div>
        </div>
        <div class="bb1 pb40 mb30" id="ad-b02-5">
            <p class="fz26 fw600 mb10">Компетенции</p>
            <p class="fz18 lh16 mb30">Выберите до пяти сфер, в которых вы имеете наибольший опыт</p>
            <div class="">
                <block-select :values="directions" :multiple="true" v-model="form['directions']"></block-select>
            </div>
        </div>
        <div class="bb1 pb40 mb30" id="ad-b02-6">
            <p class="fz26 fw600 mb10">Средства для связи</p>
            <p class="fz18 lh16 mb30">Выберите до пяти сфер, в которых вы имеете наибольший опыт</p>
            <div class="mb20">
                <block-input :label="'Логин в Skype'"
                             v-model="form['skype']"
                             :error="form['skype']"
                             :svg="'ico-skype'">
                </block-input>
            </div>
            <div class="mb20">
                <block-input :label="'Логин в Discord'"
                             v-model="form['discord']"
                             :error="form['discord']"
                             :svg="'ico-discord'">
                </block-input>
            </div>
            <div class="mb20">
                <block-input :label="'Логин в Google Hangouts'"
                             v-model="form['hangouts']"
                             :error="form['hangouts']"
                             :svg="'ico-hangouts'">
                </block-input>
            </div>
        </div>
        <div class="bb1 pb40 mb30" id="ad-b02-7">
            <p class="fz26 fw600 mb10">График приема</p>
            <p class="fz18 lh16 mb15">Выберите дни, в которые вы готовы проводить сессии</p>
            <div class="flex mb20 flex_5 flex-wrap">
                <div class="col0 col_5" v-for="(day, index) in days">
                    <label class="st-checkbox1 mb10">
                        <input type="checkbox" v-model="periods_days"
                               :value="index">
                        <span class="st-checkbox1__label st-checkbox1__label_med">
                            <span class="st-checkbox1__name">{{ day }}</span>
                        </span>
                    </label>
                </div>
            </div>
            <p class="fz18 lh16 mb10">Часовой пояс <span class="fw600">UTC/GMT +2</span></p>
            <div class="flex mb10 flex_5 flex-wrap">
                <div class="col0 col_5" v-for="i in all_times">
                    <label class="st-checkbox1 mb10">
                        <input type="checkbox" v-model="periods_times" :value="i">
                        <span class="st-checkbox1__label st-checkbox1__label_med">
                            <span class="st-checkbox1__name">{{
                                    formatTimeLocal(i)
                                }}</span>
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div class="bb1 pb40 mb30">
            <p class="fz22 mb20 fw600 lh15">Реквизиты банковской карты (для выплаты вознаграждений) <span class="color-red">*</span></p>
            <div class="mb10">
                <block-input :label="'Название банка'" :type="'text'" v-model="form['bank_name']"
                             :errors="errors['bank_name']"></block-input>
            </div>
            <div class="mb10">
                <block-input :label="'Номер карты'" :type="'text'" v-model="form['bank_account']"
                             :errors="errors['bank_account']" :input_class="'card_number'"></block-input>
            </div>
            <div class="mb10">
                <block-input :label="'Имя, фамилия на латинице'" :type="'text'" v-model="form['bank_holder']"
                             :errors="errors['bank_holder']"></block-input>
            </div>
            <div class="mw400">
                <block-input :label="'Срок действия карты'" :type="'text'" v-model="form['bank_date']"
                             :errors="errors['bank_date']"  :input_class="'card_date'"></block-input>
            </div>
        </div>
        <div class="" id="ad-b02-8">
            <p class="fz26 fw600 mb10">Удаление аккаунта</p>
            <p v-if="errorDelete" class="fz20 color-red mb20">{{ errorDelete }}</p>
            <p class="fz18 lh16 mb15">Для того, чтобы удалить свой профиль, нажмите на кнопку
                Если вы столкнулись с проблемами, напишите нам — мы обязательно поможем</p>
            <div class="flex">
                <div class="col0">
                    <a href="#" class="link link-green fz19 fw600" data-fancybox
                       data-src="#modal-support">Написать в техподдержку</a>
                </div>
                <div class="col0">
                    <a href="#" v-if="!showDestroy" class="link link-dark5 fz19 fw600"
                       @click.prevent="showDestroy = true">Удалить профиль</a>
                    <div v-if="showDestroy">
                        <p class="text-danger fz20 mb10 lh14">Вы уверены?<br> Это необратимо!</p>
                        <a href="#" class="link link-dark5 fz19 fw600" @click.prevent="destroy">Да, удалить</a>
                    </div>

                </div>
            </div>
            <form-support></form-support>
            <button class="btn btn_transformed" @click="save">Сохранить изменения</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormPsychologistData",
    props: {
        user: Object,
        directions: Array,
    },
    data() {
        return {
            form: this.user,
            errors: {},
            photo: {},
            changed: false,
            days: {
                "1": "Пн",
                "2": "Вт",
                "3": "Ср",
                "4": "Чт",
                "5": "Пт",
                "6": "Сб",
                "7": "Вс",
            },
            periods_days: this.user['periods_days'] || [],
            periods_times: this.user['periods_times'] || [],
            all_times: [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22],
            showDestroy: false,
            errorDelete: '',
        }
    }, watch: {
        birthday_date_raw: function () {
            this.birthday_date = this.formatDateLocal(this.birthday_date_raw);
            $('.dropdown__body').hide()
            $('.dropdown').removeClass('dropdown_opened')
        },
    },
    mounted() {
    },
    methods: {
        formatTimeLocal(i) {
            return formatTime(i)
        },
        addEducation() {
            if (!this.form['educations'])
                this.form['educations'] = [];
            this.form['educations'].push('');
            this.$forceUpdate();
        },
        removeEducation(index) {
            if (index > 0) {
                this.form['educations'].splice(index, 1);
                this.$forceUpdate();
            }
        },
        addEducationAdditional() {
            if (!this.form['educations_additional'])
                this.form['educations_additional'] = [];
            this.form['educations_additional'].push('');
            this.$forceUpdate();
        },
        removeEducationAdditional(index) {
            this.form['educations_additional'].splice(index, 1);
            this.$forceUpdate();
        },
        save() {
            $('.preloader').show();
            let formData = prepareFormData(this.form)
            if (Object.keys(this.photo).length)
                formData.append('photo', this.photo['image']);
            for (let i in this.periods_days) {
                formData.append('periods_days[]', this.periods_days[i]);
            }
            for (let i in this.periods_times) {
                formData.append('periods_times[]', this.periods_times[i]);
            }
            axios.post(route('psychologists.update'), formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {
                    this.showSuccess(response);
                })
                .catch((err) => {
                    this.showError(err);
                });
        },
        showSuccess() {
            window.location = route('account.data');
        },
        showError(err) {
            console.log(err.response)
            $('.preloader').hide();
            if (err.response.status == 422)
                this.errors = err.response.data.errors;
            else
                this.errorOther = true;
            scrollToError();
        },
        destroy() {
            axios.delete(route('psychologists.destroy'))
                .then((msg) => {
                    if (msg.data.error)
                        this.errorDelete = msg.data.error
                    if (msg.data.redirect)
                        window.location = msg.data.redirect;
                })
                .catch((err) => {
                    console.log(err.response)
                    showError(err);
                });
        },
    }
}
</script>

<style scoped>

</style>
