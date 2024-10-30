<template>
<div :class="['p-4 min-h-[30vh] overflow-x-hidden transition-all rounded-md my-5 border-2', 
{'border-transparent': !isDragging},
{'border-dashed border-gray-300 ': isDragging}]">
    <input type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.rtf,.txt,.zip,.rar,.7z,.odt,.ott,.dot,.dotx,.csv" multiple class=" hidden" ref="file" @change="upload">

    <div v-if="loaded" @dragover.prevent @dragenter="isDragging = true" @dragleave.prevent="handleDragLeave" @drop.prevent="handleDrop">
        <transition-group name="fade" tag="div" mode="out-in" class="flex flex-col gap-3">
            <div v-for="(file, index) in files" :key="file.id" :class="['w-full p-1 hover:bg-gray-100 transition-all duration-300 relative rounded-sm flex gap-3 items-center', {'bg-gray-200': selected.includes(file)}]">
                <div class="relative">
                    <svg width="50" height="50">
                        <use :href="`#${getIcon(file.filename)}`"></use>
                    </svg>
                    <div class="absolute w-full h-full flex items-center top-0 left-0 justify-center z-10 text-green-600 text-4xl" v-if="selected.includes(file)">
                        <div><i class="fa fa-check"></i></div>
                    </div>
                </div>

                <div v-if="editing && editing.id === file.id" @keydown.enter.prevent="updateText" @blur="updateText" 
                contenteditable="true" class="p-1 max-w-[400px] text-lg outline-dashed outline-1">{{ file.filename.replace('.'+getExt(file.filename), '') }}</div>
                <div @click="open(file)" title="Открыть файл" v-else class="max-w-[400px] text-lg p-1 cursor-pointer hover:underline">{{ file.filename }}</div>
                <div class="absolute right-0 flex flex-col align-bottom pr-2">

                    <div class=" text-gray-500  flex justify-end">
                        <div @click.prevent="setNameEditing($event, file)" class="p-1 cursor-pointer transition-all hover:text-black" title="Переименовать файл"><i class="fa fa-pen"></i></div>
                        <div @click.prevent="download(file)" class="p-1 cursor-pointer transition-all hover:text-black" title="Скачать файл"><i class="fa-solid fa-down-long"></i></div>
                        <div @click.prevent="remove(file)" class="p-1 cursor-pointer transition-all hover:text-black" title="Удалить файл"><i class="fa fa-trash"></i></div>

                    </div>
                    <div class=" text-xs text-gray-500">
                        <i>{{ new Date(file.created_at).toLocaleString() }}</i>
                    </div>
                </div>

            </div>
        </transition-group>

        <div class="flex my-5 items-center justify-center w-full" @click="$refs.file.click()">
            <label class="flex flex-col items-center justify-center w-full h-32 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all">
                <div v-if="isDragging" class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Отпустите файл, чтобы загрузить</span></p>

                </div>
                <div v-else class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Нажмите, чтобы загрузить файл, </span> или перетащите файл в эту область</p>
                    <p class="text-xs text-gray-500">Допустимы файлы PDF, DOC, DOCX, XML, CSV</p>
                </div>
            </label>
        </div>

    </div>
    <div v-else class="text-center">
        <div role="status">
            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
            </svg>
            <span class="sr-only">Загрузка...</span>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'FileManager',
    props: {
        entity: {
            type: String,
            required: true
        },
        id: {
            type: Number,
            required: true
        }
    },
    computed: {},
    data() {
        return {
            files: [],
            count: 0,
            selected: [],
            editing: null,
            filterActive: false,
            lastSelectedIndex: null,
            query: '',
            isDragging: false,
            loaded: false,
        }
    },
    methods: {
        remove(file) {
            if (confirm(`Вы уверены, что хотите удалить файл "${file.filename}"?`)) {
                axios.post('/files/remove', file).then(response => {
                    if (response.data.status) {
                        this.files = this.files.filter(item => item.id !== file.id);
                    } else {
                        alert('Невозможно удалить файл');
                    }
                });
            }
        },
        upload(event) {
            let form = new FormData();
            const files = event.target.files;  
            for (let i = 0; i < files.length; i++) {
                form.append('file[]', files[i]);  
            } 
            form.append('entity_type', `App\\Models\\${this.$props.entity}`);
            form.append('entity_id', this.$props.id); 
            axios.post('/files/upload', form, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                response.data.files.forEach(file => {
                    this.files.unshift(file);  
                });
            }).catch(error => {
                console.error('Ошибка загрузки файлов:', error);  
            });
        },
        download(file) {
            window.open(`${window.location.origin}/file/${file.id}`, '_self');
        },
        open(file) {
            window.open(`${window.location.origin}/${file.filepath}`);
        },
        update(file, fields) {
            axios.post(`/files/${file.id}/update`, fields).then(response => {

                const index = this.files.indexOf(file);

                if (index !== -1) {
                    this.files[index] = response.data.file;
                }
            });
        },
        setNameEditing(event, file) { // Выделяет имя файла для изменения
            this.editing = file;
            this.$nextTick(() => {
                const editableDiv = document.querySelector('[contenteditable]');
                if (editableDiv) {
                    editableDiv.focus();
                    document.execCommand('selectAll', false, null);
                }
            });
        },
        updateText(event) { // изменяет имя файла на введённое
            if (this.editing) {
                this.update(this.editing, {
                    filename: event.target.innerText
                });
                this.editing = null;
            }
        },
        toggleSelection(event, file, index) { // выделяет один файл. Если предыдущий файл выделяли кликом, то после нажатия shift+click выделяются все файлы между последним выделенным и кликнутым.
            if (event.shiftKey && this.lastSelectedIndex !== null) {
                this.selectRange(this.lastSelectedIndex, index);
            } else {
                if (!this.selected.includes(file)) {
                    this.selected.push(file);
                    this.lastSelectedIndex = index;
                } else {
                    let index = this.selected.findIndex(item => item.fid === file.fid);
                    if (index !== -1) {
                        this.selected.splice(index, 1);
                        this.lastSelectedIndex = null;
                    }
                }
            }

        },
        selectRange(startIndex, endIndex) { // Выделяет диапазон файлов между индексами
            const range = [startIndex, endIndex].sort((a, b) => a - b);
            for (let i = range[0]; i <= range[1]; i++) {
                if (!this.selected.includes(this.files[this.activeFolder][i])) {
                    this.selected.push(this.files[this.activeFolder][i]);
                }
            }
            this.lastSelectedIndex = null;
        },
        load() {
            axios.post('/files', {
                class: this.$props.entity,
                id: this.$props.id
            }).then(response => {
                this.files = Array.isArray(response.data.files) ? response.data.files : Object.values(response.data.files);
                this.loaded = true;
            });
        },
        handleDrop(event) {
            const files = event.dataTransfer.files;
            if (files.length) {
                const fakeEvent = {
                    target: {
                        files: files
                    }
                };
                this.upload(fakeEvent);
            }
        },
        handleDragLeave(event) {
            const {
                relatedTarget
            } = event;
            if (!this.$el.contains(relatedTarget)) {
                this.isDragging = false;
            }
        },

        getExt(filename) {
            const lastDotPosition = filename.lastIndexOf('.');
            if (lastDotPosition === -1 || lastDotPosition === 0) {
                return '';
            }
            return filename.slice(lastDotPosition + 1);
        },
        getIcon(filename) {
            const ext = this.getExt(filename);
            switch (ext) {
                case ('pdf'):
                    return 'pdf';
                case ('doc'):
                case ('docx'):
                case ('rtf'):
                    return 'doc';
                case ('jpeg'):
                case ('jpg'):
                case ('png'):
                case ('bmp'):
                    return 'jpg';
                case('xls'):
                case('xlsx'):
                    return 'xls'
                default:
                    return 'file';
            }
        }
    },
    mounted() {
        this.load();
    }
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
