<template>
    <div class="">
        <div class="p-3">
            <div v-if="editor" class="mb-5">
                <div class="flex gap-4 mb-2">
                    <button @click="editor.chain().focus().setParagraph().run()"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('paragraph') }]">
                        Текст
                    </button>
                    <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('heading', { level: 1 }) }]">
                        Заголовок
                    </button>
                    <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('heading', { level: 2 }) }]">
                        Подзаголовок
                    </button>
                </div>
                <div class="flex gap-4 mb-2">
                    <button @click="editor.chain().focus().toggleBold().run()"
                        :disabled="!editor.can().chain().focus().toggleBold().run()"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('bold') }]">
                        <i class="fa-solid fa-bold"></i>
                    </button>
                    <button @click="editor.chain().focus().toggleItalic().run()"
                        :disabled="!editor.can().chain().focus().toggleItalic().run()"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('italic') }]">
                        <i class="fa-solid fa-italic"></i>
                    </button>

                    <button @click="editor.chain().focus().setTextAlign('left').run()"
                        :disabled="!editor.can().setTextAlign('left')"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive({ textAlign: 'left' }) }]">
                        <i class="fa-solid fa-align-left"></i>
                    </button>

                    <button @click="editor.chain().focus().setTextAlign('center').run()"
                        :disabled="!editor.can().setTextAlign('center')"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive({ textAlign: 'center' }) }]">
                        <i class="fa-solid fa-align-center"></i>
                    </button>

                    <button @click="editor.chain().focus().setTextAlign('right').run()"
                        :disabled="!editor.can().setTextAlign('right')"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive({ textAlign: 'right' }) }]">
                        <i class="fa-solid fa-align-right"></i>
                    </button>

                    <button title="Ссылка" @click="setLink" :disabled="!editor.can().setLink()"><i
                            class="fa-solid fa-link"></i></button>


                    <button @click="editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run()"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('table') }]">
                        <i class="fa-solid fa-table"></i>
                    </button>
                    <button @click="editor.chain().focus().toggleBulletList().run()"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('bulletList') }]">
                        <i class="fa-solid fa-list-ul"></i>
                    </button>
                    <button @click="editor.chain().focus().toggleOrderedList().run()" title="Нумерованный список"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('orderedList') }]">
                        <i class="fa-solid fa-list-ol"></i>
                    </button>
                    <button @click="addImage" class="p-2 shadow rounded-sm"><i class="fa-regular fa-image"></i></button>
                    <button @click="editor.chain().focus().toggleBlockquote().run()" title="Цитата"
                        :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('blockquote') }]">
                        <i class="fa-solid fa-quote-right"></i>
                    </button>
                    <button @click="editor.chain().focus().undo().run()" class="p-2 shadow rounded-sm">
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                    <button @click="editor.chain().focus().redo().run()" class="p-2 shadow rounded-sm">
                        <i class="fa-solid fa-rotate-right"></i>
                    </button>
                    <template v-if="editor.isActive('table')">
                        <button @click="editor.chain().focus().addColumnBefore().run()"
                            :disabled="!editor.can().chain().focus().addColumnBefore().run()"
                            :class="['p-2 shadow rounded-sm', { 'bg-gray-200': false }]">
                            <i class="fa-solid fa-plus"></i> Столбец
                        </button>
                        <button @click="editor.chain().focus().addRowBefore().run()"
                            :disabled="!editor.can().chain().focus().addRowBefore().run()"
                            :class="['p-2 shadow rounded-sm', { 'bg-gray-200': false }]">
                            <i class="fa-solid fa-plus"></i> Строка
                        </button>
                        <button @click="editor.chain().focus().deleteColumn().run()"
                            :disabled="!editor.can().chain().focus().deleteColumn().run()"
                            :class="['p-2 shadow rounded-sm', { 'bg-gray-200': false }]">
                            <i class="fa-solid fa-minus"></i> Столбец
                        </button>
                        <button @click="editor.chain().focus().deleteRow().run()"
                            :disabled="!editor.can().chain().focus().deleteRow().run()"
                            :class="['p-2 shadow rounded-sm', { 'bg-gray-200': false }]">
                            <i class="fa-solid fa-minus"></i> Строка
                        </button>
                        <button @click="editor.chain().focus().deleteTable().run()"
                            :disabled="!editor.can().chain().focus().deleteTable().run()"
                            :class="['p-2 shadow rounded-sm text-red-800', { 'bg-gray-200': false }]">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <button @click="editor.chain().focus().mergeCells().run()"
                            :class="['p-2 shadow rounded-sm', { 'bg-gray-200': false }]">
                            <i class="fa-solid fa-compress"></i> Объединить ячейки
                        </button>
                        <button @click="editor.chain().focus().splitCells().run();"
                            :class="['p-2 shadow rounded-sm', { 'bg-gray-200': false }]">
                            <i class="fa-solid fa-expand"></i> Разделить ячейки
                        </button>
                    </template>
                </div>
                <input type="file" ref="file" @input="uploadImage" class="hidden">
            </div>
            <div class="flex">
                <editor-content class=" basis-2/3" :editor="editor" />
                <div class="basis-1/3">
                    <div class="py-2 font-bold text-center text-lg">Изображения статьи</div>
                    <div class="flex flex-wrap">
                        <div v-for="file in files" class="basis-1/2 p-1">
                            <img class="h-auto max-w-full" :src="`/${file.filepath}`" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {
    Editor,
    EditorContent
} from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import TextAlign from '@tiptap/extension-text-align';
import Table from '@tiptap/extension-table'
import TableRow from '@tiptap/extension-table-row'
import TableCell from '@tiptap/extension-table-cell'
import TableHeader from '@tiptap/extension-table-header'
import Image from '@tiptap/extension-image';
import Link from '@tiptap/extension-link';
export default {
    name: "TextEditor",
    components: {
        Editor,
        EditorContent
    },
    props: {
        entity: {
            type: Object,
            required: true
        },
        type: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            editor: null,
            files: []
        }
    },
    methods: {
        addImage() {
            this.$refs.file.click();
        },
        uploadImage(event) {
            const file = event.target.files[0];
            if (file) {
                let form = new FormData();
                form.append('file[]', file);
                if (this.entity.id) form.append('entity_id', this.entity.id);
                form.append('entity_type', this.type);
                axios.post('/files/upload', form, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    if (response.data.files) {
                        this.files.push()
                        this.editor.chain().focus().setImage({
                            src: response.data.files[0].filepath
                        }).run();
                    }
                });
            }
        },
        setLink() {
            const url = prompt('Введите URL')

            if (url) {
                this.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run()
            }
        }
    },
    mounted() {
        if (this.entity.images) {
            this.entity.images.forEach(item => {
                this.files.push(item);
            });
        }
        this.editor = new Editor({
            content: this.entity.content,
            editorProps: {
                attributes: {
                    class: 'p-4 focus:outline-1 focus:outline-dashed outline-gray-600 min-h-80 h-full prose prose-editor',
                },
            },
            extensions: [
                StarterKit,
                TextAlign.configure({
                    types: ['heading', 'paragraph'],
                }),
                Table,
                TableRow,
                TableCell,
                TableHeader,
                Image,
                Link
            ],
            onUpdate: ({
                editor
            }) => {
                this.$emit('update-content', editor.getHTML());
            },
        })
    },
    beforeUnmount() {
        this.editor.destroy()
    },
}
</script>

<style scoped></style>
