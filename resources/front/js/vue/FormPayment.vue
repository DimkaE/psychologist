<template>
    <div>
        <div class="container-small cl-b03">
            <div class="white-bg white-bg_thin text-center">
                <p class="text-center fz45 fw800 lh12 mb10">Оплата сессии</p>
                <div class="flex1 flex-v-center mb5 flex-center">
                    <img class="cl-b06__img mr10 mb10" :src="consultation['psychologist']['ava30']"
                         alt="">
                    <p class="fz18 mr10 mb10">Психолог:</p>

                    <p class="fz18 fw600 mr10 mb10">{{ consultation['psychologist']['name'] }}
                        {{ consultation['psychologist']['last_name'] }}</p>
                    <p class="fz18 mb10">Время сессии:
                        {{ consultation['date'] }} в
                        {{ consultation['time'] }}</p>
                </div>
                <div class="mw500 payment-form">
                    <div class="mb20">
                        <block-input v-model="form['number']"
                                     :label="'Номер карты'"
                                     :input_class="'card_number'"
                                     :errors="errors['card_number']">
                        </block-input>
                    </div>
                    <div class="mb20">
                        <block-input v-model="form['name']"
                                     :label="'Имя владельца'"
                                     :errors="errors['card_name']">
                        </block-input>
                    </div>
                    <div class="flex">
                        <div class="col6">
                            <div class="mb20">
                                <block-input v-model="form['date']"
                                             :label="'ММ/ГГ'"
                                             :input_class="'card_date'"
                                             :errors="errors['card_date']">
                                </block-input>
                            </div>
                        </div>
                        <div class="col6">
                            <div class="mb20">
                                <block-input v-model="form['cvc']"
                                             :label="'CVC'"
                                             :input_class="'card_cvc'"
                                             :errors="errors['card_cvc']">
                                </block-input>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-error" v-if="cardError">{{ cardError }}</p>
                <button @click="send" class="btn btn_transformed" v-if="price > 0">
                    Оплатить {{ price }} лев
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormPayment",
    props:{
        consultation: {},
        price: 0,
    },
    data() {
        return {
            form: {
                'promocode':new URLSearchParams(window.location.search).get('promocode'),
                'consultation_id': this.consultation['id']
            },
            cardError: '',
            errors:{}
        }
    },
    methods: {
        formatDateLocal(date) {
            return formatDate(date);
        },
        formatTimeLocal(i) {
            return formatTime(i)
        },
        send(){
            this.cardError = '';
            $('.preloader').show();
            axios.post(route('payments.store'), prepareFormData(this.form), {
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
                    if (response.data.success) {

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
        showError(err) {
            $('.preloader').hide();
            if (err.response.status == 422)
                this.errors = err.response.data.errors;
            else
                this.errorFirstForm = 'Произошла ошибка, попробуйте обновить страницу';
            scrollToError();
        },
    }
}
</script>

<style scoped>

</style>
