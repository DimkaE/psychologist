<template>
  <div class="slider flex1">
    <div class="slider__value fz18 flex1" ref="value0">
      <div class="mr5">от</div>
      <div class="fw600" id="ageSlider__val0">{{ this.value_min }}</div>
    </div>
    <div class="flex-full slider__wrap">
      <div ref="silder"></div>
    </div>
    <div class="slider__value fz18 flex1" ref="value1">
      <div class="mr5">до</div>
      <div class="fw600" id="ageSlider__val1">{{ this.value_max }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BlockSlider",
  props: {
    min: Number,
    max: Number,
  },
  data() {
    return {
      value_min: this.min,
      value_max: this.max,
      slider: null,
    }
  },
  mounted() {
    this.initSlider();
  },
  methods: {
    initSlider() {
      let vue = this;
      this.slider = noUiSlider.create(this.$refs["silder"], {
        start: [
          this.min,
          this.max
        ],
        range: {
          'min': [this.min],
          'max': [this.max]
        },
        step: 1,
        connect: [false, true, false],
        format: wNumb({
          decimals: 0,
        })
      });

      this.slider.on('update', function (values, handle) {
        vue.value_min = values[0];
        vue.value_max = values[1];
        vue.changeValue()
      });

      this.slider.on('start', function (values, handle) {
        $(vue.$refs["value" + handle]).addClass('slider__value_active')
      });

      this.slider.on('end', function (values, handle) {
        $(vue.$refs["value" + handle]).removeClass('slider__value_active')
      });
    },
    changeValue() {
      this.$emit('input', {
        min: (this.value_min != this.min) ? this.value_min : '',
        max: (this.value_max != this.max) ? this.value_max : ''
      });
    }
  }
}
</script>

<style scoped>

</style>
