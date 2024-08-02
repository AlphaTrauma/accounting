<template>
    <div class="w-full bg-gradient-to-r from-teal-600 to-cyan-700 ">
        <div class=" bg-no-repeat bg-cover bg-right md:bg-[url('http://accounting.test/images/graph1.png')]  py-10">
            <div class="flex align-center justify-between max-w-screen-xl mx-auto">
                <div v-for="item, i in highLevelItems">
                    <div @click="setActive(item)"
                        :class="['flex items-center transition-all relative p-3 text-xl font-bold text-cyan-700 rounded-lg hover:shadow cursor-pointer border-4',
                            {'bottom-path bg-transparent border-white text-white': active === item.id }, {' bg-white hover:bg-gray-200 border-transparent': active !== item.id}
                        ]">
                        <span v-html="icons[i]"></span>
                        <span class="flex-1 ms-3 whitespace-nowrap">{{ item.title }}</span>
                    </div>
                </div>
            </div>
            <transition name="fade">
                <div v-if="active" class="flex align-center justify-start max-w-screen-xl mx-auto py-4 mt-4 gap-3 border-t-4 border-t-white">
                    <a :href="item.url" v-for="item in getChildren(active)"
                        class="p-3 text-xl font-bold text-cyan-700 rounded-lg bg-gray-100  hover:bg-gray-200 transition-all underline relative top-path">
                        {{ item.title }}
                    </a>
                </div>
            </transition>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            active: null,
            items: [],
            icons: [
                '<i class="fa-solid fa-coins"></i>',
                '<i class="fa-solid fa-building-columns"></i>',
                '<i class="fa-solid fa-cash-register"></i>',
                '<i class="fa-regular fa-handshake"></i>',
                '<i class="fa-solid fa-calculator"></i>',
                '<i class="fa-regular fa-thumbs-up"></i>'
            ]
        }
    },
    mounted(){
        this.load();
    },
    computed: {
        highLevelItems() {
            return this.items.filter(item => !item.parent_id);
        }
    },
    methods: {
        setActive(item){
            this.active = this.active === item.id ? null : item.id;
        },
        getChildren(id) {
            return this.items.filter(item => item.parent_id === id);
        },
        async load() {
            axios.get(`/dashboard/menu-items/affiliate`).then(response => {
                this.items = response.data.items
            });
        },
    }

}
</script>

<style scoped> 
    .bottom-path::after {
        content: "";
        position: absolute;
        left: 50%;
        transform: translate(-50%);
        width: 4px;
        height: 20px;
        top: 100%;
        background-color: white;
    }
    .top-path::after {
        content: "";
        position: absolute;
        left: 50%;
        transform: translate(-50%);
        width: 4px;
        height: 20px;
        bottom: 100%;
        background-color: white;
    }
</style>