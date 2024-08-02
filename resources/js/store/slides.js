export default {
    namespaced: true,
    state: {
        slides: []
    },
    getters: {
        slides(state){
            return state.slides;
        }
    },
    mutations: {
        load(state) {
            axios.get('/dashboard/slider/data').then(response => {
                state.slides = response.data.slides;
                console.log(state.slides)
            });
        },
        remove(state, payload){
            if(payload.id){
                axios.post(`/dashboard/slider/delete/${payload.id}`).then(response => {
                    if(response.data.status) state.slides.splice(state.slides.indexOf(payload), 1);
                });
            } else {
                state.slides.splice(state.slides.indexOf(payload), 1);
            }

        },
        add(state){
            state.slides.push({id: 0, status: 0, title: "Новый слайд", subtitle: "Подзаголовок", positioning: 'left', buttons: null,
                 text: "Текст слайда", image: null, color1: '#9ca3af', color2: '#f3f4f6', text_color: "#0e7490"});
                  
        },
        storeSlide(state, i){
            let slide = state.slides[i];
            axios.post(`/dashboard/slider/update/`, slide,
                {
                    headers: {"Content-Type": "multipart/form-data"}
                }).then(response => {
                    if(response.data.result){
                        slide = response.data.result;
                    }
                });
        }, 
        update(state, {i,n,v}){
            let slide = state.slides[i], data = new FormData();
            data.append(n, v);
            axios.post(`/dashboard/slider/update/${slide.id}`, data,
            {
                headers: {"Content-Type": "multipart/form-data"}
            }).then(response => {
                if(response.data.result){
                    state.slides[i] = response.data.result;
                }

            });
        }, 
        updateOrdering(state){
            state.slides.forEach((item, index) => {
                item.ordering = index + 1;
            });
            axios.post(`/dashboard/slider/ordering`, {items: state.slides});
        },
        setSlides(state, slides) {
            state.slides = slides;
        },
    },
    actions: {
        load({commit}) {
            commit('load');
        },
        add({commit}) {
            commit('add');
        },
        remove({commit}, payload) {
            commit('remove', payload);
        },
        updateOrdering({commit}){
            commit('updateOrdering');
        },
        store({commit}, payload){
            commit('storeSlide', payload);
        },
        storeButton({commit}, payload){
            commit('storeButton', payload);
        },
        updateButton({commit}, payload){
            commit('updateButton', payload);
        }
    }
}
