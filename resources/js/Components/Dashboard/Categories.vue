<template>
<div>
    <h2 class=" text-2xl font-bold py-3">Категории статей</h2>
    <div>
        <div class="p-3 mb-3 bg-gray-200 hover:bg-gray-300 transition-all flex items-center justify-between" v-for="item of items" :key="item.id">
            <div class=" text-lg">
                <b>{{ item.name }}</b> <span class=" italic">/{{ item.slug }}</span> <span>({{ item.articles_count }} статей)</span>
                
            </div>
            <div>
                <a :href="`/dashboard/article/edit?category=${item.id}`" class="btn btn-active btn-sm">Добавить</a>
            </div>
            <div class="ml-2 flex-shrink-0 flex space-x-2">
                <button @click="edit(item)" class="text-gray-600 hover:text-gray-900">
                    <i class="fa fa-pen"></i>

                </button>
                <button @click="remove(item)" class="text-red-600 hover:text-red-900">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
    
    <div class="py-3">
        <a @click="editing = !editing" class="btn btn-active">
            Добавить категорию
        </a>
    </div>
    <div v-if="editing" class="py-3 max-w-lg">
        <div class="my-2">
            <input type="text" class="tw-input" placeholder="Название" v-model="form.name">
        </div>
        <div class="my-2">
            <input type="text" class="tw-input" placeholder="Постоянная ссылка" v-model="form.slug">
        </div>
        <div class="my-2">
            <textarea type="text" v-model="form.description" class="tw-input resize-none" placeholder="Описание"></textarea>
        </div>
        <div class="my-2">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" v-model="form.open" class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"><b>Открытая категория</b></span>
            </label>
        </div>
        <button @click="update" class="btn btn-active">Сохранить</button>
    </div>
</div>
</template>

<script>
import Switcher from '../Utilities/Switcher.vue';
export default {
    name: "Categories",
    components: {
        Switcher
    },
    data() {
        return {
            items: [],
            editing: false,
            form: {
                id: null,
                name: '',
                open: true,
                slug: '',
                description: ''
            }
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        load() {
            axios.get('/dashboard/categories/data').then(response => {
                this.items = response.data.items;
                console.log(response.data.items)
            });
        },
        edit(item) {
            this.form = {
                ...item
            };
            this.form.open = !!item.open;
            this.editing = true;
        },
        update() {
            if (this.form.id) {
                axios.post('/dashboard/category/update', this.form).then(response => {
                    let index = this.items.findIndex(item => item.id === this.form.id);
                    this.items[index] = response.data.item;
                    this.resetForm();
                })
            } else {
                axios.post('/dashboard/categories/create', this.form).then(response => {
                    this.items.unshift(response.data.item);
                });
                this.resetForm();
            }
        },
        remove(item) {
            if(!confirm(`Вы уверены, что хотите удалить категорию "${item.name}"?`)) return false;
            axios.post('/dashboard/category/remove', item).then(response => {
                if (response.data.status) {
                    this.items = this.items.filter(i => i.id !== item.id);
                }
            })
        },
        resetForm() {
            this.form.id = null;
            this.form.name = '',
            this.form.description = '';
            this.form.slug = '';
            this.form.open = true;
        }
    }
}
</script>
