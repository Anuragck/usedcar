<template>
  <div class="main">
    <div class="col-lg-12">
  <div class="card mt-3" v-show="show_single_purchase">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showPurchaseTable()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Purchase Report List
          </button>
        </div>
      </div>
      <div class="card-body">
        <add-purchase :report_only="true" :edit="true"> </add-purchase>
      </div>
    </div>
      <div class="card mb-4" v-show="purchase_table">
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
          <h5 class="m-0 font-weight-bold text-dark">Purchase Reports</h5>
          <!--FilterButton-->

          <div class="col-md-2 ml-auto">
            <button class="btn btn-primary btn-sm float-right rounded-pill"  @click="viewFilters()"
              v-if="search == false">
              Add Filters<i class="fas fa-filter fa-fw"></i>
            </button>
            <button
              class="btn btn-danger btn-sm float-right rounded-pill" @click="hideFilter()"
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
                <button class="btn btn-sm btn-primary ml-4"   @click="addFilters()">
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
            id="purchaseTable"
            ref="purchaseTable"
          >
            <thead>
              <tr>

                <th>Sl.No</th>
                <th>Brand </th>
                <th>Model </th>
                <th>Reg No</th>
                <th>Purchased Price</th>
 <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>

                <th>Sl.No</th>
                <th>Brand </th>
                <th>Model </th>
                <th>Reg No</th>
                <th>Purchased Price</th>
<th>Status</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(purchase, index) in purchaseData" :key="purchase.id">
                <td>{{ index + 1 }}</td>
                <td>{{ purchase.brands.name }}</td>
                <td>{{ purchase.models.name }}</td>
                <td>{{ purchase.reg_no }}</td>
                <td>{{ purchase.purchase_price }}</td>
<td>{{ 'Status' }}</td>
                <td><button class="btn btn-primary btn-sm" @click="singleVehicleReport(purchase)"><i class="fas fa-eye fa-fw" title="view details"></i></button></td>
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
      purchaseData: {},
show_single_purchase:false,
 purchase_table: true,
reportOnly:false,
title: "",

 search: false,

    };
  },

  methods: {
    getPurchases() {
      axios
        .get("get-purchases", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.purchaseData = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

 addFilters() {
      this.getPurchases();
      this.from_date = "";
      this.to_date = "";
    },
    hideFilter() {
      this.getPurchases();
      this.search = false;
      this.from_date = "";
      this.to_date = "";
    },

    viewFilters() {
      this.search = true;
    },

singleVehicleReport(purchase) {
//    this.reportOnly = true;
      this.title = "Vehicle Report";
      this.show_single_purchase = true;
     this.purchase_table= false;
      bus.$emit("edit-purchase", purchase);
    },

 showPurchaseTable() {

      this.reportOnly = false;
      this.show_single_purchase = false;
      this.purchase_table = true;
    },
  },

  created() {
    this.getPurchases();
  },

  watch: {
    purchaseData(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.purchaseTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Purchase Report",
              className: "btn btn-primary btn-xs mt-3 ",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "excel",
              title: "Purchase Report",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "pdf",
              title: "Purchase Report",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
            },
            {
              extend: "print",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              title: "Purchase Report",
              exportOptions: {
                columns: ":visible:not(:eq(5))",
              },
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
    this.dt = $(this.$refs.purchaseTable).DataTable({
      pageLength: 5,
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Purchase Report",
          className: "btn btn-primary btn-xs mt-3",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "excel",
          title: "Purchase Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "pdf",
          title: "Purchase Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
        },
        {
          extend: "print",
          title: "Purchase Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {
            columns: ":visible:not(:eq(5))",
          },
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
