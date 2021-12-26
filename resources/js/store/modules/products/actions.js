import axios from "axios";
import * as actions from "../../action_types";
import * as mutations from "../../mutation_types";

export default {
    async [actions.SAVE_PRODUCT]({ commit }, payload) {
        const product = await axios.post("/store-product", payload);
        if (product.data.success == true) {
            window.location.href = "/store-product";
        }
    }
};
