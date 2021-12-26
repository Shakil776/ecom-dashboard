import Vue from "vue";
import Vuex from "vuex";
import categories from "./modules/categories";
import brands from "./modules/brands";
import sizes from "./modules/sizes";
import product from "./modules/products";

Vue.use(Vuex);

// modules
const store = new Vuex.Store({
    modules: {
        categories,
        brands,
        sizes,
        product
    }
});

export default store;
