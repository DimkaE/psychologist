<template>
    <nav class="pagination" v-if="max > 1">
        <div class="d-flex justify-content-between">
            <div class="flex-fill" v-if="currentPage > 1">
                <p @click="switchPage(currentPage - 1)" class="pagination__link">
                    Назад
                </p>
            </div>
            <div class="d-flex">
                <div class="px-1" v-if="currentPage !== 1">
                    <p @click="switchPage(1)" class="pagination__link">
                        1
                    </p>
                </div>
                <div class="px-1" v-if="currentPage - 1 && currentPage - 1 !== 1">
                    <p @click="switchPage(currentPage - 1)"
                       class="pagination__link">
                        {{ currentPage - 1 }}
                    </p>
                </div>
                <div class="px-1">
                    <p @click="switchPage(currentPage)"
                       class="pagination__link pagination__link_current">
                        {{ currentPage }}
                    </p>
                </div>
                <div class="px-1" v-if="currentPage + 1 <= max && currentPage + 1 !== max">
                    <p @click="switchPage(currentPage + 1)" class="pagination__link">
                        {{ currentPage + 1 }}
                    </p>
                </div>
                <div class="px-1" v-if="currentPage !== max">
                    <p @click="switchPage(max)" class="pagination__link">
                        {{ max }}
                    </p>
                </div>
            </div>
            <div class="flex-fill" v-if="currentPage < max">
                <p @click="switchPage(currentPage + 1)" class="pagination__link">
                    Вперед
                </p>
            </div>
        </div>
    </nav>
</template>

<script>

export default {
    name: 'Pagination',
    props: {
        current: Number,
        max: Number,
    },
    components: {},
    data() {
        return {
            currentPage: this.current || 1,
        }
    },
    methods: {
        switchPage(page) {
            if (page < 1 || page > this.max) return;
            this.currentPage = page;
            this.$emit('switchPage', page)
            window.scrollToTop();
        }
    },
    watch: {
        current: function (){
            this.currentPage = this.current;
        }
    }
}

</script>
<style scoped>
.pagination{
    border-top:1px solid #e5e5e5;
    margin-top:2rem;
}
.pagination__link{
    display:block;
    padding:.4rem .5rem;
    font-size:.9rem;
    cursor:pointer;
    border-top:3px solid transparent;
}
.pagination__link_current{
    border-color:#3D8CE4;
}
</style>
