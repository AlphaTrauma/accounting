export default {
    namespaced: true,
    state: {
        modalStatus: false,
        modalContent: null,
        modalComponent: null,
        modalProps: null
    },
    getters: {
        modalContent: state => state.modalContent,
        modalStatus: state => state.modalStatus,
        modalComponent: state => state.modalComponent,
        modalProps: state => state.modalProps,
    },
    mutations: {
        openModal(state, payload){
            state.modalContent = payload;
            state.modalStatus = true;
        },
        openModalComponent(state, payload){
            state.modalComponent = payload.name;
            state.modalProps = payload.props;
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
            state.modalStatus = true;
        },
        closeModal(state){
            state.modalStatus = false;
            state.modalContent = null;
            document.body.style.overflow = 'auto';
            document.documentElement.style.overflow = 'auto';
        }
    },
    actions: {
        openModal({commit}, payload){
            commit('openModal', payload);
        },
        openModalComponent({commit}, payload){
            commit('openModalComponent', payload);
        },
        closeModal({commit}){
            commit('closeModal');
        }
    }
}