<template>
    <div>

        <div class="bb1 pb40 mb30" id="ad-b02-2">
            <div class="mw500">
                <p class="fz26 fw600 mb10">Персональные данные</p>
                <p class="fz18 lh16 mb30">Все поля в этом блоке обязательны для заполнения</p>
                <div class="mb20">
                    <block-input :label="'Имя'"
                                 :svg="'ico-login'"
                                 v-model="form['name']"
                                 :errors="errors['name']">
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
    name: "FormUserData",
    props: {
        user: Object,
    },
    data() {
        return {
            form: this.user,
            errors: {},
            photo: {},
            showDestroy: false,
            errorDelete: '',
        }
    },
    methods: {
        formatTimeLocal(i) {
            return formatTime(i)
        },

        save() {
            $('.preloader').show();
            axios.post(route('customers.update'), prepareFormData(this.form))
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
            axios.delete(route('customers.destroy'))
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
