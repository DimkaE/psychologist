<template>
    <div>
        <div class="st-input1" :class="classObject">
            <label v-if="label" class="st-input1__label">{{ label }}</label>
            <svg class="st-input1__svg" v-if="svg">
                <use :xlink:href="'#' + svg"></use>
            </svg>
            <textarea v-if="this.textarea" v-model="valueLocal" class="st-input1__input" :class="[!svg ? 'st-input1__input_nopadding' : '']"
                      @focus="focusInput" @blur="blurInput" @keyup.enter="pressedEnter"></textarea>
            <date-picker v-else-if="typeLocal == 'date'" v-model="valueLocal" class="flex-grow">
                <template v-slot="{ inputValue, inputEvents }">
                    <input
                        :value="inputValue"
                        v-on="inputEvents"
                        class="st-input1__input"
                        :class="[input_class ? input_class : '']"
                        @focus="focusInput"
                        @blur="blurInput"/>
                </template>
            </date-picker>
            <input v-else
                   :type="typeLocal"
                   class="st-input1__input"
                   :class="[input_class ? input_class : '']"
                   :name = "name"
                   v-model="valueLocal"
                   @focus="focusInput"
                   @blur="blurInput">
        </div>
        <div class="st-input1__error" v-if="this.errorsLocal">{{ this.errorsLocal[0] }}</div>
    </div>
</template>

<script>
export default {
    name: "BlockInput",
    props: {
        input_class: String,
        label: String,
        textarea: Boolean,
        input_phone: Boolean,
        errors: Array,
        type: String,
        value: [String, Number, Date],
        svg: String,
        name: String | '',
    },

    data() {
        return {
            valueLocal: '',
            focused: false,
            phone_valid: false,
            errorsLocal: this.errors,
            typeLocal: this.type || 'text'
        }
    },

    mounted() {
        this.valueLocal = this.value || '';
    },
    methods: {
        togglePassword() {
            if (this.type == 'password') {
                this.typeLocal = (this.typeLocal == 'password') ? 'text' : 'password';
            }
        },
        focusInput() {
            this.focused = true
        },
        blurInput() {
            this.focused = false;
        },
        pressedEnter() {
            this.$emit('pressedEnter', '')
        },
        validPhone(phone, msg) {
            console.log(msg)
            this.phone_valid = msg.valid;
            if (msg.valid) {
                if (this.valueLocal && this.valueLocal.length)
                    this.errorsLocal = [];
                this.$emit('input', msg.number)
            } else {
                this.$emit('input', '')
            }
        },
        emitValue() {
            if (this.valueLocal && this.valueLocal.length)
                this.errorsLocal = [];
            this.$emit('input', this.valueLocal);
        }
    },
    watch: {
        valueLocal: function () {
            if (!this.input_phone) {
                this.emitValue();
            }
        },
        value: function () {
            this.valueLocal = this.value;
        },
        errors: function () {
            this.errorsLocal = this.errors;
        }
    },
    computed: {
        classObject: function () {
            let filled = this.valueLocal || this.focused;
            if (this.input_phone)
                filled = true;
            return {
                'st-input1_error': (this.errorsLocal && this.errorsLocal.length) || (this.input_phone && !this.phone_valid),
                'st-input1_focused': this.focused,
                'st-input1_filled': filled,
                'st-input1_phone': this.input_phone,
                'st-input1_nopadding' : !this.svg
            }
        }
    },
}
</script>

<style scoped>

</style>
