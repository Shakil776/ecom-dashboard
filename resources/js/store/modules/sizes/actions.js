import axios from "axios";
import * as actions from "../../action_types";
import * as mutations from "../../mutation_types";

export default {
    async [actions.GET_SIZES]({ commit }) {
        const sizes = await axios.get("/api/size");
        if (sizes.data.success == true) {
            commit(mutations.SET_SIZES, sizes.data.data);
        }
    }
};
