<template>
    <div class="flex flex_5 flex-wrap" id="uploadImagesList">
        <div class="mb10 col2 col_5 col4-768 col6-550" v-for="file in this.old_images">
            <div class="photo1__wrap photo1__wrap-main"
                 v-bind:style="{ 'background-image': 'url(' + file['thumb1'] + ')' }">
                <input type="hidden" v-model="old_images">
                <a href="#" class="photo1__remove" @click.prevent="removeOldItem(file['id'])">&times;</a>
            </div>
        </div>
        <div class="mb10 col2 col_5 col4-768 col6-550" v-for="file in this.files">
            <div class="photo1__wrap photo1__wrap-main"
                 v-bind:style="{ 'background-image': 'url(' + file['thumb1'] + ')' }">
                <input type="hidden" v-model="old_images">
                <a href="#" class="photo1__remove" @click.prevent="removeItem(file['id'])">&times;</a>
            </div>
        </div>
        <label class="col2 col_5 col4-768 mb10 photo1__wrap-add col6-550" v-if="totalImages < max">
            <input type="file" id="addImages" multiple ref="file" v-on:change="uploadFile(0)">
            <span class="photo1__empty">
                <span>
                    <svg width="1.2rem" height="1.2rem">
                        <use xlink:href="#ico-camera"></use>
                    </svg>
                    <span class="color-dark fz17 fw600">Загрузить</span>
                </span>
            </span>
        </label>
    </div>
</template>

<script>
export default {
    name: "BlockMultiPhoto",
    props: {
        max: Number
    },
    data() {
        return {
            files: [],
            temp_files: [],
            old_images: [],
            images: {},
            totalImages: Number
        }
    },
    mounted() {
        this.old_images = this.$attrs.files || [];
        this.changeValue();
        this.recalcTotal();
    },
    methods: {
        uploadFile() {
            let component = this;
            this.recalcTotal();
            component.temp_files = component.$refs.file.files;
            let i = 0
            for (i = 0; i < component.temp_files.length; i++) {
                if (i < this.max - component.totalImages) {
                    let clear = false;
                    if (i == component.max - component.totalImages - 1) {
                        clear = true;
                    }
                    let exists = false;
                    for (let key in this.images) {
                        if (this.images[key].name == component.temp_files[i].name)
                            exists = true;
                    }
                    if (!exists)
                        component.preview(component.temp_files[i], clear);
                }
            }
            component.totalImages = i + component.totalImages;
            component.temp_files = [];
            this.changeValue();
        },
        removeOldItem(id) {
            for (let i in this.old_images) {
                if (this.old_images[i].id == id) {
                    this.old_images.splice(i, 1);
                }
            }
            this.recalcTotal();
            this.changeValue();
        },
        removeItem(id) {
            for (let i in this.files) {
                if (this.files[i].id == id) {
                    this.files.splice(i, 1);
                }
            }
            this.images = {};
            for (let i in this.files) {
                this.images[this.files[i]['id']] = this.files[i]['file'];
            }
            this.changeValue();
            this.recalcTotal();
        },
        preview(file, clear = false) {
            let component = this;
            if (!file.type.match(/image\/(jpeg|jpg|png|gif)/)) {
                alert('Картинка должна быть в формате jpeg|jpg|png|gif')
            }
            if (file.size > window.maxFileSize) {
                alert('Размер файла должен быть менее 2Мб')
            }
            let reader = new FileReader();
            reader.addEventListener('load', function (event) {
                component.files.push({
                    'id': file.name,
                    'thumb1': event.target.result,
                    'file': file,
                })
                component.images[file.name] = file;
            });
            reader.readAsDataURL(file);
            if (clear)
                component.temp_files = [];

        },
        changeValue() {
            let return_ids = []
            for (let i in this.old_images) {
                return_ids.push(this.old_images[i].id)
            }
            this.$emit('input', {
                "images": this.images,
                "old_images": return_ids,
            })
        },
        recalcTotal() {
            this.totalImages = Object.keys(this.old_images).length + Object.keys(this.images).length;
        }
    }
}
</script>

<style scoped>
.photo1__wrap{
    position:relative;
}
.photo1__remove{
    opacity:0;
    position:absolute;
    top:.6rem;
    right:.6rem;
    font-size:1rem;
    text-transform:uppercase;
    font-weight:800;
    color:#ffffff;
    background:rgba(220, 60, 16, 1);
    border-radius:100%;
    width:1rem;
    height:1rem;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:.2s;
    z-index:100;
}
.photo1__wrap:hover .photo1__remove{
    opacity:1;
}
.photo1__empty{
    display:flex;
    align-items:center;
    justify-content:center;
    background: #F7F7F9;
    border-radius:.4rem;
    flex-wrap:wrap;
    height:100%;
    min-height:8rem;
    transition:.2s;
}
.photo1__empty:hover{
    background: #FFFFFF;
    box-shadow: 0px 4px 12px rgba(43, 51, 45, 0.1);
}

.photo1__empty svg{
    display:block;
    margin:0 auto .5rem;
    fill:#3d8be4;
}

.photo1__empty span{

    text-align:center;
}

#addImages{
    position:absolute;
    z-index:-1;
    width:1px;
    height:1px;
    overflow:hidden;
    opacity:0;
}

.photo1__wrap-add{
    order:5;
    cursor:pointer;
}

.photo1__wrap{
    background-position:center;
    background-size:cover;
    height:100%;
    border-radius:.4rem;
    overflow:hidden;
    min-height:8rem;
    display:block;
}
</style>
