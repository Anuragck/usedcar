<template>
  <div class="mb-3">
    <h6 class="font-weight-bold"><em>Vehicle Details</em></h6>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Select Brand Name</label
          >
          <model-list-select
            :list="this.brands"
            name="brand"
            v-model="selectedBrand"
            option-value="id"
            :custom-text="brand"
            placeholder="select item"
 :isDisabled="report_view"


          >
          </model-list-select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Select Model Name</label
          >
          <model-list-select
            :list="this.modelList"
            name="model"
            v-model="selectedModel"
            option-value="id"
            :custom-text="model"
            placeholder="select item"
            :isDisabled="enableModel || report_view"
          >
          </model-list-select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Color</label>
          <input
            type="text"
            class="form-control"
            placeholder="Enter Color"
            v-model="purchaseData.color"
            :disabled="report_view"
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Year of Regestration</label
          >
          <input
            type="number"
            class="form-control"
            max="4"
            name="year_of_reg"
            placeholder="Enter year of registration"
            v-model="purchaseData.year_of_reg"
 :disabled="report_view"
          />
        </div>
      </div>
    </div>
    <!--1st row end-->
    <div class="row">
      <div class="col">

        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Reg Number</label>
          <input
            type="text"
            class="form-control"
            placeholder="Enter Reg Number"
            v-model="register_number"
           style="text-transform:uppercase"
 :disabled="report_view"
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Select Fuel Type</label
          >
          <select
            class="form-control"
            required=""
            v-model="purchaseData.fuel_type"
 :disabled="report_view"
          >
            <option value="">select fuel type</option>
            <option value="PETROL">Petrol</option>
            <option value="DIESEL">Diesel</option>
            <option value="ELECTRIC">Electric</option>
            <option value="CNG">CNG</option>
            <option value="OTHERS">Others</option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Enter Kms Driven</label
          >
          <input
            type="number"
            class="form-control"
            placeholder="Enter Kms Driven"
            v-model="purchaseData.kms_driven"
 :disabled="report_view"
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Number Of Owners</label
          >
          <select
            class="form-control"
            required=""
            v-model="purchaseData.no_of_owners"
 :disabled="report_view"
          >
            <option value="">select no.of owners</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
          </select>
        </div>
      </div>
    </div>
    <!--1st row end-->
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Engine Displacement (cc)
          </label>
          <input
            type="number"
            class="form-control"
            placeholder="Enter engine displacement"
            v-model="purchaseData.cc"
 :disabled="report_view"
          />
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">RTO</label>
          <input
            type="text"
            class="form-control"
            placeholder="Enter RTO"
            v-model="purchaseData.rto"
 :disabled="report_view"
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Select Transmission Type</label
          >
          <select
            class="form-control"
            required=""
            v-model="purchaseData.transmission_type"
 :disabled="report_view"
          >
            <option value="">select trasnsmission type</option>
            <option>Automatic</option>
            <option>Manual</option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Gear Box</label>
          <select
            class="form-control"
            required=""
            v-model="purchaseData.gear_box"
 :disabled="report_view"
          >
            <option value="">select gear box</option>
            <option>2 speed</option>
            <option>3 speed</option>
            <option>4 speed</option>
            <option>5 speed</option>
            <option>6 speed</option>
            <option>7 speed</option>
            <option>8 speed</option>
          </select>
        </div>
      </div>
    </div>
    <!--2nd row end-->

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Milage (for 1 km )</label
          >
          <input
            type="text"
            class="form-control"
            placeholder="Enter Milage"
            v-model="purchaseData.milage"
 :disabled="report_view"
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">No.Of Seats</label>
          <input
            type="number"
            placeholder="Enter No.Of Seats"
            class="form-control"
            v-model="purchaseData.no_of_seats"
 :disabled="report_view"
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Drive Type</label>
          <select
            class="form-control"
            required=""
            v-model="purchaseData.drive_type"
 :disabled="report_view"
          >
            <option value="">select drive type</option>
            <option value="FWD">FWD</option>
            <option value="RWD">RWD</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Front Brake</label>
          <select
            class="form-control"
            required=""
            v-model="purchaseData.front_brake"
 :disabled="report_view"
          >
            <option value="">select front brake</option>
            <option value="DISC">Disc</option>
            <option value="DRUM">Drum</option>
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-3">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Back Brake</label>
          <select
            class="form-control"
            required=""
            v-model="purchaseData.back_brake"
 :disabled="report_view"
          >
            <option value="">select back brake</option>
            <option value="DISC">Disc</option>
            <option value="DRUM">Drum</option>
          </select>
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Body Type</label>
          <select
            class="form-control"
            required=""
            v-model="purchaseData.body_type"
 :disabled="report_view"
          >
            <option value="">select body type</option>
            <option value="SEDAN">Sedan</option>
            <option value="XUV">XUV</option>
            <option value="HATCHBACK">Hatchback</option>
          </select>
        </div>
      </div>

      <div class="col-6">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Purchased Price</label
          >
          <input
            type="number"
            class="form-control"
            placeholder="purchased price"
            v-model="purchaseData.purchased_price"
 :disabled="report_view"
          />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Power Steering</label
          ><br />
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline1"
              name="a"
              value="Yes"
              class="custom-control-input"
              v-model="purchaseData.power_steering"
 :disabled="report_view"
            />
            <label class="custom-control-label" for="customRadioInline1"
              >Yes</label
            >
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline2"
              name="a"
              value="No"
              class="custom-control-input"
              v-model="purchaseData.power_steering"
 :disabled="report_view"
            />
            <label class="custom-control-label" for="customRadioInline2"
              >No</label
            >
          </div>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Anti Lock Breaking System</label
          >
          <br />
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline3"
              name="b"
              value="Yes"
              v-model="purchaseData.abs"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline3"
              >Yes</label
            >
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline4"
              name="b"
              value="No"
              v-model="purchaseData.abs"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline4"
              >No</label
            >
          </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Driver Air Bag</label
          >
          <br />
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline5"
              name="c"
              value="Yes"
              v-model="purchaseData.driver_air_bag"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline5"
              >Yes</label
            >
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline6"
              name="c"
              value="No"
              v-model="purchaseData.driver_air_bag"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline6"
              >No</label
            >
          </div>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Passenger Air Bag</label
          >
          <br />
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline7"
              name="d"
              value="Yes"
 :disabled="report_view"
              v-model="purchaseData.passenger_air_bag"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline7"
              >Yes</label
            >
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline8"
              name="d"
              value="No"
              v-model="purchaseData.passenger_air_bag"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline8"
              >No</label
            >
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-3">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Automatic Climate Control
          </label>
          <br />
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline9"
              name="e"
              value="Yes"
              v-model="purchaseData.auto_climate"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline9"
              >Yes</label
            >
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline10"
              name="e"
              class="custom-control-input"
              value="No"
              v-model="purchaseData.auto_climate"
 :disabled="report_view"
            />
            <label class="custom-control-label" for="customRadioInline10"
              >No</label
            >
          </div>
        </div>
      </div>

      <div class="col-3">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Alloy Wheel</label>
          <br />
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline11"
              name="f"
              class="custom-control-input"
              value="Yes"
              v-model="purchaseData.alloy_wheel"
 :disabled="report_view"
            />
            <label class="custom-control-label" for="customRadioInline11"
              >Yes</label
            >
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline12"
              name="f"
              value="No"
              v-model="purchaseData.alloy_wheel"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline12"
              >No</label
            >
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Air Coditioner</label
          >
          <br />
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline13"
              name="g"
              value="Yes"
              v-model="purchaseData.ac"
 :disabled="report_view"
              class="custom-control-input"
            />
            <label class="custom-control-label" for="customRadioInline13"
              >Yes</label
            >
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input
              type="radio"
              id="customRadioInline14"
              name="g"
              class="custom-control-input"
              value="No"
              v-model="purchaseData.ac"
 :disabled="report_view"
            />
            <label class="custom-control-label" for="customRadioInline14"
              >No</label
            >
          </div>
        </div>
      </div>
    </div>
    <hr class="style13 pt-3 pb-3" />
    <div class="">
      <h6 class="font-weight-bold"><em>Add Seller Details</em></h6>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Enter Full Name
            </label>
            <input
              type="text"
              class="form-control"
              placeholder="Enter Full Name"
              v-model="purchaseData.seller_name"
 :disabled="report_view"
            />
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Enter Phone Number</label
            >
            <input
              type="number"
              class="form-control"
              placeholder="Enter Phone Number"
              v-model="purchaseData.seller_ph"
 :disabled="report_view"
            />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="" class="font-weight-bold text-muted"
              >Enter Email ID</label
            >
            <input
              type="email"
              class="form-control"
              placeholder="Enter email id"
              v-model="purchaseData.seller_email"
 :disabled="report_view"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="comment" class="font-weight-bold text-muted"
              >Address</label
            >
            <textarea
              class="form-control"
              rows="2"
              v-model="purchaseData.seller_address"
            :disabled="report_view"

            >
            </textarea>
          </div>
        </div>
      </div>
    </div>

    <hr class="style13 pt-3 pb-3" />

    <div class="div py-4">
      <button
        class="btn btn-primary btn-round float-right mr-2"
        @click="submitPurchase()"
v-if="report_view == false"
      >
        Save Changes
      </button>
    </div>
  </div>
</template>

<script>
import { ModelListSelect } from "vue-search-select";
export default {
  components: {
    ModelListSelect,
  },
  props: ["edit",'report_only'],
  data() {
    return {
success_title:'Purchase Added Successfully',
      selectedBrand: "",
      selectedModel: "",
      brands: [],
      modelList: [],
register_number:"",
      enableModel: true,

report_view:false,

      purchaseData: {
        id: "",
        brand_id: "",
        model_id: "",
        color: "",
        year_of_reg: "",
        reg_no: "",
        fuel_type: "",
        kms_driven: "",
        no_of_owners: "",
        cc: "",
        rto: "",
        transmission_type: "",
        gear_box: "",
        milage: "",
        no_of_seats: "",
        drive_type: "",
        front_brake: "",
        back_brake: "",
        body_type: "",

        purchased_price: "",

        power_steering: "",
        abs: "",
        driver_air_bag: "",
        passenger_air_bag: "",
        auto_climate: "",
        alloy_wheel: "",
        ac: "",

        seller_name: "",
        seller_ph: "",
        seller_email: "",
        seller_address: "",
      },

      errors: {},
    };
  },
  created() {
    this.getBrands();
    var _this = this;
    if (_this.edit) {
      bus.$on("edit-purchase", function (purchase) {
        _this.purchaseData.id = purchase.id;

        _this.selectedBrand = purchase.brand_id;
        _this.selectedModel = purchase.model_id;

        _this.purchaseData.color = purchase.color;
        _this.purchaseData.year_of_reg = purchase.year_of_reg;

        _this.register_number = purchase.reg_no;

        _this.purchaseData.fuel_type = purchase.fuel;
        _this.purchaseData.kms_driven = purchase.kms_driven;
        _this.purchaseData.no_of_owners = purchase.no_of_owners;
        _this.purchaseData.cc = purchase.cc;
        _this.purchaseData.rto = purchase.rto;
        _this.purchaseData.transmission_type = purchase.transmission_type;
        _this.purchaseData.gear_box = purchase.gear_box;
        _this.purchaseData.milage = purchase.milage_per_km;
        _this.purchaseData.no_of_seats = purchase.no_of_seats;
        _this.purchaseData.drive_type = purchase.drive_type;
        _this.purchaseData.front_brake = purchase.front_brake;
        _this.purchaseData.back_brake = purchase.back_brake;
        _this.purchaseData.body_type = purchase.body_type;
        _this.purchaseData.purchased_price = purchase.purchase_price;

        if (purchase.power_steering == 1) {
          _this.purchaseData.power_steering = "Yes";
        }
        if (purchase.power_steering == 2) {
          _this.purchaseData.power_steering = "No";
        }

        if (purchase.abs == 1) {
          _this.purchaseData.abs = "Yes";
        }
        if (purchase.abs == 2) {
          _this.purchaseData.abs = "No";
        }

        if (purchase.driver_air_bag == 1) {
          _this.purchaseData.driver_air_bag = "Yes";
        }
        if (purchase.driver_air_bag == 2) {
          _this.purchaseData.driver_air_bag = "No";
        }

        if (purchase.passenger_air_bag == 1) {
          _this.purchaseData.passenger_air_bag = "Yes";
        }
        if (purchase.passenger_air_bag == 2) {
          _this.purchaseData.passenger_air_bag = "No";
        }

        if (purchase.auto_climate_control == 1) {
          _this.purchaseData.auto_climate = "Yes";
        }
        if (purchase.auto_climate_control == 2) {
          _this.purchaseData.auto_climate = "No";
        }

        if (purchase.alloy_wheel == 1) {
          _this.purchaseData.alloy_wheel = "Yes";
        }
        if (purchase.alloy_wheel == 2) {
          _this.purchaseData.alloy_wheel = "No";
        }

        if (purchase.ac == 1) {
          _this.purchaseData.ac = "Yes";
        }
        if (purchase.ac == 2) {
          _this.purchaseData.ac = "No";
        }

        _this.purchaseData.seller_name = purchase.seller_name;
        _this.purchaseData.seller_ph = purchase.phone;
        _this.purchaseData.seller_email = purchase.email;
        _this.purchaseData.seller_address = purchase.address;

_this.success_title="Purchase Updated Successfully";
      });
    }



    bus.$on("clear-form", function () {
      _this.clearFormData();
    });

    // $(document).ready(function () {
    //   $("#datepicker").datepicker({
    //     format: "yyyy",
    //     viewMode: "years",
    //     minViewMode: "years",
    //     autoclose: true,
    //   });
    // });

  if (this.report_only) {
            var _this = this;
            _this.report_view = true;

        }

  },

  methods: {

    getBrands() {
      axios
        .get("get-brands")
        .then((response) => {
          this.brands = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getModelByBrand() {
      axios
        .get("get-model-by-brand", {
          params: {
            brand: this.selectedBrand,
          },
        })
        .then((response) => {
          this.modelList = response.data;
        })
        .catch((err) => {
          //   console.log("errs".err);
        });
    },

    submitPurchase() {
      axios
        .post("add-purchase", this.purchaseData)
        .then((response) => {
          if (response.data == "success") {
            Swal.fire({
              title: 'Purchase Added Successfully',
              icon: "success",
              button: "Ok",
            });
            this.clearFormData();
            bus.$emit("purchase-added");
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    brand(item) {
      return `${item.name}`;
    },
    model(item) {
      return `${item.name}`;
    },

    clearFormData() {
      for (let data in this.purchaseData) {
        this.purchaseData[data] = "";
      }

      this.selectedBrand = "";
      this.selectedModel = "";

      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },
  },

  watch: {


register_number: function () {
      if (this.register_number != "") {
        this.purchaseData.reg_no = this.register_number.replace(/\s/g,'').toUpperCase();
      }
    },
    selectedBrand: function () {
      if (this.selectedBrand != "") {
        this.getModelByBrand();
        this.enableModel = false;
        this.purchaseData.brand_id = this.selectedBrand;
      }
    },
    selectedModel: function () {
      if (this.selectedModel != "") {
        this.purchaseData.model_id = this.selectedModel;
      }
    },
  },

  mounted() {},
};
</script>

<style scoped>
hr.style13 {
  height: 10px;
  border: 0;
  box-shadow: 0 10px 10px -10px #8c8b8b inset;
}
</style>
