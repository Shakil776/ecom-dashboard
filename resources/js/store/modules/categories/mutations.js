import * as mutations from "../../mutation_types";

export default {
    [mutations.SET_CATEGORIES](state, payload) {
        state.categories = payload;
    }
};
