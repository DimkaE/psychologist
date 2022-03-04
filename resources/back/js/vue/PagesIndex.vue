<template>
    <div>
        <table class="table table-striped table-bordered table-sm table-hover">
            <thead>
            <tr>
                <th></th>
                <th>
                    Название
                </th>
                <th>
                    Описание
                </th>
            </tr>

            </thead>
            <tbody>
            <tr v-for="page in pages">
                <td>
                    <div class="d-flex">
                        <a :href="route('home') + page['url']"
                           class="btn btn-sm mr-2 btn-secondary" title="Просмотр" target="_blank">
                            <svg width="1rem" height="1rem">
                                <use xlink:href="#ico-eye"/>
                            </svg>
                        </a>
                        <a :href="route('back.pages.edit', page)"
                           class="btn btn-sm mr-2 btn-success" title="Редактировать">
                            <svg width="1rem" height="1rem">
                                <use xlink:href="#ico-pencil"/>
                            </svg>
                        </a>
                    </div>
                </td>
                <td>{{ page['meta_title'] }}</td>
                <td>{{ page['meta_description'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "PagesIndex",
    props: {
        pages: Array,
    }
}
</script>

<style scoped>

</style>
