<template>
    <div @click="open" :title="tooltip" :class="`cursor-pointer no-underline hover:no-underline active:no-underline transition-all ${classes}`">
        <span v-if="icon" :class="`glyphicon ${icon}`"></span>
        <span v-if="text">{{ text }}</span>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    export default {
        name: "ModalButton",
        props: ['classes', 'text', 'content', 'icon', 'tooltip', 'name', 'args'],
        methods: {
            ...mapActions({
                openModal: "util/openModal",
                openModalComponent: "util/openModalComponent"
            }),
            open(){

                if(this.$props.name){
                    this.openModalComponent({'name': this.$props.name, 'props': this.$props.args});
                } else if(this.$props.content) {
                    this.openModal(this.$props.content);
                }
            }
        },
    }
</script>

<style scoped>

</style>