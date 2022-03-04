<template>
    <select :multiple="multiple" v-if="group">
        <optgroup v-if="enabled && enabled.length" v-for="group in localOptions" :label="group['name']">
            <option v-for="(item, index) in group.items" v-if="enabled.indexOf(parseInt(index)) >= 0"
                    v-bind:value="index">{{ item['name'] }}
            </option>
        </optgroup>
        <optgroup v-for="group in localOptions" :label="group['name']">
            <option v-if="!enabled || enabled.indexOf(parseInt(index)) == -1"
                    :class="[enabled && enabled.length ? 'select1__disabled' : '']" v-for="(item, index) in group.items"
                    v-bind:value="index">{{ item['name'] }}
            </option>
        </optgroup>
    </select>
    <select v-else :multiple="multiple" :disabled="disabled">
        <option
            :disabled="disabled_options && disabled_options.length && disabled_options.indexOf(parseInt(index)) >= 0"
            v-for="(option, index) in localOptions" v-bind:value="option[trackBy]">
            {{ option[label] }}
        </option>
    </select>
</template>

<script>
export default {
    props: {
        enabled: Array,
        disabled_options: Array,
        value: {
            type: [String, Number, Array, Object],
            default: null
        },
        options: {
            type: [Array, Object],
            default: () => []
        },
        label: {
            type: String,
            default: 'name'
        },
        trackBy: {
            type: String,
            default: 'id'
        },
        multiple: {
            type: Boolean,
            default: false
        },
        group: {
            type: Boolean,
            default: false
        },
        placeholder: {
            type: String,
            default: 'Select'
        },
        searchable: {
            type: Boolean,
            default: true
        },
        searchableMin: {
            type: Number,
            default: 1
        },
        allowEmpty: {
            type: Boolean,
            default: true
        },
        allowAll: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        onValueReturn: {
            type: Object,
            default: () => ({})
        }
    },

    methods: {
        selectDisabled($event, selected) {
            if (selected['selected'] !== 'undefined') {
                let select = $($event.target),
                    option = select.find('option[value="' + selected['selected'] + '"]');
                if (option.hasClass('select1__disabled')) {
                    Swal.fire({
                        text: this.$t('confirm_transport'),
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#ddd',
                        confirmButtonText: this.$t('text.yes'),
                        cancelButtonText: this.$t('text.no')
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            option.prop("selected", false);
                            select.trigger("chosen:updated");
                        }
                    })
                }
            }
        }
    },

    computed: {
        localOptions() {
            if (this.group)
                return this.options;
            let vm = this,
                options = []

            if (this.allowAll) {
                options.push({
                    [this.trackBy]: -1,
                    [this.label]: 'All'
                })
            }

            if (Array.isArray(this.options)) {
                return options.concat(this.options)
            }

            Object.keys(this.options).forEach(function (key) {
                options.push({
                    [vm.trackBy]: key,
                    [vm.label]: vm.options[key]
                })
            })

            return this.allowEmpty
                ? [{[this.trackBy]: null, [this.label]: ''}].concat(options)
                : options
        },

        localValue() {
            let value = this.allowAll && this.value === null ? -1 : this.value

            this.$nextTick(function () {
                $(this.$el).val(value).trigger("chosen:updated")
            })

            return value
        }
    },

    watch: {
        localValue() {
        },

        disabled_options: function () {
            let component = this;
            setTimeout(function () {
                $(component.$el).trigger('change').trigger("chosen:updated")

            }, 100)
        },

        localOptions() {
            this.$nextTick(function () {
                let value = this.allowAll && this.value === null ? '-1' : this.value
                $(this.$el).val(value).trigger("chosen:updated")
            })
        }
    },

    mounted() {
        let component = this

        $(this.$el).chosen({
            width: "100%",
            disable_search_threshold: 100,
            placeholder_text_multiple: "Выберите несколько",
            placeholder_text_single: "Выберите",
            no_results_text: 'Ничего не найдено',
        }).change(function ($event, params) {
            const value = $($event.target).val();
            if (component.enabled && component.enabled.length) {
                component.selectDisabled($event, params);
            }
            if (typeof component.onValueReturn[value] !== 'undefined') {
                return component.$emit('input', component.onValueReturn[value])
            }
            if (component.allowAll && ($($event.target).val() === '-1' || $($event.target).val() === -1)) {
                return component.$emit('input', null)
            }
            component.$emit('input', $($event.target).val())
        })

    }
}
</script>
