<template>
    <div>
        <draggable v-model="slides" draggable=".item" @change="updateOrdering">
            <item class="slide" v-for="(slide, index) in slides" :slide="slide" :index="index" :key="slide.id"></item>
        </draggable>
        <div @click="add" title="Новый слайд" class="btn btn-active text-center" style="width: 100%;">
            <span class="fa fa-plus"></span>
        </div>
    </div>
</template>

<script>
    import Item from "./Item.vue";
    import {mapActions, mapMutations, mapGetters} from 'vuex';
    import { VueDraggableNext } from 'vue-draggable-next'

    export default {
        name: "Index",
        components: {Item, draggable: VueDraggableNext},
        mounted(){
            this.load();
        },
        computed: {
            ...mapGetters({
               items: "slides/slides"
            }),
            slides: {
                get(){
                    return this.items
                },
                set(slides){
                    this.setSlides(slides);
                }
            }
        },
        methods: {
            ...mapActions({
                add: "slides/add",
                load: "slides/load",
                updateOrdering: "slides/updateOrdering"
            }),
            ...mapMutations({
                setSlides: "slides/setSlides",
            })
        }
    }
</script>

<style scoped>
</style>
