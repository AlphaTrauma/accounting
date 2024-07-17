<template>
<div>
    <small class="float-right text-gray-500 text-sm italic px-5">{{ lastSaving ? `Сохранено в ${lastSaving}` : 'Не сохранялась' }}</small>
    <div v-if="page && !isLoading">
        <h1>
            <span v-if="page.id">Редактирование страницы</span><span v-else>Создание страницы</span>
        </h1>
        <div v-if="errors.length">
            <div v-for="error of errors" class="px-4 py-2 text-red-900 bg-red-300 rounded-md">{{ error }}</div>
        </div>
        <div>
            <div class="my-3 flex gap-4">
                <input type="text" class="tw-input w-full" v-model="page.title" placeholder="Имя страницы">
                <input type="text" class="tw-input w-full" v-model="page.slug" placeholder="Постоянный адрес">
            </div>
            <div class="my-3">
                <a @click.prevent="showMeta = !showMeta" class="tw-link cursor-pointer underline">
                    <span v-if="!showMeta">Показать мета-данные <i class="fa-solid fa-arrow-down"></i></span>
                    <span v-else>Скрыть мета-данные <i class="fa-solid fa-arrow-up"></i></span>
                </a>
                <div v-if="showMeta" class="flex gap-3 mt-3">
                    <input type="text" placeholder="Мета Title" v-model="page.meta_title" class="tw-input w-full">
                    <input type="text" placeholder="Мета Description" v-model="page.meta_description" class="tw-input w-full">
                </div>
            </div>
            <text-editor @update-content="updateContent" :entity="page" type="App\Models\Page"></text-editor>
            <div class="my-3 flex gap-3">
                <button v-if="page.id" @click="update" class="btn btn-active">
                    Сохранить изменения <span v-if="lastSaving">({{ lastSaving }})</span>
                </button>
                <button v-else @click="save" class="btn btn-active">Создать страницу</button>
                <a v-if="page.slug" :href="`/${page.slug}`" class="btn btn-active">
                    Открыть
                </a>
                <button class="btn btn-danger">Удалить страницу</button>
            </div>
        </div>
    </div>

    <div v-else>
        <div role="status">
            <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-cyan-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
            </svg>
            <span class="sr-only">Загрузка...</span>
        </div>
    </div>

</div>
</template>

    
<script>
import TextEditor from './TextEditor.vue';
import {
    mapActions,
    mapGetters
} from "vuex";
export default {
    name: "PageEditor",
    components: {
        TextEditor
    },
    props: {
        id: {
            type: Number,
            required: false
        }
    },
    data() {
        return {
            showMeta: false
        }
    },
    computed: {
        ...mapGetters({
            page: "page/page",
            isLoading: "page/isLoading",
            lastSaving: "page/lastSaving",
            errors: "page/errors"
        })
    },
    methods: {
        ...mapActions({
            fetch: "page/fetchPage",
            savepage: "page/savePage",
            updatepage: "page/updatePage"
        }),
        save() {
            this.savepage(this.page);
        },
        update() {
            this.updatepage(this.page);
        },
        updateContent(content) {
            this.page.content = content;
        },
    },
    mounted() {
        this.fetch(this.$props.id)
    }
}
</script>
