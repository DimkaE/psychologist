<template>
    <div class="relative dropdown">
        <div class="btn2 dropdown__header">

            <div class="flex-full">{{ date || 'Выбрать дату' }}</div>
            <svg width=".6rem" height=".35rem" class="mr5 color-gray2">
                <use xlink:href="#ico-arrow-down"></use>
            </svg>
        </div>
        <div class="dropdown__body">
            <date-picker :max-date="new Date()" :color="'green'"
                         mode="date"
                         v-model="date_raw"></date-picker>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlockDate",
    data() {
        return {
            date: '',
            date_raw: '',
        }
    },
    watch: {
        date_raw: function () {
            this.date = this.formatDateLocal(this.date_raw);
            $('.dropdown__body').hide()
            $('.dropdown').removeClass('dropdown_opened');
            this.$emit('input', this.date);
        }
    },
    methods: {
        formatDateLocal(date) {
            return formatDate(date);
        },
    }
}
</script>

<style scoped>

</style>
