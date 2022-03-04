<template>
    <div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb10 fw600 lh15">Ваши Фамилия Имя Отчество <span class="color-red">*</span></p>
            <p class="fz17 mb20 lh15">Например, Иванов Александр Сергеевич</p>
            <div class="flex">
                <div class="col4">
                    <block-input v-model="form['last_name']" :label="'Фамилия'"
                                 :errors="errors['last_name']"></block-input>
                </div>
                <div class="col4">
                    <block-input v-model="form['name']" :label="'Имя'" :errors="errors['name']"></block-input>
                </div>
                <div class="col4">
                    <block-input v-model="form['second_name']" :label="'Отчество'"
                                 :errors="errors['second_name']"></block-input>
                </div>
            </div>

        </div>
        <div class="bb1 pb40 mb40">
            <div class="mw400">
                <p class="fz22 mb10 fw600 lh15">Ваша дата рождения? <span class="color-red">*</span></p>
                <p class="fz17 mb20 lh15">Пример формата: 08.05.1970</p>
                <block-input :label="'Введите ответ'" :type="'date'" v-model="form['birthdate']"
                             :errors="errors['birthdate']"></block-input>
            </div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb10 fw600 lh15">Какое у вас высшее образование? <span class="color-red">*</span></p>
            <p class="fz17 mb20 lh15">По одному в строке. Например,<br>
                2003 - МГУ - факультет психологии, клиническая психология - бакалавр.<br>
                2010 - ВШЭ - психоанализ - магистерская программа (2 года).</p>
            <div class="mb20 relative" v-for="(education, index) in form['educations']">
                <block-input v-model="form['educations'][index]"
                             :errors="errors['educations.' + index]">
                </block-input>
                <div v-if="index > 0" class="remove-line" @click="removeEducation(index)">&times;</div>
            </div>
            <div class="btn2" @click="addEducation">Добавить еще</div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb10 fw600 lh15">Какие дополнительные программы проходили? <span class="color-red">*</span>
            </p>
            <p class="fz17 mb20 lh15">По одному в строке. Например,<br>
                2019 - Московский Гештальт Институт. Специализация: «Работа с травмой в гештальт подходе» - 300 ак.
                часов.</p>
            <div class="mb20 relative" v-for="(education, index) in form['educations_additional']">
                <block-input v-model="form['educations_additional'][index]"
                             :errors="errors['educations_additional.' + index]">
                </block-input>
                <div class="remove-line" @click="removeEducationAdditional(index)">&times;</div>
            </div>
            <div class="btn2" @click="addEducationAdditional">Добавить еще</div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb10 fw600 lh15">Ваши дипломы? <span class="color-red">*</span></p>
            <p class="fz17 mb20 lh15">Пожалуйста, прикрепите фотографии развернутых дипломов и сертификатов,
                подтверждающих обучение. Если документов много, выберите 2-3 основных и самых крупных</p>
            <block-multi-photo :max="5" v-model="diplomas">
            </block-multi-photo>
            <p v-if="errors['diplomas']" class="text-error">{{ errors['diplomas'][0] }}</p>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb10 fw600 lh15">Сколько лет вы консультируете? <span class="color-red">*</span></p>
            <p class="fz17 mb20 lh15">За деньги, не в рамках учебной программы</p>
            <div class="mw400">
                <block-input :label="'Введите ответ'" :input_class="'input-mask-2'" v-model="form['experience']"
                             :errors="errors['experience']"></block-input>
            </div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Есть ли опыт работы онлайн? Сколько лет? Если нет - поставьте 0 <span
                class="color-red">*</span></p>
            <div class="mw400">
                <block-input :label="'Введите ответ'" :input_class="'input-mask-2'" v-model="form['experience_online']"
                             :errors="errors['experience_online']"></block-input>
            </div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">В каком направлении вы работаете? <span class="color-red">*</span></p>
            <div class="">
                <block-select :values="directions" :multiple="true" v-model="form['directions']"></block-select>
            </div>
            <p v-if="errors['directions']" class="text-error">{{ errors['directions'][0] }}</p>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb10 fw600 lh15">Сколько клиентов у вас сейчас в практике? <span class="color-red">*</span>
            </p>
            <p class="fz17 mb20 lh15">Пожалуйста, не за всю историю практики, а на текущий момент</p>
            <div class="mw400">
                <block-input :label="'Введите ответ'" :input_class="'input-mask-2'"
                             v-model="form['clients']" :errors="errors['clients']"></block-input>
            </div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Сколько времени заняла самая длительная терапия среди ваших клиентов? <span
                class="color-red">*</span></p>
            <div class="mw400">
                <block-input :label="'Введите ответ'" v-model="form['longest_consultation']"
                             :errors="errors['longest_consultation']"></block-input>
            </div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Проходите ли вы личную психотерапию? <span class="color-red">*</span></p>
            <div class="flex mb10 flex_5 flex-wrap">
                <div class="col0 col_5">
                    <label class="st-checkbox1 mb10">
                        <input type="radio" v-model="form['psychotherapy']" :value="1">
                        <span class="st-checkbox1__label">
                            <span class="st-checkbox1__name">Да</span>
                        </span>
                    </label>
                </div>
                <div class="col0 col_5">
                    <label class="st-checkbox1 mb10">
                        <input type="radio" v-model="form['psychotherapy']" :value="0">
                        <span class="st-checkbox1__label">
                            <span class="st-checkbox1__name">Нет</span>
                        </span>
                    </label>
                </div>
            </div>
            <p v-if="errors['psychotherapy']" class="text-error">{{ errors['psychotherapy'][0] }}</p>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Проходите ли вы регулярные супервизии? <span class="color-red">*</span></p>
            <div class="flex mb10 flex_5 flex-wrap">
                <div class="col0 col_5">
                    <label class="st-checkbox1 mb10">
                        <input type="radio" v-model="form['supervision']" :value="1">
                        <span class="st-checkbox1__label">
                            <span class="st-checkbox1__name">Да</span>
                        </span>
                    </label>
                </div>
                <div class="col0 col_5">
                    <label class="st-checkbox1 mb10">
                        <input type="radio" v-model="form['supervision']" :value="0">
                        <span class="st-checkbox1__label">
                            <span class="st-checkbox1__name">Нет</span>
                        </span>
                    </label>
                </div>
            </div>
            <p v-if="errors['supervision']" class="text-error">{{ errors['supervision'][0] }}</p>
        </div>
        <vue-slide-up-down :active="form['supervision'] === 1" name="slide">
            <div class="bb1 pb40 mb40">
                <p class="fz22 mb20 fw600 lh15">Пожалуйста, напишите имя вашего супервизора <span
                    class="color-red">*</span></p>
                <block-input :label="'Введите ответ'" v-model="form['supervisor']"
                             :errors="errors['supervisor']"></block-input>
            </div>
        </vue-slide-up-down>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Есть ли другая работа кроме психотерапевтической практики? Как
                распределяются интересы и приоритеты? <span class="color-red">*</span></p>
            <block-input :label="'Введите ответ'"
                         v-model="form['other_work']"
                         :errors="errors['other_work']"
                         :textarea="true">
            </block-input>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Расскажите немного о себе <span class="color-red">*</span></p>
            <block-input :label="'Введите ответ'"
                         v-model="form['about']"
                         :errors="errors['about']"
                         :textarea="true">
            </block-input>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Ссылка на профили в социальных сетях <span class="color-red">*</span></p>
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
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb10 fw600 lh15">Прикрепите вашу фотографию <span class="color-red">*</span></p>
            <p class="fz17 mb20 lh15">1. Цветная; <br>2. Лицо по центру и хорошо освещено;<br> 3. Размер не более 2МБ
            </p>
            <block-photo v-model="photo">
            </block-photo>
            <p v-if="errors['photo']" class="text-error">{{ errors['photo'][0] }}</p>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Пол <span class="color-red">*</span></p>
            <div class="flex mb10 flex_5 flex-wrap">
                <div class="col0 col_5">
                    <label class="st-checkbox1 mb10">
                        <input type="radio" v-model="form['gender']" :value="'male'">
                        <span class="st-checkbox1__label">
                            <span class="st-checkbox1__name">Муж</span>
                        </span>
                    </label>
                </div>
                <div class="col0 col_5">
                    <label class="st-checkbox1 mb10">
                        <input type="radio" v-model="form['gender']" :value="'female'">
                        <span class="st-checkbox1__label">
                            <span class="st-checkbox1__name">Жен</span>
                        </span>
                    </label>
                </div>
            </div>
            <p v-if="errors['supervision']" class="text-error">{{ errors['gender'][0] }}</p>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Номер телефона <span class="color-red">*</span></p>
            <div class="mw400">
                <block-input :label="'Введите ответ'" :type="'tel'" v-model="form['phone']"
                             :errors="errors['phone']"></block-input>
            </div>
        </div>
        <div class="bb1 pb40 mb40">
            <p class="fz22 mb20 fw600 lh15">Адрес электронной почты <span class="color-red">*</span></p>
            <div class="mw400">
                <block-input :label="'Введите ответ'" :type="'email'" v-model="form['email']"
                             :errors="errors['email']"></block-input>
            </div>
        </div>
        <div>
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
        <p class="text-error" v-if="errorOther">Произошла ошибка. Попробуйте обновить страницу</p>
        <button @click="save" class="btn btn_transformed">Отправить анкету</button>
    </div>
</template>

<script>
export default {
    name: "FormPsychologistRegister",
    props: {
        directions: Array,
        user: Object
    },
    data() {
        return {
            errors: {},
            diplomas: {},
            photo: {},
            errorOther: false,
            form: this.user || {},
        }
    },
    mounted() {
        this.addEducation();
    },
    methods: {
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
            for (let i in this.diplomas['images']) {
                formData.append('diplomas[]', this.diplomas['images'][i]);
            }
            if (Object.keys(this.photo).length)
                formData.append('photo', this.photo['image']);
            axios.post(route('psychologists.store'), formData, {
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
            window.location = route('account.index');
        },
        showError(err) {
            $('.preloader').hide();
            if (err.response.status == 422)
                this.errors = err.response.data.errors;
            else
                this.errorOther = true;
            scrollToError();
        }
    }
}
</script>

<style scoped>

</style>
