<template>
    <transition name="fade">
        <div v-if="status" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click.self.stop="close">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-2xl relative">
                <button @click="close" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class=" overflow-y-auto" style="max-height: calc(100vh - 50px);">
                    <div v-if="content" v-html="content" class="px-4 py-6"></div>
                    <div v-else-if="component">
                        <component :is="getComponent" v-bind="componentProps"></component>
                    </div>
                    <div v-else class="px-4 py-6">Здесь пусто</div>
                </div>
            </div>
        </div>
    </transition>
    </template>
    
    <script>
    import {
        mapActions,
        mapGetters
    } from 'vuex';
    export default {
        name: "Modal",
        computed: {
            ...mapGetters({
                status: 'util/modalStatus',
                content: 'util/modalContent',
                component: 'util/modalComponent',
                componentProps: 'util/modalProps'
            }),
            getComponent() {
                return this.component;
            }
        },
        methods: {
            ...mapActions({
                close: 'util/closeModal'
            })
        },
    }
    </script>
    
    <style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.3s ease;
    }
    
    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
    </style>
    