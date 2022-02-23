<template>
  <div class="mb-3">
    <div class="px-3 py-2">
      <div class="div text-center mb-3">
        <h6 class="font-weight-bold">
          <span class="text-muted">Vehicle : </span
          ><span class="ml-1"> {{ vehicle_brand }} </span>
          <Span>{{ vehicle_model }}</Span>
          <span class="ml-5 text-muted">Reg No :</span>
          <span>{{ reg_no }} </span>
        </h6>
      </div>

      <div class="row">
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="align-self-center">
                    <i class="icon-pencil primary font-large-2 float-left"></i>
                  </div>
                  <div class="media-body text-right">
                    <h3>{{ purchase_price }}</h3>
                    <span>Purchased Price</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="align-self-center">
                    <i class="icon-speech warning font-large-2 float-left"></i>
                  </div>
                  <div class="media-body text-right">
                    <h3>{{ total_expense }}</h3>
                    <span>Total Exepense</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="align-self-center">
                    <i class="icon-graph success font-large-2 float-left"></i>
                  </div>
                  <div class="media-body text-right">
                    <h3>{{ parseFloat(total_price).toFixed(2) }}</h3>
                    <span>Sub Total</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Enter Selling Price</label
          >
          <input
            type="number"
            class="form-control"
            placeholder="Enter selling price"
            v-model="vehicleData.selling_price"
          />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="comment" class="font-weight-bold text-muted"
            >Small Description About Vehicle</label
          >
          <textarea
            class="form-control"
            rows="3"
            v-model="vehicleData.description"
          >
          </textarea>
        </div>
      </div>
    </div>

    <div class="div py-4">
      <button
        class="btn btn-primary btn-round float-right mr-2"
        @click="submitReady()"
      >
        Save Changes
      </button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      title: "Ready To Sell",

      vehicle_model: "",
      vehicle_brand: "",
      reg_no: "",

      purchase_price: "",
      total_expense: "",

      total_price: "",

      vehicleData: {
        vehicle_id: "",
        selling_price: "",
        description: "",
      },

errors:{},
    };
  },

  methods: {
    submitReady() {
      if (this.vehicleData.selling_price == "") {
        Toast.fire({
          icon: "warning",
          title: "Vehicle Selling Price is Empty",
        });
        return false;
      }
      if (this.vehicleData.selling_price < this.total_price) {
        Swal.fire({
          title: "Are you sure?",
          text: "The Selling Price is Less than the the Total Price!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes,Proceed",
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post("ready-sell", this.vehicleData).then((response) => {
              if (response.data == "success") {
                Toast.fire({
                  icon: "success",
                  title: "Vehicle is Added for Sale",
                });
this.clearFormData();
 bus.$emit("vehicle-is-reday");
              }
            });
          }
        });
      } else {
        axios.post("ready-sell", this.vehicleData).then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Vehicle is Added for Sale",
            });
this.clearFormData();
  bus.$emit("vehicle-is-reday");
          }
        });
      }
    },


clearFormData(){
 for (let data in this.vehicleData) {
        this.vehicleData[data] = "";
      }

      for (let er in this.errors) {
        this.errors[er] = "";
      }
}
  },

  created() {
    var _this = this;
    bus.$on("ready-to-sell", function (purchase) {
      _this.vehicle_model = purchase.models.name;
      _this.vehicle_brand = purchase.brands.name;
      _this.reg_no = purchase.reg_no;

      _this.purchase_price = purchase.purchase_price;
      _this.total_expense = purchase.total_expenses;

      _this.total_price =
        parseFloat(_this.purchase_price) + parseFloat(_this.total_expense);

      _this.vehicleData.vehicle_id = purchase.id;
    });
  },
};
</script>
<style scoped>
.show-grid [class^="col-"] {
  padding-top: 10px;
  padding-bottom: 10px;
  border: 1px solid #ddd;
  border: 1px solid rgba(86, 61, 124, 0.2);
  list-style: none;
}

.glyphicon {
  margin-top: 5px;
  margin-bottom: 10px;
  font-size: 35px;
}
</style>
