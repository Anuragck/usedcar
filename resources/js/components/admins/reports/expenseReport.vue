<template>
  <div class="main">
    <div class="col-lg-12">
      <div class="card mb-4">
        <div
          class="
            card-header
            py-3
            d-flex
            flex-row
            align-items-center
            justify-content-between
          "
        >
          <h5 class="m-0 font-weight-bold text-dark">Expense Reports</h5>
          <!--FilterButton-->

          <div class="col-md-2 ml-auto">
            <button
              class="btn btn-primary btn-sm float-right rounded-pill"
              @click="viewFilters()"
              v-if="search == false"
            >
              Add Filters<i class="fas fa-filter fa-fw"></i>
            </button>
            <button
              class="btn btn-danger btn-sm float-right rounded-pill"
              @click="hideFilter()"
              v-if="search"
            >
              Clear Filter <i class="far fa-times-circle fa-fw"></i>
            </button>
          </div>
          <!--FilterButton end-->
        </div>
        <div class="" v-if="search">
          <div class="row justify-content-center mt-3">
            <div class="" style="">
              <div class="input-group">
                <span class="input-group-text">From</span>
                <input type="Date" class="form-control" v-model="from_date" />
                <span
                  class="input-group-text ml-4 px-3"
                  style="border-left: 0; border-right: 0"
                >
                  To
                </span>
                <input type="Date" class="form-control" v-model="to_date" />
                <button
                  class="btn btn-sm btn-primary ml-4"
                  @click="addFilters()"
                >
                  Search <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-------------------------->
        <div class="table-responsive p-3">
          <table
            class="
              table
              align-items-center
              table-flush table-hover
              display
              dataTables_wrapper
            "
            id="expenseReportTable"
            ref="expenseReportTable"
          >
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>
                <th>Purchased Price</th>
                <th>Total Expense</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sl.No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>
                <th>Purchased Price</th>
                <th>Total Expense</th>
              </tr>
            </tfoot>
            <tbody>
              <tr
                v-for="(expense, index) in expenseReportData"
                :key="expense.id"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ expense.brands.name }}</td>
                <td>{{ expense.models.name }}</td>
                <td>{{ expense.reg_no }}</td>
                <td>{{ expense.purchase_price }}</td>
                <td v-if="expense.total_expenses != null">
                  {{ expense.total_expenses }}
                </td>
                <td v-if="expense.total_expenses == null">{{ "0" }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- add purchase modal -->

      <!-- modal end -->

      <!-- add purchase modal -->
    </div>
  </div>
</template>
<script>
export default {
  props: [""],
  data() {
    return {
      from_date: "",
      to_date: "",
      expenseReportData: {},
      title: "",

      search: false,
    };
  },

  methods: {
    getExpenseReport() {
      axios
        .get("get-expense-report", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.expenseReportData = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    addFilters() {
      this.getExpenseReport();
      this.from_date = "";
      this.to_date = "";
    },
    hideFilter() {
      this.getExpenseReport();
      this.search = false;
      this.from_date = "";
      this.to_date = "";
    },

    viewFilters() {
      this.search = true;
    },
  },

  created() {
    this.getExpenseReport();
  },

  watch: {
    expenseReportData(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.expenseReportTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Expense Report",
              className: "btn btn-primary btn-xs mt-3 ",
              exportOptions: {},
            },
            {
              extend: "excel",
              title: "Expense Report",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              exportOptions: {},
            },
            {
              extend: "pdf",
              title: "Expense Report",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              exportOptions: {},
            },
            {
              extend: "print",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              title: "Expense Report",
              exportOptions: {},
            },
          ],

          lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
          ],
        });
      });
    },
  },

  mounted() {
    this.dt = $(this.$refs.expenseReportTable).DataTable({
      pageLength: 5,
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Expense Report",
          className: "btn btn-primary btn-xs mt-3",
          exportOptions: {},
        },
        {
          extend: "excel",
          title: "Expense Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {},
        },
        {
          extend: "pdf",
          title: "Expense Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {},
        },
        {
          extend: "print",
          title: "Expense Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {},
        },
      ],

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
<style scoped>
</style>
