<template>
  <div class="mb-3">
    <div class="mt-3">
      <h6 class="font-weight-bold float-left">
        <span class="text-muted">Vehicle : </span>{{ brand_name }}
        {{ model_name }}
      </h6>
      <h6 class="font-weight-bold float-right">
        <span class="text-muted">Reg Number : </span>{{ reg_no }}
      </h6>
    </div>
    <div class="p-3"></div>
    <div class="row mt-4">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Customer Name</label
          >
          <input
            type="text"
            class="form-control disable-text"
            placeholder="Enter customer Name"
            v-model="customer_name"
            readonly
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted"
            >Customer Phone Number</label
          >
          <input
            type="number"
            class="form-control disable-text"
            placeholder="Enter Phone Number"
            v-model="customer_mobile"
            readonly
          />
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Email ID</label>
          <input
            type="email"
            class="form-control disable-text"
            placeholder="Enter Email Id"
            v-model="customer_email"
            readonly
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
            v-model="sale.customer_address"
            readonly
          >
          </textarea>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="" class="font-weight-bold text-muted">Sale Price</label>
          <input
            type="number"
            class="form-control"
            placeholder="sale price"
            v-model="sale.sale_price"
          />
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col">
        <h6 class="ml-2">Address Proof</h6>
        <div class="card img_card mx-2">
          <div class="card-body text-center">
            <input
              type="file"
              class="form-control-file hideInputFile"
              id="exampleFormControlFile1"
              ref="address_proof"
              @change="addressImage($event)"
            />
            <!-- <div class="btn-group" role="group">
              <button
                type="button"
                class="btn btn-secondary btn-sm btn-default ml-1"
                @click="addAddressProof()"
              >
                <i class="fas fa-cloud-upload-alt"></i> Upload
              </button>
            </div> -->
          </div>
          <div class="text-center pb-1">
            <small class="text-danger" v-if="address_proof_err != ''">
              {{ address_proof_err }}</small
            >
          </div>
        </div>
      </div>

      <div class="col">
        <h6 class="ml-2">Sale Letter</h6>
        <div class="card img_card mx-2">
          <!-- <img
            :src="sale_letter_url"
            class="card-img-top mt-3"
            alt="default image not found"
          /> -->
          <div class="card-body text-center">
            <input
              type="file"
              class="form-control-file hideInputFile"
              id="exampleFormControlFile1"
              ref="sale_letter"
              @change="saleLetter($event)"
            />
            <!-- <div class="btn-group" role="group">
              <button
                class="btn btn-primary"
                @click="chooseSaleLetter()"
                type="button"
              >
                {{ "choose" }}
              </button>
              <button
                type="button"
                class="btn btn-secondary btn-sm btn-default ml-1"
                @click="addSale()"
              >
                <i class="fas fa-cloud-upload-alt"></i> Upload
              </button>
            </div> -->
          </div>
          <div class="text-center pb-1">
            <small class="text-danger" v-if="sale_letter_err != ''">
              {{ sale_letter_err }}</small
            >
          </div>
        </div>
      </div>
    </div>

    <div class="div py-4">
      <button
        class="btn btn-primary btn-round float-right mr-2"
        @click="addSale()"
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
      title: "Add Expense",

      brand_name: "",
      model_name: "",
      reg_no: "",

      customer_name: "",
      customer_mobile: "",
      customer_email: "",

      address_proof_err: "",
      url: "../assets/img/nofilechoosen.png",
      sale_letter_url: "../assets/img/nofilechoosen.png",
      choose_image_title: "Choose Address Proof",
      sale_letter_err: "",
      //   addSale: {},
      sale: {
        customer_address: "",
        vehicle_id: "",
        enq_id: "",
        sale_price: "",

        address_proof: "",
        sale_letter: "",
      },

      errors: {},
    };
  },

  methods: {
    chooseImage() {
      this.$refs.address_proof.click();
      this.address_proof_err = "";
    },

    chooseSaleLetter() {
      this.$refs.sale_letter.click();
      this.sale_letter_err = "";
    },

    addressImage(e) {
      var _this = this;
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        _this.address_proof_err = "Size must not exceed 200 kb.";
        return false;
      }

      reader.onload = function (ev) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = ev.target.result;

        //Validate the File Height and Width.
        image.onload = function () {
          //   var height = this.height;
          //   var width = this.width;
          //   if (height < 320 || height > 350 &&  width < 520 || width > 550 ) {
          //     _this.brand_logo_err = "Image has invalid image dimension";

          //     return false;
          //   } else {
          _this.sale.address_proof = e.target.files[0];
          _this.url = URL.createObjectURL(e.target.files[0]);
          // _this.selected_logo=URL.createObjectURL(e.target.files[0]);
          //   }
        };
      };
    },

    saleLetter(e) {
      var _this = this;
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 300000) {
        _this.sale_letter_err = "Size must not exceed 300 kb.";
        return false;
      }

      reader.onload = function (ev) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = ev.target.result;

        //Validate the File Height and Width.
        image.onload = function () {
          //   var height = this.height;
          //   var width = this.width;
          //   if (height < 320 || height > 350 &&  width < 520 || width > 550 ) {
          //     _this.brand_logo_err = "Image has invalid image dimension";

          //     return false;
          //   } else {
          _this.sale.sale_letter = e.target.files[0];
          _this.sale_letter_url = URL.createObjectURL(e.target.files[0]);
          // _this.selected_logo=URL.createObjectURL(e.target.files[0]);
          //   }
        };
      };
    },

    addSale() {
      if (this.sale.address_proof == "") {
        this.address_proof_err = "This field required";
        return false;
      }
      if (this.sale.sale_letter == "") {
        this.sale_letter_err = "This field required";
        return false;
      }

      let upload = new FormData();

      upload.append("enq_id", this.sale.enq_id);
      upload.append("vehicle_id", this.sale.vehicle_id);
      upload.append("customer_address", this.sale.customer_address);
      upload.append("sale_price", this.sale.sale_price);

      upload.append("address_proof", this.sale.address_proof);
      upload.append("sale_letter", this.sale.sale_letter);
      upload.append("customer_name", this.customer_name);

      axios
        .post("add-sale", upload)
        .then((res) => {
          console.log("success");

          if (res.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Sale Added successfully",
            });
this.clearFormData();
 bus.$emit("sale-added");
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;

          console.log("errors");
this.clearFormData();
        });
    },

    clearFormData() {
      for (let data in this.sale) {
        this.sale[data] = "";
      }

      this.address_proof_err = "";
      this.sale_letter_err = "";

      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },
  },

  created() {
    var _this = this;

    bus.$on("mark-sale", function (booking) {
      _this.brand_name = booking.vehicle.brands.name;
      _this.model_name = booking.vehicle.models.name;
      _this.reg_no = booking.vehicle.reg_no;

      _this.customer_name = booking.customer.name;
      _this.customer_mobile = booking.customer.mobile;
      _this.customer_email = booking.customer.email;

      _this.sale.customer_address = booking.vehicle.address;
      _this.sale.sale_price = booking.sale_price;

      _this.sale.enq_id = booking.enq_id;
      _this.sale.vehicle_id = booking.vehicle_id;
    });
  },
};
</script>

<style scoped>
.disable-text {
  color: black;
  font-weight: bold;
}

.card-img-top {
  height: 120px;
  width: 180px;
  max-height: 120px;
  max-width: 180px;

  margin-left: auto;
  margin-right: auto;
}
</style>
