import * as mutations from "../../mutation_types";

export default {
    [mutations.SET_SIZES](state, payload) {
        state.sizes = payload;
    }
};
