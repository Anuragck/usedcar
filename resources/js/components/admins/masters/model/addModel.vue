<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_model_modal"
        @click="closeModelModal()"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <!-- saleitem search component-->
      <div class="form-group mb-1">
        <div>
          <label>Select Vehicle Brand</label>
          <multiselect
            v-model="selectedBrand"
            label="name"
            :options="brands"
            name="brand"
            :options-limit="4"
            track-by="id"
            placeholder="Search Vehicle Brands Here"
            :disabled="this.edit"
          >
          </multiselect>
        </div>
      </div>

      <!-- saleitem search component end-->

      <div class="form-group form-floating-label mt-2">
        <input
          id="inputFloatingLabel"
          type="text"
          class="form-control input-border-bottom"
          required=""
          name="model_name"
          v-model="modelData.model_name"
        />
        <label for="inputFloatingLabel" class="placeholder"
          >Enter Model Name</label
        >
      </div>
    </div>

    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-secondary"
        data-dismiss="modal"
        @click="closeModelModal"
      >
        Close
      </button>
      <button type="button" class="btn btn-primary" @click="addModel()">
        Save changes
      </button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["edit","filter_brand"],
  data() {
    return {
      title: "Add Model",

      brands: [],
      selectedBrand: [],
      edit_brand_id: "",

      modelData: {
        id: "",
        brand_id: "",
        model_name: "",
      },

      errors: {},
    };
  },

  methods: {
    closeModelModal() {
      bus.$emit("closing-model-modal");
      this.clearFormData();
    },

    getBrands() {
      axios
        .get("get-brands")
        .then((response) => {
          this.brands = response.data;

          if (this.edit || this.filter_brand) {
            this.selectedBrand = this.brands.find(
              (option) => option.id == this.edit_brand_id
            );
          } else {
            this.selectedBrand = "";
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },

    addModel() {
      axios
        .post("add-model", this.modelData)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Model Successfully Added",
            });
            this.$refs.close_model_modal.click();
            this.closeModelModal();
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      for (let data in this.modelData) {
        this.modelData[data] = "";
      }

      this.selectedBrand = [];

      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },
  },

  created() {


    if (this.edit) {
      this.title = "Edit Model";

      var _this = this;
      bus.$on("edit-model", function (model) {
_this.getBrands();
        _this.clearFormData();

        _this.modelData.id = model.id;
        _this.modelData.model_name = model.name;

        _this.edit_brand_id = model.brand_id;
      });
    }
var _this = this;
 bus.$on("filter_brand_id", function (brand_id) {
        console.log(brand_id)

        _this.edit_brand_id=brand_id;
_this.getBrands();

      });

this.getBrands();


  },
  watch: {

    selectedBrand: function () {
      if (this.selectedBrand != null) {
        this.modelData.brand_id = this.selectedBrand.id;
      }
    },


  },
};
</script>
