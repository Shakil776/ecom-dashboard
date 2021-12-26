<template>
  <section class="content">
    <div class="container-fluid">
      <form method="post" @submit.prevent="saveProduct">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Product</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label
                    >Select Category <sup class="text-danger">*</sup></label
                  >
                  <Select2
                    v-model="form.category_id"
                    :options="categories"
                    :settings="{ placeholder: 'Select' }"
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label>Select Brand <sup class="text-danger">*</sup></label>
                  <Select2
                    v-model="form.brand_id"
                    :options="brands"
                    :settings="{ placeholder: 'Select' }"
                  />
                </div>
              </div>

              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label>Product Name <sup class="text-danger">*</sup></label>
                  <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    placeholder="Enter Product Name"
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label>SKU <sup class="text-danger">*</sup></label>
                  <input
                    v-model="form.sku"
                    type="text"
                    class="form-control"
                    placeholder="Enter SKU"
                  />
                </div>
              </div>

              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label>Cost Price <sup class="text-danger">*</sup></label>
                  <input
                    v-model="form.cost_price"
                    type="text"
                    class="form-control"
                    placeholder="Enter Cost Price [TK]"
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label>Retaile Price <sup class="text-danger">*</sup></label>
                  <input
                    v-model="form.retail_price"
                    type="text"
                    class="form-control"
                    placeholder="Enter Retail Price [TK]"
                  />
                </div>
              </div>

              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label>Year <sup class="text-danger">*</sup></label>
                  <input
                    v-model="form.year"
                    type="text"
                    class="form-control"
                    placeholder="Enter Year [Ex: 2021]"
                  />
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label>Product Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input
                        type="file"
                        class="custom-file-input"
                        accept="image/*"
                        @change="selectImage"
                      />
                      <label
                        v-if="!fileName || !fileName.length"
                        class="custom-file-label"
                        >Choose file</label
                      >
                      <label v-else class="custom-file-label">{{
                        fileName
                      }}</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Product Description</label>
                  <textarea
                    v-model="form.description"
                    class="form-control"
                    rows="3"
                    placeholder="Enter Product Description"
                  ></textarea>
                </div>
              </div>
            </div>
            <div class="row" v-for="(item, index) in form.items" :key="index">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Product Size</label>
                  <Select2
                    v-model="item.size_id"
                    :options="sizes"
                    :settings="{ placeholder: 'Select' }"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Location</label>
                  <input
                    v-model="item.location"
                    type="text"
                    class="form-control"
                    placeholder="Location"
                  />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Quantity</label>
                  <input
                    v-model="item.quantity"
                    type="text"
                    class="form-control"
                    placeholder="Quantity"
                  />
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <input
                    type="button"
                    class="form-control btn btn-danger"
                    value="x"
                    title="Remove"
                    @click="deleteItem(index)"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2">
                <div class="form-group">
                  <input
                    @click="addItem"
                    type="button"
                    class="form-control btn btn-default"
                    value="+ Add More"
                    title="Add"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
import store from "../../store";
import * as actions from "../../store/action_types";
import { mapGetters } from "vuex";
import Select2 from "v-select2-component";

export default {
  components: { Select2 },
  data() {
    return {
      form: {
        category_id: "",
        brand_id: "",
        name: "",
        sku: "",
        image: "",
        cost_price: "",
        retail_price: "",
        year: "",
        description: "",
        items: [
          {
            size_id: "",
            location: "",
            quantity: "",
          },
        ],
      },
      fileName: null,
    };
  },
  computed: {
    ...mapGetters({
      categories: "getCategories",
      brands: "getBrands",
      sizes: "getSizes",
    }),
  },
  mounted() {
    // get categories
    store.dispatch(actions.GET_CATEGORIES);
    // get brands
    store.dispatch(actions.GET_BRANDS);
    // get sizes
    store.dispatch(actions.GET_SIZES);
  },
  methods: {
    selectImage(event) {
      let image = event.target.files[0];
      this.form.image = image;
      this.fileName = image.name;
    },
    addItem() {
      let item = {
        size_id: "",
        location: "",
        quantity: "",
      };
      this.form.items.push(item);
    },
    deleteItem(index) {
      this.form.items.splice(index, 1);
    },
    saveProduct() {
      let data = new FormData();
      data.append("category_id", this.form.category_id);
      data.append("brand_id", this.form.brand_id);
      data.append("name", this.form.name);
      data.append("sku", this.form.sku);
      data.append("image", this.form.image);
      data.append("cost_price", this.form.cost_price);
      data.append("retail_price", this.form.retail_price);
      data.append("year", this.form.year);
      data.append("description", this.form.description);
      if (
        this.form.items[0].size_id != "" ||
        this.form.items[0].location != "" ||
        this.form.items[0].quantity != ""
      ) {
        data.append("items", JSON.stringify(this.form.items));
      }

      store.dispatch(actions.SAVE_PRODUCT, data);
    },
  },
};
</script>
