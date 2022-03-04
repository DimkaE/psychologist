<template>
    <div>
        <div class="bb1 pb40 mb30" id="al-b02-1">
            <p class="fz26 fw600 mb20">Предстоящие сессии</p>
            <div v-if="unusedPayments" class="mb20 fz20 fw600">
                <p class="mb10 fz20 fw600">У вас оплачено сессий: {{ unusedPayments }}</p>
                <a class="link link-green" :href="route('search')">Назначить консультацию</a>
            </div>
            <p class="fz20 mb20 text-error" v-if="errorOther">{{ errorOther }}</p>
            <p class="mb20 text-error" v-if="errors['datetime']">{{ errors['datetime'][0] }}</p>

            <div class="al-b02__card mb20" v-for="record in records">
                <p class="color-green fz24 fw600 mb10">{{ record['date'] }}, {{ record['time'] }}</p>
                <p class="fz19 fw600 lh13">
                    {{ record['psychologist']['name'] }} {{ record['psychologist']['last_name'] }}
                </p>
                <p class="fz17 lh15 mb10">{{ record['line1'] }}</p>
                <p class="color-dark fz15 mb20">{{ record['line2'] }}</p>
                <div v-if="record['status'] == 1" class="mb10">
                    <p class="color-red fz17 lh15 mb10">Консультация не оплачена!</p>
                    <a class="btn" :href="route('payments.create', {'consultation_id': record['id']})">Перейти к
                        оплате</a>
                </div>
                <p class="color-red fz17 lh15 mb10" v-if="record['status'] == 10">Вы отменили сеанс</p>
                <p class="color-red fz17 lh15 mb10" v-if="record['status'] == 20">Психолог отменил сеанс</p>
                <div class="flex flex-v-center flex-wrap-768">
                    <div class="col0 col12-768 mb10" v-if="record['mutable']">
                        <a href="#" class="btn2 btn2_small" data-fancybox
                           data-src="#modal-cancel" @click="setEditableRecord(record['id'])">
                            <svg width="1.2rem" height="1.2rem">
                                <use xlink:href="#ico-close"></use>
                            </svg>
                            <span>Отменить сеанс</span>
                        </a>
                    </div>
                    <div class="col0 col12-768 mb10" v-if="record['mutable']">
                        <a href="#" class="btn2 btn2_small" data-fancybox
                           data-src="#modal-choose-psychologist-date" @click="setEditableRecord(record['id'])">
                            <svg width="1rem" height="1rem" class="mr5">
                                <use xlink:href="#ico-forward"></use>
                            </svg>
                            <span>Перенести сеанс</span>
                        </a>
                    </div>
                    <div class="col0 col12-768 mb10" v-else>
                        <p class="btn2 btn2_small btn2_disabled">
                            <span>Перенос и отмена невозможны</span>
                        </p>
                    </div>
                    <div class="col0  col12-768 mb10 flex-full text-right">
                        <p class="fz15 color-gray2">№{{ record['id'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modal-choose-psychologist-date"
             style="display: none">
            <div class="bb1 pb40 mb40">
                <p class="fz19 fw600 lh13" v-if="Object.keys(editableRecord).length">
                    {{ editableRecord['psychologist']['name'] }} {{ editableRecord['psychologist']['last_name'] }}</p>
                <p class="fz17 lh15 mb10">{{ editableRecord['line1'] }}</p>
                <p class="color-dark fz15 mb20">{{ editableRecord['line2'] }}</p>
                <p class="fz15 color-gray2">№{{ editableRecord['id'] }}</p>
            </div>
            <p class="fz26 fw600 mb5">Выберите дату и время</p>
            <p class="fz18 mb20">Время приема по московскому времени <span class="fw600">(MSK+0)</span></p>
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
                            <date-picker :available-dates="psychologistAvailableDatesToCalendar"
                                         :color="'green'"
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
                <button class="btn btn_transformed" @click="changeConsultation">
                    Выбрать время
                </button>
            </div>
        </div>

        <div class="modal" id="modal-cancel" style="display: none">
            <div class="bb1 pb40 mb30">
                <p class="fz19 fw600 lh13" v-if="Object.keys(editableRecord).length">
                    {{ editableRecord['psychologist']['name'] }} {{ editableRecord['psychologist']['last_name'] }}</p>
                <p class="fz17 lh15 mb10">{{ editableRecord['line1'] }}</p>
                <p class="color-dark fz15 mb20">{{ editableRecord['line2'] }}</p>
                <p class="fz15 color-gray2">№{{ editableRecord['id'] }}</p>
            </div>
            <p class="fz26 fw600 mb5">Вы точно хотите отменить сеанс?</p>
            <div v-if="editableRecord['mutable']">
                <p class="fz18 lh15 mb20">Если выбрано неудобное время, вы можете сделать
                    перенос на более удачную дату.</p>
                <a href="#" class="link link-green fz18 fw600 flex1 flex-v-center" data-fancybox
                   data-src="#modal-choose-psychologist-date">
                    <svg width="1.2rem" height="1.2rem" class="mr5">
                        <use xlink:href="#ico-calendar"></use>
                    </svg>
                    Перенести дату сеанса
                </a>
            </div>
            <div class="flex flex-center">
                <button class="btn btn_red btn_transformed" @click="cancelConsultation()">
                    Отменить сеанс
                </button>
            </div>
        </div>

        <div id="al-b02-2">
            <p class="fz26 fw600 mb20">Завершенные сессии</p>
            <p class="fz18 mb10">Здесь вы можете посмотреть архив записей на прием по датам</p>
            <div class="mb20 mw500">
                <block-date v-model="oldRecordsDate"></block-date>
            </div>
            <div class="al-b02__card mb20" v-for="record in recordsFinished"
                 v-if="!oldRecordsDate || oldRecordsDate == record['date']">
                <p class="color-gray2 fz24 fw600 mb10">{{ record['date'] }}, {{ record['time'] }}</p>
                <p class="fz19 fw600 lh13">
                    {{ record['psychologist']['name'] }} {{ record['psychologist']['last_name'] }}
                </p>
                <p class="fz17 lh15 mb10">{{ record['line1'] }}</p>
                <p class="color-dark fz15">{{ record['line2'] }}</p>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "FormUserSchedule",
    data() {
        return {
            errors: {},
            records: Array,
            recordsFinished: Array,
            editableRecord: {},
            psychologistAvailableDates: [],
            psychologistAvailableDatesToCalendar: [],
            psychologistAvailableTimes: [],
            psychologistDate: '',
            psychologistTime: '',
            today: new Date(),
            allTimes: window.allTimes,
            unusedPayments: 0,
            oldRecordsDate: '',
            errorOther: '',
        }
    },
    mounted() {
        this.getRecords();
        this.getUnusedPayments();
    },
    watch: {
        psychologistDate: function () {
            $('.dropdown__body').hide()
            $('.dropdown').removeClass('dropdown_opened')
            this.updatePsychologistTimes();
        },
    },
    methods: {
        getRecords() {
            axios.get(route('consultations.list'))
                .then((response) => {
                    $('.preloader').hide();
                    this.records = response.data.records
                    this.recordsFinished = response.data.recordsFinished

                })
                .catch((err) => {
                    console.log(err)
                    this.showError(err);
                });
        },
        setEditableRecord(id) {
            this.editableRecord = {};
            for (let i in this.records) {
                if (this.records[i]['id'] == id)
                    this.editableRecord = this.records[i]
            }
            this.getPsychologistDates();
        },
        getPsychologistDates() {
            let raw_dates = [];
            axios.get(route('consultations.available_dates') + `?id=${this.editableRecord['psychologist_id']}`)
                .then((response) => {
                    console.log(response)
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
                        this.errorFirstForm = 'Все расписание занято. Попробуйте выбрать другого специалиста.';
                    }
                })
                .catch((err) => {
                    console.log(err)
                    this.errorFirstForm = 'Произошла ошибка. Попробуйте обновить страницу';
                });
        },
        updatePsychologistTimes() {
            this.psychologistAvailableTimes = [];
            axios.get(route('consultations.available_times') + `?id=${this.editableRecord['psychologist_id']}&date=${formatDateInput(this.psychologistDate)}`)
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
        formatDateLocal(date) {
            return formatDate(date);
        },
        formatTimeLocal(i) {
            return formatTime(i)
        },
        cancelConsultation() {
            $('.preloader').show();
            axios.post(route('consultations.cancel'), prepareFormData({'consultation_id': this.editableRecord['id']}))
                .then(() => {
                    $('.preloader').hide();
                    window.closeModal();
                    this.getRecords();
                    this.getUnusedPayments();
                })
                .catch((err) => {
                    $('.preloader').hide();
                    console.log(err)
                });
        },
        closeModalLocal() {
            window.closeModal()
        },
        getUnusedPayments() {
            axios.get(route('payments.unused'))
                .then((response) => {
                    console.log(response.data)
                    this.unusedPayments = response.data;
                })
                .catch((err) => {
                    console.log(err)
                });
        },
        changeConsultation() {
            window.closeModal();
            $('.preloader').show();
            this.psychologistDate.setHours(this.psychologistTime, 0, 0);
            let data = {
                'id': this.editableRecord['id'],
                'datetime': formatDateTime(this.psychologistDate),
            };
            axios.patch(route('consultations.update', this.editableRecord['id']), JSON.stringify(data))
                .then((response) => {
                    $('.preloader').hide();
                    this.getRecords();
                    this.getUnusedPayments();
                })
                .catch((err) => {
                    console.log(err)
                    this.showError(err);
                });
        },
        showError(err) {
            $('.preloader').hide();
            if (err.response.status == 422)
                this.errors = err.response.data.errors;
            else {
                this.errorOther = 'Произошла ошибка, попробуйте обновить страницу';
                let component = this;
                setTimeout(function () {
                    component.errorOther = '';
                }, 5000)
            }
            scrollToError();
        },
    }
}
</script>

<style scoped>

</style>
