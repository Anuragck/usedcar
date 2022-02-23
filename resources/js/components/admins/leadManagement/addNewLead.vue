<template>
  <div class="mb-3">
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Name</label>
          <input
            v-model="enquiries.name"
            type="text"
            class="form-control"
            placeholder="Enter Name"
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Email ID</label>
          <input
            v-model="enquiries.email"
            type="email"
            class="form-control"
            placeholder="Enter Email ID"
          />
        </div>
      </div>
    </div>

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

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Mobile Number</label
          >
          <input
            v-model="enquiries.mobile"
            type="number"
            class="form-control"
            placeholder="Enter Mobile Number"
          />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Source Of Lead</label
          >
          <select
            class="form-control"
            required=""
            v-model="enquiries.source_of_lead"
          >
            <option value="">Source Of Lead</option>
            <option value="Direct Call">Direct Call</option>
            <option value="Reference">Reference</option>
            <option value="Social Media">Social Media</option>
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="comment" class="font-weight-bold text-muted"
            >Referee Details</label
          >
          <textarea
            class="form-control"
            rows="2"
            v-model="enquiries.referee_details"
          >
          </textarea>
        </div>
      </div>
    </div>

    <div class="div py-4">
      <button
        class="btn btn-primary btn-round float-right mr-2"
        @click="addNewLead()"
      >
        {{ button_title
        }}<i class="fas fa-spinner fa-spin fa-fw" v-if="loading == true"></i>
      </button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      readyVehicles: [],
      //   title: "Ready To Sell",

      loading: false,

      selectedModel: "",
      selectedBrand: "",
      selected_vehicle: [],
      enquiries: {
        selected_reg_no: "",
        selectedBrand: "",
        selectedModel: "",

        name: "",
        email: "",
        mobile: "",
        source_of_lead: "",
        referee_details: "",
      },

      errors: {},
    };
  },

  methods: {
    addNewLead() {
      this.loading = true;
      axios
        .post("add-new-lead", this.enquiries)
        .then((res) => {
          if (res.data == "success") {
            Toast.fire({
              icon: "success",
              title: " New Lead Added successfully ",
            });
            this.clearFormData();
            bus.$emit("after-success");
          }
          this.loading = false;
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
          this.loading = false;
        });
    },

    getVehicles() {
      axios
        .get("get-vehicle-for-booking")
        .then((response) => {
          this.readyVehicles = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    clearFormData() {
      this.enquiries.selectedBrand = "";
      this.enquiries.selectedModel = "";

      this.enquiries.name = "";
      this.enquiries.email = "";
      this.enquiries.mobile = "";
      this.enquiries.source_of_lead = "";
      this.enquiries.referee_details = "";

      this.enquiries.selected_reg_no = "";

      this.selectedBrand = "";
      this.selectedModel = "";

      this.selected_vehicle = "";
    },
  },

  created() {
    this.getVehicles();
    var _this = this;
    bus.$on("show-enquiry-list", () => {
      _this.clearFormData();
    });
  },

  computed: {
    button_title() {
      if (this.loading == true) {
        return "Saving  ";
      } else {
        return "Save Changes";
      }
    },
  },

  watch: {
    selected_vehicle: function () {
      if (this.selected_vehicle.length != 0) {
        this.enquiries.selected_reg_no = this.selected_vehicle.reg_no;
        this.selectedBrand = this.selected_vehicle.brands.name;
        this.selectedModel = this.selected_vehicle.models.name;

        this.enquiries.selectedBrand = this.selected_vehicle.brands.id;

        this.enquiries.selectedModel = this.selected_vehicle.models.id;
      } else {
        this.enquiries.selected_reg_no = "";
        this.enquiries.selectedBrand = "";
        this.enquiries.selectedModel = "";

        this.selectedBrand = "";
        this.selectedModel = "";

      }
    },
  },
};
</script>
<style scoped>
.disable-text {
  color: black;
  font-weight: bold;
}
</style>
