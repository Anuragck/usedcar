<template>
  <div class="col-md-12">
    <div class="card mt-3">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title">Delivery List</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="deliveryListTable"
            ref="deliveryListTable"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <th>Sl.No</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>
                <th>Rc Transfer Status</th>

              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Sl.No</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Reg No</th>

                <th>Rc Transfer Status</th>

              </tr>
            </tfoot>
            <tbody>
              <tr v-for="(delivery, index) in deliveryList"
                :key="delivery.id">
                <td>{{ index+1 }}</td>
                <td>{{ delivery.customer.name }}</td>
                <td>{{ delivery.customer.mobile }}</td>
                <td>{{ delivery.brands.name }}</td>
                <td>{{ delivery.models.name }}</td>
                <td>{{ delivery.reg_no }}</td>
                <td  class="font-weight-bold btn text-warning btn"
                   @click="rcTransfer(delivery)" v-if="delivery.sales.rc_transfer_status == 0">{{ "Pending" }}</td>
 <td  class="font-weight-bold btn text-success btn"
                  v-if="delivery.sales.rc_transfer_status == 1">{{ "Transfered " }}<i class="fas fa-check-circle fa-fw"></i></td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<!--RC TRANSFER modal start-->
    <!-- Modal -->
    <div
      class="modal fade"
      id="rcTransfer"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <rc-transfer></rc-transfer>
        </div>
      </div>
    </div>
    <!--RC TRANSFER modal end-->
  </div>
</template>

<script>
export default {
  data() {
    return {
      deliveryList: {},
    };
  },
  created() {
    this.getDeliveryList();
var _this=this;
 bus.$on("closing-rc-transfer-modal", function () {
      $("#rcTransfer").modal("hide");
_this.getDeliveryList();
    });
  },

  methods: {
    getDeliveryList() {
      axios
        .get("get-delivery-list")
        .then((response) => {
          this.deliveryList = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    rcTransfer(delivery) {
      $("#rcTransfer").modal("show");
        bus.$emit("delivery-status-data",delivery);
    },
  },

  watch: {
    deliveryList(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.deliveryListTable).DataTable({
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
    this.dt = $(this.$refs.deliveryListTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
