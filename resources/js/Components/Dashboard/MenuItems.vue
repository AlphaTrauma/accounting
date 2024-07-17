<template>
<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Управление пунктами меню</h1>

    <div class="flex gap-4">
        <div class="basis-3/4 overflow-x-auto">
            <div class="overflow-hidden sm:rounded-md mb-4">
                <div v-for="item in highLevelItems" :key="item.id" class="flex items-center">
                    <div class="p-3 mr-1 mb-2 border border-gray-200 mb-2 bg-white w-[250px]">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-indigo-600">{{ item.title }}</div>
                            <div class="ml-2 flex-shrink-0 flex space-x-2">
                                <button @click="editMenuItem(item)" class="text-gray-600 hover:text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <button @click="deleteMenuItem(item)" class="text-red-600 hover:text-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-500">{{ item.url }}</div>
                    </div>
                    <div v-if="getChildren(item.id).length > 0" class="px-3 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>

                    </div>
                    <div v-for="child in getChildren(item.id)" class="p-3 mr-1 mb-2 border border-gray-200 mb-2 bg-white  w-[250px]">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-medium text-indigo-600">{{ child.title }}</div>
                            <div class="ml-2 flex-shrink-0 flex space-x-2">
                                <button @click="editMenuItem(child)" class="text-indigo-600 hover:text-indigo-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </button>
                                <button @click="deleteMenuItem(child)" class="text-red-600 hover:text-red-900"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg></button>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-500">{{ child.url }}</div>
                    </div>
                </div>
            </div>

            <form @submit.prevent="submitForm" class="container">
                <div class="flex">
                    <div class="mb-4 basis-1/2 mr-2">
                        <label class="block text-sm font-medium text-gray-700">Название</label>
                        <input type="text" v-model="form.title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required />
                    </div>
                    <div class="mb-4 basis-1/2">
                        <label class="block text-sm font-medium text-gray-700">URL</label>
                        <input type="text" v-model="form.url" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required />
                    </div>
                </div>

                <div class="flex">
                    <div class="mb-4 basis-1/4 mr-2">
                        <label class="block text-sm font-medium text-gray-700">Порядок</label>
                        <input type="number" v-model="form.order" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" />
                    </div>
                    <div class="mb-4 basis-3/4">
                        <label class="block text-sm font-medium text-gray-700">Родительский пункт</label>
                        <select v-model="form.parent_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            <option :value="null">Нет</option>
                            <option v-for="item in highLevelItems" :key="item.id" :value="item.id">
                                {{ item.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="p-2">Отображать в мобильном меню <input class="w-4 h-4 ml-4" type="checkbox" v-model="form.is_mobile"></label>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700">
                        {{ edit ? 'Обновить' : 'Добавить' }}
                    </button>
                    <button type="button" @click="resetForm" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">
                        Отмена
                    </button>
                </div>
            </form>
        </div>
        <div class="basis-1/4">
            <h2 class="text-center font-bold text-xl mb-2">Страницы</h2>
            <p>Нажмите на странице, чтобы добавить ссылку на неё в редактируемый пункт меню</p>
            <div v-for="page of pages" @click="form.url = `/${page.slug}`" class="p-2 transition-all rounded-sm bg-gray-200 hover:bg-gray-300 my-2 cursor-pointer">
                <span>{{ page.title }}</span>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            menuItems: [],
            pages: [],
            form: {
                title: '',
                url: '#',
                order: 0,
                parent_id: null,
                is_mobile: true
            },
            edit: null,
        };
    },
    computed: {
        highLevelItems() {
            return this.menuItems.filter(item => !item.parent_id);
        }
    },
    mounted() {
        this.fetchMenuItems();
    },
    methods: {
        getChildren(id) {
            return this.menuItems.filter(item => item.parent_id === id);
        },
        async fetchMenuItems() {
            try {
                axios.get('/dashboard/menu-items').then(response => {
                    this.menuItems = response.data.items;
                    this.pages = response.data.pages;
                    console.log(response.data);
                });
                
            } catch (error) {
                console.error('Error fetching menu items:', error);
            }
        },
        async submitForm() {
            if (this.edit) {
                this.updateMenuItem();
            } else {
                this.createMenuItem();
            }
        },
        async createMenuItem() {
            try {
                const response = await axios.post('/dashboard/menu-items', this.form);
                this.menuItems.push(response.data);
                this.resetForm();
            } catch (error) {
                console.error('Error creating menu item:', error);
            }
        },
        async updateMenuItem() {
            try {
                const response = await axios.put(`/dashboard/menu-items/${this.edit}`, this.form);
                const index = this.menuItems.findIndex((item) => item.id === this.edit);
                this.menuItems[index] = response.data;
                this.resetForm();
            } catch (error) {
                console.error('Error updating menu item:', error);
            }
        },
        async deleteMenuItem(item) {
            if (!confirm(`Вы уверены, что хотите удалить пункт меню "${item.title}"?`)) return;
            try {
                await axios.delete(`/dashboard/menu-items/${item.id}`);
                this.menuItems = this.menuItems.filter((i) => i.id !== item.id);
            } catch (error) {
                console.error('Error deleting menu item:', error);
            }
        },
        editMenuItem(item) {
            this.form = {
                ...item
            };
            this.edit = item.id;
        },
        resetForm() {
            this.form = {
                title: '',
                url: '#',
                order: 0,
                parent_id: null,
                is_mobile: true
            };
            this.edit = null;
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 600px;
}
</style>
