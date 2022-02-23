<template>
  <div class="">
    <div class="card mt-3">
      <div class="card-header">
        <div class="d-flex align-items-center">
          <button
            class="btn btn-default btn-xs btn-round py-1"
            @click="goBack()"
          >
            <i class="fas fa-backward fa-fw"></i> Go Back
          </button>
          <h4 class="card-title ml-auto">Conversion Status</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="" class="font-weight-bold text-muted"
                >Select Conversion Status</label
              >
              <select
                class="form-control"
                required=""
                v-model="convertion.convertion_status"
              >
                <option value="">select convertion status</option>
                <option value="1">Booked</option>
                <option value="2">Dropped</option>
              </select>
            </div>
          </div>
        </div>
        <!--1st row end-->
        <div v-if="convertion.convertion_status == 1">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="" class="font-weight-bold text-muted"
                  >Enquired Vehicle</label
                >
                <div>
                  <multiselect
                    v-model="selected_vehicle"
                    :options="readyVehicles"
                    :options-limit="4"
                    label="reg_no"
                    placeholder="Search Vehicle Here"
                  >
                  </multiselect>
                </div>
              </div>
            </div>
          </div>

          <div class="row" v-if="selectedBrand != '' && selectedModel != ''">
            <div class="col">
              <div class="form-group">
                <label for="" class="font-weight-bold text-muted"
                  >Vehicle Brand</label
                >
                <div>
                  <input
                    type="text"
                    name=""
                    id=""
                    class="form-control disable-text"
                    v-model="selectedBrand"
                    readonly
                  />
                </div>
              </div>
            </div>

            <div class="col">
              <div class="form-group">
                <label for="" class="font-weight-bold text-muted"
                  >Vehicle Model</label
                >
                <div>
                  <input
                    type="text"
                    name=""
                    id=""
                    class="form-control disable-text"
                    v-model="selectedModel"
                    readonly
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label for="" class="font-weight-bold text-muted"
                >Booked Brand</label
              >
              <select class="form-control" required="">
                <option value="">select booked brand</option>
                <option>Mahinddra</option>
                <option>Maruthi</option>
              </select>
            </div>
          </div>

          <div class="col-lg-6 col-md-6">
            <div class="form-group">
              <label for="" class="font-weight-bold text-muted"
                >Booked Model</label
              >
              <select class="form-control" required="">
                <option value="">select booked model</option>
                <option>Thar</option>
                <option>Xuv 500</option>
              </select>
            </div>
          </div>
        </div> -->
          <!--1st row end-->
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="font-weight-bold text-muted"
                  >Total Vehicle Price
                </label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Total Vehicle Price"
                  v-model="convertion.total_vehicle_price"
                />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="font-weight-bold text-muted"
                  >Booking Amount</label
                >
                <input
                  type="text"
                  class="form-control"
                  placeholder="Booking Amount"
                  v-model="convertion.booking_amount"
                />
              </div>
            </div>
          </div>
          <!--2nd row end-->
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="comment" class="font-weight-bold text-muted"
                >Remarks</label
              >
              <textarea
                class="form-control"
                rows="3"
                v-model="convertion.remarks"
              >
              </textarea>
            </div>
          </div>
        </div>

        <div class="div py-4">
          <button
            class="btn btn-primary btn-round float-right mr-2"
            @click="addConvertion()"
          >
            Save Changes
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //   enq_id: "",
      reg_no: "",
      readyVehicles: [],
      selected_vehicle: [],

      selectedModel: "",
      selectedBrand: "",

      convertion: {
        convertion_status: "",

        enq_id: "",
        customer_name: "",
        vehicle_id: "",
        selected_reg_no: "",
        total_vehicle_price: "",
        booking_amount: "",
        remarks: "",
      },

      errors: {},
    };
  },
  created() {
    var _this = this;
    bus.$on("add-convertion", (enquiry) => {
      _this.convertion.enq_id = enquiry.id;
      _this.convertion.customer_name = enquiry.name;

      _this.convertion.selected_reg_no = enquiry.enq_vehicle_reg_no;

      _this.getVehicles();
    });
  },

  methods: {
    goBack() {
      bus.$emit("back-to-table");
      this.clearFormData();
    },

    getVehicles() {
      axios
        .get("get-vehicle-for-booking")
        .then((response) => {
          this.readyVehicles = response.data;
          this.selected_vehicle = this.readyVehicles.find(
            (option) => option.reg_no === this.convertion.selected_reg_no
          );
        })
        .catch((err) => {
          console.log(err);
        });
    },

    addConvertion() {
      axios
        .post("add-convertion", this.convertion)
        .then((res) => {
          if (res.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Convertion Status Added successfully ",
            });

            this.clearFormData();
            this.goBack();
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      this.reg_no = "";
      this.selected_vehicle = null;
      this.selectedModel = "";
      this.selectedBrand = "";

      this.convertion.convertion_status = "";

      this.convertion.enq_id = "";
      this.convertion.customer_name = "";
      this.convertion.vehicle_id = "";
      this.convertion.selected_reg_no = "";
      this.convertion.total_vehicle_price = "";
      this.convertion.booking_amount = "";
      this.convertion.remarks = "";
    },
  },

  watch: {
    selected_vehicle: function () {
      if (this.selected_vehicle != null) {
        this.convertion.vehicle_id = this.selected_vehicle.id;
        this.convertion.selected_reg_no = this.selected_vehicle.reg_no;

        this.convertion.total_vehicle_price =
          this.selected_vehicle.selling_price;

        this.selectedBrand = this.selected_vehicle.brands.name;
        this.selectedModel = this.selected_vehicle.models.name;
      } else {
        this.convertion.selected_reg_no = "";
        this.selectedBrand = "";
        this.selectedModel = "";


      }
    },
  },

  mounted() {},
};
</script>

<style scoped>
.disable-text {
  color: black;
  font-weight: bold;
}
</style>
