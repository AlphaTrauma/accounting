<template>
    <div class="">
        <h1>{{ item.id ? 'Редактирование статьи' : 'Создание статьи' }}</h1>
        <div class="my-3 flex gap-4">
            <input type="text" class="tw-input w-full" placeholder="Название статьи">
            <input type="text" class="tw-input w-full" placeholder="Постоянный адрес">


            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" class="sr-only peer">
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"><b>Опубликовано</b></span>
            </label>
        </div>
        <div class="flex gap-4">
            <div class="p-3 basis-1/2">
                <div v-if="editor" class="mb-5">
                    <div  class="flex gap-4 mb-2">
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
                        <button @click="editor.chain().focus().toggleBold().run()" :disabled="!editor.can().chain().focus().toggleBold().run()"
                                :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('bold') }]">
                            <i class="fa-solid fa-bold"></i>
                        </button>
                        <button @click="editor.chain().focus().toggleItalic().run()" :disabled="!editor.can().chain().focus().toggleItalic().run()"
                                :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('italic') }]">
                            <i class="fa-solid fa-italic"></i>
                        </button>

                        <button @click="editor.chain().focus().toggleBulletList().run()"
                                :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('bulletList') }]">
                            <i class="fa-solid fa-list-ul"></i>
                        </button>
                        <button @click="editor.chain().focus().toggleOrderedList().run()" title="Нумерованный список"
                                :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('orderedList') }]">
                            <i class="fa-solid fa-list-ol"></i>
                        </button>
                        <button @click="editor.chain().focus().toggleBlockquote().run()" title="Цитата"
                                :class="['p-2 shadow rounded-sm', { 'bg-gray-200': editor.isActive('blockquote') }]">
                            <i class="fa-solid fa-quote-right"></i>
                        </button>
                        <button @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()"
                                class="p-2 shadow rounded-sm">
                            <i class="fa-solid fa-rotate-left"></i>
                        </button>
                        <button @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()"
                                class="p-2 shadow rounded-sm">
                            <i class="fa-solid fa-rotate-right"></i>
                        </button>
                    </div>

                </div>
                <editor-content :editor="editor" />
            </div>
        </div>
    </div>
</template>

<script>
    import { Editor, EditorContent } from '@tiptap/vue-3'
    import StarterKit from '@tiptap/starter-kit'
    export default {
        name: "TextEditor",
        components: {Editor, EditorContent},
        props: {
            item: {
                type: Object,
                required: true
            },
            className: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                editor: null,
            }
        },
        mounted() {
            this.editor = new Editor({
                content: '<p>Текст статьи</p>',
                editorProps: {
                    attributes: {
                        class: 'p-4 focus:outline-1 focus:outline-dashed outline-gray-600',
                    },
                },
                extensions: [
                    StarterKit,
                ],
            })
        },
        beforeUnmount() {
            this.editor.destroy()
        },
    }
</script>

<style scoped>

</style>
