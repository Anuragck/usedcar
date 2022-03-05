<template>
  <div class="col-md-12">
    <div class="card mt-3" v-show="expense_history_section">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showVehicleTable()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Vehicle List
          </button>
        </div>
      </div>
      <div class="card-body">
        <expense-history></expense-history>
      </div>
    </div>

    <div class="card mt-3" v-show="add_expense_section">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showVehicleTable()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Vehicle List
          </button>
        </div>
      </div>
      <div class="card-body">
        <add-expense></add-expense>
      </div>
    </div>

    <div class="card mt-3" v-show="ready_to_sell_section">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showVehicleTable()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Vehicle List
          </button>
        </div>
      </div>
      <div class="card-body">
        <ready-to-sell></ready-to-sell>
      </div>
    </div>

    <div class="card mt-3" v-show="vehicle_list_table">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">
            {{ "Vehicle List  (Work Pending Vehicles)" }}
          </h4>
          <!--<button class="btn btn-danger btn-round py-1 ml-auto">
            Delete <i class="far fa-trash-alt"></i>
          </button>-->
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="vehicleListTable"
            ref="vehicleListTable"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <!-- <th></th>-->
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Reg No</th>
                <th>Purchased Price</th>

                <th>Total Expense</th>
                <!-- <th>Sale Status</th> -->
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <!-- <th></th>-->
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Reg No</th>
                <th>Purchased Price</th>
                <th>Total Expense</th>
                <!-- <th>Sale Status</th> -->
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(purchase, index) in purchaseData" :key="purchase.id">
                <!-- <td class="text-center">
                  <input
                    class="form-control-input"
                    type="checkbox"
                    id="inlineCheckbox1"
                    value="option1"
                  />
                </td>-->
                <td>{{ index + 1 }}</td>
                <td>{{ purchase.brands.name }}</td>
                <td>{{ purchase.models.name }}</td>
                <td>{{ purchase.reg_no }}</td>
                <td>{{ purchase.purchase_price }}</td>
                <td v-if="purchase.total_expenses == null">{{ "0" }}</td>
                <td v-if="purchase.total_expenses != null">
                  {{ purchase.total_expenses }}
                </td>
                <!-- <td>{{ purchase.sale_status }}</td> -->

                <td style="white-space: nowrap">
                  <button
                    class="btn btn-secondary btn-xs"
                    @click="showExpenseHistory(purchase)"
                  >
                    <i
                      class="far fa-eye fa-lg"
                      title="view expense history"
                    ></i>
                  </button>
                  <button
                    class="btn btn-info btn-xs"
                    @click="addExpenseSection(purchase)"
                  >
                    <i
                      class="fas fa-hand-holding-usd fa-lg"
                      title="add expense"
                    ></i>
                  </button>
                  <button
                    class="btn btn-success btn-xs"
                    @click="readyTosellSection(purchase)"
                  >
                    <i
                      class="fas fa-clipboard-check fa-lg"
                      title="ready to sell"
                    ></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: "",
      expense_history_section: false,
      add_expense_section: false,
      ready_to_sell_section: false,
      vehicle_list_table: true,
      purchaseData: {},
    };
  },
  created() {
    this.getVehicleList();
    var _this = this;
    bus.$on("expense-added", function () {
      _this.getVehicleList();
      _this.showVehicleTable();
    });

    bus.$on("vehicle-is-reday", function () {
      _this.getVehicleList();
      _this.showVehicleTable();
    });
  },

  methods: {
    getVehicleList() {
      axios
        .get("get-vehicle-list")
        .then((response) => {
          this.purchaseData = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    showExpenseHistory(purchase) {
      this.title = "Expense History";
      this.expense_history_section = true;
      this.vehicle_list_table = false;
      bus.$emit("expense-history", purchase);
    },

    showVehicleTable() {
      this.title = "";
      this.add_expense_section = false;
      this.expense_history_section = false;
      this.ready_to_sell_section = false;
      this.vehicle_list_table = true;
    },

    addExpenseSection(purchase) {
      if (purchase.images.length == 0) {
        Swal.fire({
          text: "Please Upload Documents/Images First!",
          icon: "warning",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Ok",
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = "dashboard#/images";
          }
        });
        return false;
      }
      this.title = "Add Expense";
      this.expense_history_section = false;
      this.vehicle_list_table = false;
      this.add_expense_section = true;

      const vehicle = {
        vehicle_id: purchase.id,
      };
      bus.$emit("add-expense", vehicle);
    },

    readyTosellSection(purchase) {
      if (purchase.images.length == 0) {
        // Swal.fire({
        //   icon: "warning",
        //   text: "Please Upload Documents/Images First!",
        // });
        Swal.fire({
          // title: "Are you sure?",
          text: "Please Upload Documents/Images First!",
          icon: "warning",
          // showCancelButton: true,
          confirmButtonColor: "#3085d6",
          // cancelButtonColor: "#d33",
          confirmButtonText: "Ok",
        }).then((result) => {
          if (result.isConfirmed) {
            window.location = "dashboard#/images";
          }
        });
        return false;
      }
      this.title = "Ready To Sell";
      this.expense_history_section = false;
      this.vehicle_list_table = false;
      this.add_expense_section = false;
      this.ready_to_sell_section = true;

      bus.$emit("ready-to-sell", purchase);
    },
  },

  watch: {
    purchaseData(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.vehicleListTable).DataTable({
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
    this.dt = $(this.$refs.vehicleListTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
