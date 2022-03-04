<template>
    <div id="uploadImagesList">
        <div class="photo relative">
            <div v-if="image_old && !file['thumb1']" class="photo__image"
                 v-bind:style="{ 'background-image': 'url(' + image_old + ')' }"></div>
            <div v-else-if="file && file['thumb1']" class="photo__image"
                 v-bind:style="{ 'background-image': 'url(' + file['thumb1'] + ')' }"></div>
            <div v-else class="photo__image"
                 v-bind:style="{ 'background-image': 'url(/images/avatar.png)' }"></div>
            <div class="flex flex-center">
                <label class="photo__change">
                    <input type="file" id="addImage" ref="file" v-on:change="uploadFile(0)">

                    <svg width="1rem" height="1rem" class="mr5">
                        <use xlink:href="#ico-noimage"></use>
                    </svg>
                    <span class="color-dark fz16 fw800">{{ (image_old || Object.keys(this.file).length) ? 'Заменить' : 'Выбрать' }}</span>

                </label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BlockPhoto",
    props: {
        image_old: String
    },
    data() {
        return {
            file: {},
            image: {}
        }
    },
    mounted() {

    },
    methods: {
        uploadFile() {
            console.log(this.$refs.file.files)
            this.file = this.$refs.file.files[0];
            this.preview(this.file);
        },
        preview(file) {
            let component = this;
            if (!file.type.match(/image\/(jpeg|jpg|png|gif)/)) {
                window.showModalError('Выбранный файл не является изображением')
            }
            if (file.size > window.maxFileSize) {
                window.showModalError('Размер файла должен быть не более 2Мб')
            }
            let reader = new FileReader();
            reader.addEventListener('load', function (event) {
                component.file = {
                    'id': file.name,
                    'thumb1': event.target.result,
                    'file': file,
                }
                component.image = file;
                component.changeValue();
            });
            reader.readAsDataURL(file);
        },
        changeValue() {
            this.$emit('input', {
                "image": this.image,
            })
        },
    }
}
</script>

<style scoped>
.photo{
    width:10rem;
}
.photo input{
    width:1px;
    height:1px;
    overflow:hidden;
    position:absolute;
}
.photo__image{
    height:10rem;
    width:10rem;
    border-radius:.8rem;
    background-color:#ccc;
    background-position:center;
    background-size:cover;
}
.photo__change{
    background:#FFFFFF;
    box-shadow:0px 4px 12px rgba(43, 51, 45, 0.1);
    border-radius:1.6rem;
    display:flex;
    align-items:center;
    padding:.7rem 1.5rem;
    transform:translateY(-50%);
    cursor:pointer;
}
</style>
