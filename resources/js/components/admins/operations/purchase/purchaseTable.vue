<template>
  <div class="col-md-12">
    <div class="card mt-3" v-show="add_purchase_section">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">{{ title }}</h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="showPurchaseTable()"
          >
            <i class="fas fa-backward fa-fw"></i> Back To Purchase List
          </button>
        </div>
      </div>
      <div class="card-body">
        <add-purchase :edit="showEdit"> </add-purchase>
      </div>
    </div>

    <div class="card mt-3" v-show="purchase_table">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <h4 class="card-title font-weight-bold">
            {{ "Vehicle Purchase List" }}
          </h4>
          <button
            class="btn btn-primary btn-round py-1 ml-auto"
            @click="addPurchase()"
          >
            Add Purchase <i class="fa fa-plus"></i>
          </button>
          <button
            class="btn btn-danger btn-round py-1 ml-2"
      @click="deletePurchases()"
          >
            Delete <i class="far fa-trash-alt"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table
            id="purchaseTable"
            ref="purchaseTable"
            class="display table table-striped table-hover"
          >
            <thead>
              <tr>
                <th></th>
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Reg No</th>
                <th>Purchased Price</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th>Sl.No</th>
                <th>Brand Name</th>
                <th>Model Name</th>
                <th>Reg No</th>
                <th>Purchased Price</th>
              </tr>
            </tfoot>
            <tbody>
              <tr @dblclick="purchaseEdit(purchase)" v-for="(purchase, index) in purchaseData"
                :key="purchase.id">
                <td class="text-center">
                  <input
                    class="form-control-input"
                    type="checkbox"
                    v-model="deletePurchase"
                    :value="`${purchase.id}`"
                  />
                </td>
                <td>{{ index+1 }}</td>
                <td>{{ purchase.brands.name }}</td>
                <td>{{ purchase.models.name }}</td>
                <td>{{ purchase.reg_no }}</td>
                <td>{{ purchase.purchase_price }}</td>
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
      showEdit: true,
      purchaseData: {},
      add_purchase_section: false,
      purchase_table: true,

deletePurchase: [],
    };
  },
  created() {
    this.getPurchases();
    var _this = this;
bus.$on("purchase-added", function () {
_this.showPurchaseTable();
_this.getPurchases();
    });
  },

  methods: {
    getPurchases() {
      axios
        .get("get-purchases")
        .then((response) => {
          this.purchaseData = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    showPurchaseTable() {
 bus.$emit("clear-form");
      this.title = "";
      this.showEdit = true;
      this.add_purchase_section = false;
      this.purchase_table = true;
    },

    addPurchase() {
      this.title = "Add Purchase";
      this.showEdit = false;
      this.add_purchase_section = true;
      this.purchase_table = false;
    },

    purchaseEdit(purchase) {

      this.title = "Edit Purchase";
      this.add_purchase_section = true;
      this.purchase_table = false;
      bus.$emit("edit-purchase", purchase);
    },

deletePurchases() {
      if (this.deletePurchase.length == 0) {
        Toast.fire({
          icon: "warning",
          title: "Please Select any Data",
        });
        return false;
      }
      Swal.fire({
        title: "Are you sure?",
        // text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post("delete-purchase/" + this.deletePurchase).then((response) => {
            if (response.data == "success") {
              Toast.fire({
                icon: "success",
                title: "Model Deleted successfully",
              });
              this.getPurchases();
              this.deletePurchase = [];
            }
          });
        }
      });
    },
  },

  watch: {
    purchaseData(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.purchaseTable).DataTable({
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
    this.dt = $(this.$refs.purchaseTable).DataTable({
      pageLength: 5,

      lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
      ],
    });
  },
};
</script>
