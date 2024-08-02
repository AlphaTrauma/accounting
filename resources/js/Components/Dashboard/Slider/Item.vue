<template>
    <div :class="['flex', { 'opacity-50': !slide.status }]">
        <div class="h-[385px] w-[700px] relative flex align-middle item mb-3"
            :style="`background-image: linear-gradient(to right bottom, ${slide.color1}, ${slide.color2})`">
            <div :class="['w-full px-3 md:px-5 bg-contain bg-no-repeat',
                { 'bg-left-bottom': slide.positioning === 'right' },
                { 'bg-right-bottom': slide.positioning === 'left' }]"
                :style="`background-image: url(${slide.image ? slide.image.filepath : ''})`">
                <div
                    :class="['max-w-screen-xl mx-auto min-h-[100%] flex items-center justify-between', { 'flex-row-reverse': slide.positioning === 'right' }]">
                    <div class="basis-1/2">
                        <h1 :class="['text-4xl leading-relaxed',
                            { 'pl-5 border-l-4': slide.positioning === 'left' }, { 'pr-5 border-r-4': slide.positioning === 'right' }]"
                            :style="`color: ${slide.text_color}; border-color: ${slide.text_color}`">
                            <span class="text-5xl">{{ slide.title }}</span><br>
                            {{ slide.subtitle }}
                        </h1>
                        <div class="my-3 text-gray-800 text-lg">
                            {{ short_text }}
                        </div>
                        <div class="py-5 flex gap-1 md:gap-4">
                            <a v-if="slide.buttons" v-for="button in slide.buttons" :href="button.url"
                                :class="['btn-micro', button.class]">{{
                                    button.text }}</a>
                            <a v-if="!slide.buttons || slide.buttons.length < 3" title="Добавить кнопку"
                                @click.prevent="addButton" class="btn-micro cursor-pointer"><span
                                    class="fa fa-plus"></span></a>
                        </div>
                    </div>
                    <div class="basis-1/2 text-center">

                        <a v-if="slide.image" class="btn text-white" @click="addImage" title="Заменить изображение">
                            <span class="fa-solid fa-arrows-rotate"></span>
                        </a>
                        <a v-else class="btn text-white" @click="addImage" title="Загрузить изображение">
                            <span class="fa fa-plus"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-md w-full p-3">
            <div class="flex my-2 gap-2">
                <div class="basis-1/2">
                    <label for="">Позиционирование</label>
                    <select v-model="slide.positioning" @change="updateField($event, 'positioning')" class="tw-input">
                        <option value="left">Текст слева</option>
                        <option value="right">Текст справа</option>
                    </select>
                </div>
                <div>
                    <label for="">Фон 1</label>
                    <input :value="slide.color1" type="color" @change="updateField($event, 'color1')" class="tw-input">
                </div>
                <div>
                    <label for="">Фон 2</label>
                    <input :value="slide.color2" type="color" @change="updateField($event, 'color2')" class="tw-input">
                </div>
                <div>
                    <label for="">Заголовок</label>
                    <input :value="slide.text_color" type="color" @change="updateField($event, 'text_color')"
                        class="tw-input">
                </div>
            </div>

            <div class="my-2">
                <input type="text" class="tw-input" :value="slide.title" @change="updateField($event, 'title')"
                    placeholder="Заголовок">
            </div>
            <div class="my-2">
                <input type="text" class="tw-input" :value="slide.subtitle" @change="updateField($event, 'subtitle')"
                    placeholder="Подзаголовок">
            </div>
            <div class="my-2">
                <input type="text" class="tw-input" placeholder="Текст" @change="updateField($event, 'text')"
                    :value="slide.text">
            </div>
            <div v-if="slide.buttons" class="my-2">
                <div v-for="(button, index) in slide.buttons" class="flex gap-1 my-1">
                    <input type="text" v-model="button.text" @change="updateBtn(index, button)" class="tw-input">
                    <input type="text" v-model="button.url" @change="updateBtn(index, button)" class="tw-input">
                    <select v-model="button.class" @change="updateBtn(index, button)">
                        <option value="btn-active">Первичная</option>
                        <option value="btn-secondary">Вторичная</option>
                        <option value="btn-primary">Контрастная</option>
                    </select>
                    <a @click="removeButton(index, button)" class="p-2 flex items-center cursor-pointer"><i
                            class="fa fa-times"></i></a>
                </div>
            </div>


        </div>
        <div class="max-w-sm p-2">
            <div class="flex-col gap-1">
                <div v-if="slide.image" @click="addImage" class="btn-sm text-center" title="Заменить изображение">
                    <i class="fa-solid fa-arrows-rotate"></i>
                </div>
                <div @click="hide" v-if="slide.status" class="btn-sm text-center" title="Скрыть">
                    <i class="fa-solid fa-eye-slash"></i>
                </div>
                <div @click="show" class="btn-sm text-center" title="Показать" v-else>
                    <i class="fa-solid fa-eye"></i>
                </div>
                <div @click="removeCallback" class="btn-sm text-center" text="Удалить слайд">
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { mapActions, mapMutations } from "vuex";
export default {
    name: "Item",
    props: {
        slide: {
            type: Object,
            required: true
        },
        index: {
            type: Number,
            required: true
        }
    },
    computed: {
        short_text(){
            return this.slide.text.substring(0, 50)+'...'
        }
    },
    methods: {
        ...mapActions({
            remove: "slides/remove",
            store: "slides/store",
            storeButton: "slides/storeButton"
        }),
        ...mapMutations({
            update: "slides/update",
            updateButton: "slides/updateButton"
        }),
        removeCallback() {
            if (!confirm('Удалить слайд?')) return;
            this.remove(this.slide);
        },
        show() {
            this.update({ i: this.index, n: 'status', v: 1 });
        },
        hide() {
            this.update({ i: this.index, n: 'status', v: 0 });
        },
        updateField(e, field) {
            if (!this.slide.id) {
                this.store(this.index);
            } else {
                this.update({ i: this.index, n: field, v: e.target.value });
            }

        },
        addImage() {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            if (!this.slide.id) {
                this.store(this.index);
            }
            fileInput.accept = 'image/png, image/jpeg, image/jpg';
            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) this.uploadFile(file);
            });
            fileInput.click();
        },
        uploadFile(file) {
            if (file) {
                let form = new FormData();
                form.append('file', file);
                if (this.slide.id) form.append('entity_id', this.slide.id);
                form.append('entity_type', "App\\Models\\SliderItem");
                form.append('uncompressed', true);
                form.append('replace', true);
                axios.post('/files/upload', form, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    if (response.data.file) {
                        this.slide['image'] = response.data.file;
                    }
                });
            }
        },
        addButton() {
            let button = { id: 0, slide_id: this.slide.id, text: "Кнопка", url: "#", class: "btn-active" };
            if (this.slide.hasOwnProperty('buttons')) {
                if (this.slide.buttons.length > 2) return;
                this.slide.buttons.push(button);
            } else {
                this.slide['buttons'] = [button];
            }
        },
        updateBtn(buttonIndex, button) {
            axios.post(`/dashboard/button/update`, button).then(response => {
                if (response.data.result) {
                    this.slide.buttons[buttonIndex] = response.data.result;
                }
            });
        },
        removeButton(buttonIndex, button) {
            if (!confirm('Удалить кнопку?')) return;
            axios.post('/dashboard/button/remove', button).then(response => {
                if (response.data.status) {
                    this.slide.buttons.splice(buttonIndex, 1);
                }
            });
        }
    }
}
</script>

<style scoped>
.panel {
    position: relative;
}

.slider_body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 305px;
}

.slider_image {
    width: 1100px;
    height: 347px;
    object-fit: cover;
    object-position: center;
    transition: 0.2s ease;
}

.panel:hover>div>.slider_overlay {
    opacity: 1;
}

.float {
    float: right;
}

.slider_overlay {
    right: 15px;
    top: 15px;
    background: rgba(255, 255, 255, 0.8);
    opacity: 0;
    position: absolute;
    height: 34px;
    width: 50%;
    transition: 0.2s ease;
}
</style>