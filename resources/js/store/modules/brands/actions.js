import axios from "axios";
import * as actions from "../../action_types";
import * as mutations from "../../mutation_types";

export default {
    async [actions.GET_BRANDS]({ commit }) {
        const brands = await axios.get("/api/brand");
        if (brands.data.success == true) {
            commit(mutations.SET_BRANDS, brands.data.data);
        }
    }
};
