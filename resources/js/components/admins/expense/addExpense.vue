<template>
  <div class="mb-3">
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>Select Expense Category</label>
          <multiselect
            v-model="selectedCategory"
            label="name"
            :options="categories"
            name="category"
            :options-limit="4"
            track-by="id"
            placeholder="Search Categories Here"
            :disabled="this.edit"
          >
          </multiselect>
          <small class="text-danger" v-if="errors.selectedCategory">
            {{ errors.selectedCategory[0] }}</small
          >
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="date" class="required">Select Date</label>
          <input
            type="date"
            class="form-control"
            name="date"
            v-model="expense.pay_date"
          />
          <small class="text-danger" v-if="errors.pay_date">
            {{ errors.pay_date[0] }}</small
          >
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="paytype" class="required">Select Pay Type</label>
          <select
            class="form-control"
            id="expensePaytype"
            name="expense_pay_type"
            v-model="expense.pay_type"
          >
            <option value="">Select Pay Type</option>
            <option value="Cash">Cash</option>
            <option value="Bank">Bank</option>
          </select>
          <small class="text-danger" v-if="errors.pay_type">
            {{ "The Payment Type field is required" }}</small
          >
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="amount" class="required">Enter Amount</label>
          <input
            type="number step=0.01"
            class="form-control"
            id="expenseAmount"
            placeholder="Enter Amount"
            name="expense_amount"
            v-model="expense.amount"
          />
          <small class="text-danger" v-if="errors.amount">
            {{ "The Expense Amount entered incorrect" }}</small
          >
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="expense_remarks" class="font-weight-bold text-muted"
            >Description</label
          >
          <textarea class="form-control" rows="2" v-model="expense.remarks"> </textarea>
        </div>
      </div>
    </div>

    <div class="div py-4">
      <button class="btn btn-primary btn-round float-right mr-2" @click="addExpense">
        Save Changes
      </button>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["edit"],
  data() {
    return {
      title: "Add Expense",
      categories: [],
      selectedCategory: [],

      expense: {
        vehicle_id: "",
        categories_id: "",
        pay_date: moment().format("YYYY-MM-DD"),
        amount: "",
        pay_type: "",
        remarks: "",
      },
      errors: {},
    };
  },

  methods: {
    getCategories() {
      axios
        .get("get-expensecategories")
        .then((response) => {
          this.categories = response.data;

          if (this.edit || this.filter_categories) {
            this.selectedCategory = this.categories.find(
              (option) => option.id == this.edit_categories_id
            );
          } else {
            this.selectedCategory = "";
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    addExpense() {
      this.loading = true;
      axios
        .post("add-expense", this.expense)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Expense Added Successfully",
              
            });

            bus.$emit("expense-added");
            this.clearFormData();
          
            
            
          }
          
          this.loading = false;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.loading = false;
          console.log("errors");
        });
    },
     

    clearFormData() {
      for (let data in this.expense) {
        this.expense[data] = "";
        this.selectedCategory = [];
      }

      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },
    
  },

  created() {
    var _this = this;
    this.getCategories();

    bus.$on("add-expense", function (vehicle) {
      _this.expense.vehicle_id = vehicle.vehicle_id;
    });
  },
  watch: {
    selectedCategory: function () {
      if (this.selectedCategory != null) {
        this.expense.categories_id = this.selectedCategory.id;
      }
    },
  },
};
</script>
