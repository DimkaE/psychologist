<template>
    <div>
        <div class="relative form-item form-item_select"
             :class="[(this.errorLocal && this.errorLocal.length) ? 'form-item_select_error': '']">
            <vue-chosen v-model="selected" :group="group" :multiple="multiple" :options="this.values"></vue-chosen>
        </div>
        <div class="form-item_select__error" v-if="this.errorLocal">{{ this.errorLocal[0] }}</div>
    </div>
</template>

<script>
export default {
    name: "BlockSelect",
    props: {
        enabled: Array,
        disabled_options: Array,
        label: String,
        values: {},
        value: [] || '',
        error: Array,
        group: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        },
    },
    data() {
        let empty_value = this.multiple ? [] : '';
        return {
            selected: this.value || empty_value,
            label_top: false,
            errorLocal: this.error
        }
    },
    mounted() {
        this.changeValue();
    },
    methods: {
        changeValue() {
            if (this.selected && this.selected.length)
                this.errorLocal = [];
            this.$emit('input', this.selected)
            jQuery(this.$refs['select1']).trigger('chosen:updated')
        }
    },
    watch: {
        selected: function () {
            this.changeValue();
        },
        value: function () {
            this.selected = this.value;
            this.changeValue();
        },
        error: function () {
            this.errorLocal = this.error;
        },
    }
}
</script>

<style scoped>

</style>
