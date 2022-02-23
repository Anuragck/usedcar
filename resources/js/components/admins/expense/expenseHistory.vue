<template>
  <div class="mb-3">
    <div class="row">
      <div class="col font-weight-bold">Brand Name : {{ brand_name }}</div>

      <div class="col font-weight-bold">Model Name : {{ model_name }}</div>

      <div class="col font-weight-bold">Reg No : {{ reg_no }}</div>
    </div>
    <div class="row float-left shadow-sm p-3 mb-5 bg-white rounded">
      <div class="">
        <h6 class="m-0 font-weight-bold text-muted">
          Total Expense :
          <span class="text-dark f"> {{ total_expenses }}</span>
        </h6>
      </div>
    </div>
    <div class="table-responsive mt-3">
      <table
        id="expense_history_table"
        ref="expense_history_table"
        class="display table table-striped table-hover"
      >
        <thead>
          <tr>
            <th>Sl.No</th>
            <th>Date</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Pay Type</th>
            <th>Description</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(expense, index) in expenseHistory" :key="expense.id">
            <td>{{ index + 1 }}</td>
            <td>{{ expense.pay_date }}</td>
            <td>{{ expense.expense_category.name }}</td>
            <td>{{ expense.amount }}</td>
            <td>{{ expense.pay_type }}</td>
            <td>{{ expense.remarks }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      expenseHistory: {},

      id: "",
      brand_name: "",
      model_name: "",
      reg_no: "",
      total_expenses: "",
    };
  },

  methods: {
    getExpenseHistory() {
      axios
        .get("get-expense-history", {params: { id: this.id } })
        .then((response) => {
          this.expenseHistory = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  created() {

    var _this = this;
    bus.$on("expense-history", function (purchase) {
      _this.id = purchase.id;
      _this.brand_name = purchase.brands.name;
      _this.model_name = purchase.models.name;
      _this.reg_no = purchase.reg_no;
      _this.total_expenses = purchase.total_expenses;

 _this.getExpenseHistory();
    });
  },

  watch: {
    expenseHistory(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.expense_history_table).DataTable({
          pageLength: 5,

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.expense_history_table).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
