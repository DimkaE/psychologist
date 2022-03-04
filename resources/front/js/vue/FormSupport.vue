<template>
    <div class="modal" id="modal-support" style="display: none">
        <div v-if="formSent">
            <p class="fz20 lh13 fw600 mb60">Ваше сообщение отправлено.<br> Мы пришлем ответ на E-mail адрес, указанный в вашем
                профиле</p>
        </div>
        <div v-else>
            <p class="fz20 lh13 fw600 mb5  mb20">Напишите нам, если у вас возникли какие-то проблемы</p>
            <block-input :label="'Ваш вопрос'"
                         v-model="message"
                         :textarea="true">
            </block-input>
            <div class="flex flex-center">
                <button class="btn btn_transformed" @click.prevent="send">
                    Отправить сообщение
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormSupport",
    data() {
        return {
            formSent: false,
            message: ''
        }
    },
    methods: {
        send() {
            if (this.message) {
                axios.post(route('account.message'), prepareFormData({'message': this.message}))
                    .then(() => {
                        $('.preloader').hide();
                        this.formSent = true;
                    })
                    .catch((err) => {
                        $('.preloader').hide();
                        console.log(err)
                    });
            }
        }
    }
}
</script>

<style scoped>

</style>
