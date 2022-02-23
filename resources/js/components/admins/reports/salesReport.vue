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
          <h5 class="m-0 font-weight-bold text-dark">Sales Reports</h5>
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
            id="salesReportTable"
            ref="salesReportTable"
          >
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Purchased Price</th>
                <th>Sale Price</th>
                <th>RC Status</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sl.No</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Purchased Price</th>
                <th>Sale Price</th>
                <th>RC Status</th>
              </tr>
            </tfoot>
            <tbody>
              <tr
                v-for="(sale, index) in salesReportData"
                :key="sale.id"
              >
                <td>{{ index + 1 }}</td>
                <td>{{ sale.brands.name }}</td>
                <td>{{ sale.models.name }}</td>
                <td>{{ sale.reg_no }}</td>
                <td>{{ sale.customer.name }}</td>
                <td>{{ sale.customer.mobile }}</td>
                <td>{{ sale.purchase_price }}</td>
                <td>{{ sale.sales.sale_price }}</td>

<td  class="font-weight-bold text-warning"
                   v-if="sale.sales.rc_transfer_status == 0">{{ "Pending" }}</td>

 <td  class="font-weight-bold text-success"
                  v-if="sale.sales.rc_transfer_status == 1">{{ "Transfered " }}<i class="fas fa-check-circle fa-fw"></i></td>
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
      salesReportData: {},
      title: "",

      search: false,
    };
  },

  methods: {
    getSalesReport() {
      axios
        .get("get-delivery-list", {
          params: {
            from_date: this.from_date,
            to_date: this.to_date,
          },
        })
        .then((response) => {
          this.salesReportData = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    addFilters() {
      this.getSalesReport();
      this.from_date = "";
      this.to_date = "";
    },
    hideFilter() {
      this.getSalesReport();
      this.search = false;
      this.from_date = "";
      this.to_date = "";
    },

    viewFilters() {
      this.search = true;
    },
  },

  created() {
    this.getSalesReport();
  },

  watch: {
    salesReportData(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.salesReportTable).DataTable({
          pageLength: 5,
          dom: "lBfrtip",
          buttons: [
            {
              extend: "copy",
              title: "Sales Report",
              className: "btn btn-primary btn-xs mt-3 ",
              exportOptions: {

              },
            },
            {
              extend: "excel",
              title: "Sales Report",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              exportOptions: {

              },
            },
            {
              extend: "pdf",
              title: "Sales Report",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              exportOptions: {

              },
            },
            {
              extend: "print",
              className: "btn btn-primary btn-xs mt-3 ml-1",
              title: "Sales Report",
              exportOptions: {

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
    this.dt = $(this.$refs.salesReportTable).DataTable({
      pageLength: 5,
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copy",
          title: "Sales Report",
          className: "btn btn-primary btn-xs mt-3",
          exportOptions: {

          },
        },
        {
          extend: "excel",
          title: "Sales Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {

          },
        },
        {
          extend: "pdf",
          title: "Sales Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {

          },
        },
        {
          extend: "print",
          title: "Sales Report",
          className: "btn btn-primary btn-xs mt-3 ml-1",
          exportOptions: {

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
