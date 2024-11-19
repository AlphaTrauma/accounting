<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Управление услугами</h1>
        <Transition name="fade" mode="out-in">
            <div v-if="modal"
                 class="fixed p-3 rounded shadow-lg top-[50%] left-[50%] -translate-y-[50%] -translate-x-[50%] bg-white">
                <form @submit.prevent="handleSubmit" class="mb-6 bg-gray-100 p-4 rounded shadow">
                    <h2 class="text-lg font-semibold mb-2">{{ editMode ? 'Редактировать услугу' : 'Создать услугу' }}</h2>
                    <div class="mb-4">
                        <label class="block font-medium mb-1" for="title">Название</label>
                        <input v-model="form.title" type="text" id="title" class="w-full border rounded p-2" placeholder="Введите название" required/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1" for="description">Описание</label>
                        <textarea v-model="form.description" id="description" class="w-full border rounded p-2" placeholder="Введите описание"
                        ></textarea>
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium mb-1" for="value">Стоимость</label>
                            <input v-model="form.value" type="number" id="value" class="w-full border rounded p-2" placeholder="0.00" step="100" required/>
                        </div>
                        <div>
                            <label class="block font-medium mb-1" for="fee">Комиссия</label>
                            <input v-model="form.fee" type="number" id="fee" class="w-full border rounded p-2" placeholder="0.00" step="10" required/>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium mb-1" for="countable">Количественная услуга</label>
                        <input v-model="form.countable" type="checkbox" id="countable" class="mr-2"/>
                        <span>Да</span>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-active">
                        {{ editMode ? 'Сохранить изменения' : 'Добавить услугу' }}
                    </button>
                    <button v-if="editMode" type="button" @click="cancelEdit" class="btn btn-secondary">
                        Отменить
                    </button>
                </form>
            </div>
        </Transition>

        <!-- Таблица услуг -->
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Название</th>
                <th class="border p-2">Стоимость</th>
                <th class="border p-2">Комиссия</th>
                <th class="border p-2">Количественная</th>
                <th class="border p-2">Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="service in services" :key="service.id">
                <td class="border p-2 text-center">{{ service.id }}</td>
                <td class="border p-2">{{ service.title }}</td>
                <td class="border p-2 text-right">{{ service.value }}</td>
                <td class="border p-2 text-right">{{ service.fee }}</td>
                <td class="border p-2 text-center">{{ service.countable ? 'Да' : 'Нет' }}</td>
                <td class="border p-2 text-center">
                    <button
                        @click="editService(service)"
                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                        Редактировать
                    </button>
                    <button
                        @click="deleteService(service.id)"
                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 ml-2"
                    >
                        Удалить
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                services: [],
                form: {
                    id: null,
                    title: '',
                    description: '',
                    value: 0,
                    fee: 0,
                    countable: true,
                },
                editMode: false,
            };
        },
        methods: {
            async fetchServices() {
                // API-запрос для получения услуг
                const response = await fetch('/api/services');
                this.services = await response.json();
            },
            async handleSubmit() {
                if (this.editMode) {
                    // API-запрос для редактирования услуги
                    await fetch(`/api/services/${this.form.id}`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(this.form),
                    });
                } else {
                    // API-запрос для создания услуги
                    await fetch('/api/services', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(this.form),
                    });
                }
                this.resetForm();
                this.fetchServices();
            },
            editService(service) {
                this.form = { ...service };
                this.editMode = true;
            },
            cancelEdit() {
                this.resetForm();
            },
            async deleteService(id) {
                // API-запрос для удаления услуги
                await fetch(`/api/services/${id}`, { method: 'DELETE' });
                this.fetchServices();
            },
            resetForm() {
                this.form = {
                    id: null,
                    title: '',
                    description: '',
                    value: 0,
                    fee: 0,
                    countable: true,
                };
                this.editMode = false;
            },
        },
        mounted() {
            this.fetchServices();
        },
    };
</script>
