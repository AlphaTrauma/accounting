<template>
    <div>
        <h2 class="text-2xl font-bold text-center my-4">Список заявок на выполнение заказа</h2>
        <div v-for="response in responses" :class="['py-3 px-4 bg-gradient-to-r to-slate-200 from-transparent mb-2 text-lg flex justify-between',
            {'disabled': active !== response.user.id}
        ]">
            <a :href="`executors/${response.user.id}`">{{ response.user.name }}</a>
            <request-action  v-if="!active" :route="`/responses/${response.id}/confirm`" text="Вы уверены, что хотите назначить этого исполнителя?">
                <div class="btn btn-sm btn-active">Принять заявку</div>
            </request-action>
            
            <div v-else-if="actve != response.user.id" class="btn btn-sm btn-secondary disabled">Отклонена</div>
            <div v-else class="btn btn-sm btn-primary disabled">Принята</div>
        </div>
    </div>
</template>

<script>
     export default {
        name: "Responses",
        props: {
            order_id: {
                type: Number,
                required: true
            }
        },
        data(){
            return {
                responses: [],
                active: null
            }
        },
        mounted(){
            this.load();
        },
        methods: {
            load(){
                axios.get(`/order/${this.$props.order_id}/responses`).then(response => {
                    this.responses = response.data.responses;
                    this.active = response.data.active;
                })
            }
        }
     }
</script>