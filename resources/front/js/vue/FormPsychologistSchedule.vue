<template>
    <div>
        <div class="bb1 pb40 mb30" id="al-b02-1">
            <div class="bb1 pb40 mb30">
                <div class="flex">
                    <div class="col0 flex-full">
                        <p class="fz26 fw600 mb10">Приостановить прием</p>
                        <p class="fz16 lh15">На это время мы перестанем рекомендовать вас пациентам</p>
                    </div>
                    <div class="col0 flex-none">
                        <label class="st-checkbox2">
                            <input type="checkbox" v-model="accountDisabledLocal">
                            <span class="st-checkbox2__field">
                                <span class="st-checkbox2__btn"></span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
            <p class="fz26 fw600 mb20">Предстоящие сессии</p>
            <p class="color-red fz20 mb20" v-if="errorOther">{{ errorOther }}</p>
            <div class="al-b02__tabs mb30">
                <div class="flex1">
                    <a v-for="futureDate in futureDates" class="al-b02__btn block link" @click="recordsDate = futureDate" :class="[recordsDate == futureDate ? 'selected' : '']">{{ futureDate }}</a>
                </div>
            </div>
            <div class="al-b02__card mb20" v-for="record in records" v-if="!recordsDate || recordsDate == record['date']">
                <p class="color-green fz24 fw600 mb10">{{ record['date'] }}, {{ record['time'] }}</p>
                <p class="fz19 fw600 lh13">
                    {{ record['client']['name'] }}
                </p>
                <p class="fz17 lh15 mb10">{{ record['line1'] }}</p>
                <p class="color-dark fz15 mb20">{{ record['line2'] }}</p>
                <p class="color-red fz17 lh15 mb10" v-if="record['status'] == 1">Консультация не оплачена!</p>
                <p class="color-red fz17 lh15 mb10" v-if="record['status'] == 10">Клиент отменил сеанс</p>
                <p class="color-red fz17 lh15 mb10" v-if="record['status'] == 20">Вы отменили сеанс</p>
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
                    <div class="col0 col12-768 mb10" v-else>
                        <p class="btn2 btn2_small btn2_disabled">
                            <span>Отмена невозможна</span>
                        </p>
                    </div>
                    <div class="col0  col12-768 mb10 flex-full text-right">
                        <p class="fz15 color-gray2">№{{ record['id'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modal-cancel" style="display: none">
            <div class="bb1 pb40 mb30">
                <p class="fz19 fw600 lh13" v-if="Object.keys(editableRecord).length">{{
                        editableRecord['client']['name']
                    }}</p>
                <p class="fz17 lh15 mb10">{{ editableRecord['line1'] }}</p>
                <p class="color-dark fz15 mb20">{{ editableRecord['line2'] }}</p>
                <p class="fz15 color-gray2">№{{ editableRecord['id'] }}</p>
            </div>
            <p class="fz26 fw600 mb5">Вы точно хотите отменить сеанс?</p>
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
                    {{ record['client']['name'] }}
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
    props:{
        accountEnabled: String
    },
    data() {
        return {
            records: Array,
            recordsFinished: Array,
            editableRecord: {},
            today: new Date(),
            allTimes: window.allTimes,
            futureDates: [],
            oldRecordsDate: '',
            recordsDate: '',
            errorOther: '',
            accountDisabledLocal: !parseInt(this.accountEnabled),
        }
    },
    mounted() {
        this.getRecords();
    },
    watch: {
        accountDisabledLocal: function (){
            console.log(this.accountDisabledLocal)
            axios.post(route('psychologists.enable'),prepareFormData({'enabled': this.accountDisabledLocal ? 0 : 1}))
                .then(() => {
                    $('.preloader').hide();
                })
                .catch((err) => {
                    $('.preloader').hide();
                    console.log(err)
                });
        }
    },
    methods: {
        getRecords() {
            axios.get(route('consultations.list'))
                .then((response) => {
                    $('.preloader').hide();
                    this.records = response.data.records
                    this.recordsFinished = response.data.recordsFinished;
                    this.getFutureDates();

                })
                .catch((err) => {
                    console.log(err)
                    this.showError(err);
                });
        },
        getFutureDates() {
            for (let i in this.records) {
                if (this.futureDates.indexOf(this.records[i]['date']) === -1)
                    this.futureDates.push(this.records[i]['date'])
            }
        },
        setEditableRecord(id) {
            this.editableRecord = {};
            for (let i in this.records) {
                if (this.records[i]['id'] == id)
                    this.editableRecord = this.records[i]
            }
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
                })
                .catch((err) => {
                    $('.preloader').hide();
                    console.log(err)
                });
        },
        closeModalLocal() {
            window.closeModal()
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
