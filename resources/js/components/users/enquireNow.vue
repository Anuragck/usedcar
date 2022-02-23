<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_enquiry_modal"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <label for="">Name</label>
        <input
          type="text"
          name=""
          id=""
          placeholder="Enter Your Name"
          class="form-control"
          v-model="enquiry.name"
          required
        />
      </div>

      <div class="form-group">
        <label for="">Mobile</label>
        <input
          type="number"
          name=""
          id=""
          placeholder="Enter Your Mobile Number"
          class="form-control"
          v-model="enquiry.mobile"
          required
        />
      </div>

      <div class="form-group">
        <label for="">Email</label>
        <input
          type="email"
          name=""
          id=""
          placeholder="Enter Your Email Id"
          class="form-control"
          v-model="enquiry.email"
        />
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">
        Close
      </button>
      <button
        type="button"
        class="btn btn-primary"
        @click.prevent="addEnquiry()"
      >
        Send Enquiry
      </button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["reg_no", "brand_id", "model_id"],
  data() {
    return {
      title: "Enquire Now",

      enquiry: {
        selected_reg_no: "",
        selectedBrand: "",
        selectedModel: "",
        name: "",
        mobile: "",
        email: "",
        source_of_lead: "Website",
      },

      errors: {},
    };
  },

  methods: {
    addEnquiry() {
      axios
        .post("add-enquiry", this.enquiry)
        .then((res) => {
          if (res.data == "success") {
            Swal.fire({
              title: "Thank You",
              text: "Will get back to you soon!",
              icon: "success",
              button: "Ok",
            });
            this.$refs.close_enquiry_modal.click();
            this.clearFormData();
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
      this.enquiry.selected_reg_no = "";
      this.enquiry.selectedBrand = "";
      this.enquiry.selectedModel = "";
      this.enquiry.name = "";
      this.enquiry.mobile = "";
      this.enquiry.email = "";
      this.errors = {};
    },
  },

  created() {
    var _this = this;

    _this.enquiry.selected_reg_no = _this.reg_no;
    _this.enquiry.selectedBrand = _this.brand_id;
    _this.enquiry.selectedModel = _this.model_id;
  },
};
</script>
<style scoped>
</style>
