import axios from "axios";
import * as actions from "../../action_types";
import * as mutations from "../../mutation_types";

export default {
    async [actions.GET_CATEGORIES]({ commit }) {
        const categories = await axios.get("/api/category");
        if (categories.data.success == true) {
            commit(mutations.SET_CATEGORIES, categories.data.data);
        }
    }
};
