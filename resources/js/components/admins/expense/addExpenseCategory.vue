<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_expensecategory_modal"
        @click="closeExpenseCategoryModal()"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="form-group form-floating-label mt-2">
        <input
          id="inputFloatingLabel"
          type="text"
          class="form-control input-border-bottom"
          required=""
          name="expenscategory_name"
          v-model="expensecategoryData.expensecategory_name"
        />
        <label for="inputFloatingLabel" class="placeholder"
          >Enter Expense Category Name</label
        >
      </div>
    </div>

    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-secondary"
        data-dismiss="modal"
        @click="closeExpenseCategoryModal"
      >
        Close
      </button>
      <button type="button" class="btn btn-primary" @click="addExpenseCategory()">
        Save changes
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["edit"],
  data() {
    return {
      title: "Add Expense Category",

      expensecategoryData: {
        id: "",
        expensecategory_name: "",
      },

      errors: {},
    };
  },

  methods: {
    closeExpenseCategoryModal() {
      bus.$emit("closing-expensecategory-modal");
      this.clearFormData();
    },

    addExpenseCategory() {
      axios
        .post("add-expensecategory", this.expensecategoryData)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Expense Category Successfully Added",
            });
            this.$refs.close_expensecategory_modal.click();
            this.closeExpenseCategoryModal();
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      for (let data in this.expensecategoryData) {
        this.expensecategoryData[data] = "";
      }

      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },
  },

  created() {
    if (this.edit) {
      this.title = "Edit Expense Category";

      var _this = this;
      bus.$on("edit-expensecategory", function (expensecategory) {
        _this.clearFormData();

        _this.expensecategoryData.id = expensecategory.id;
        _this.expensecategoryData.expensecategory_name = expensecategory.name;
      });
    }
  },
};
</script>
