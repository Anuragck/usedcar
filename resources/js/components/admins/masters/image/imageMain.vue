<template>
  <div>
    <div class="main mt-3">
      <div class="col-lg-12">
        <div class="card mb-4 p-3">
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
            <h5 class="m-0 font-weight-bold text-dark">Images/Documents</h5>
          </div>

          <div class="text-center mr-5 mt-4">
            <label for="" class="">Select Item</label>
          </div>

          <div class="input-group mb-3 justify-content-center mt-4">
            <div class="w-50" style="">
              <div class="input-group justify-content-center">
                <!-- search vendor -->

                <multiselect
                  v-model="select_item"
                  placeholder="Search for vehicle id"
                  label="reg_no"
                  :options="vehicleList"
                  track-by="id"
                  :options-limit="4"
                ></multiselect>

                <!-- search vendor end  -->
              </div>
            </div>
            <div class="input-group-append ml-4">
              <button
                class="btn btn-sm btn-primary rounded-pill px-3"
                @click="getVehicleForImage()"
              >
                Search <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="card mb-4 p-3" v-if="vehicleData.length != 0">
          <div class="row">
            <div class="col pb-4">
              <button
                type="button"
                class="btn rounded-pill btn-primary float-right"
                data-toggle="modal"
                data-target="#addNewVehicleImage"
                :disabled="test"
                @click="addNewImage()"

              >
                {{ image_btn_title }} <i class="fas fa-plus-circle fa-fw"></i>

              </button>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <h6 class="">{{ "Vehicle ID :" }} {{ vehicleData[0].id }}</h6>
            </div>
            <div class="col">
              <h6>
                {{ "Vehicle  :" }}
                {{
                  vehicleData[0].brands.name + " " + vehicleData[0].models.name
                }}
              </h6>
            </div>

            <div class="col">
              <h6>
                {{ "Reg Number  :" }}
                {{ vehicleData[0].reg_no }}
              </h6>
            </div>
          </div>
          <hr />
          <h6 class="font-weight-bold ml-3 mt-2 pb-2">
            <em>Vehicle Documents </em>
          </h6>
          <div class="row mt-2">
            <div class="col">
              <h6 class="text-center">Registration Certificate</h6>
              <div class="card img_card mx-2">
                <img
                  :src="rc_url"
                  class="card-img-top mt-3"
                  alt="default image not found"
                  v-if="vehicleData[0].reg_certificate == null"
                />
                <img
                  :src="
                    '/uploads/vehicleDocuments/rc/' +
                    vehicleData[0].reg_certificate
                  "
                  class="card-img-top mt-3"
                  alt="default image not found"
                  v-if="vehicleData[0].reg_certificate != null"
                />
                <div class="card-body text-center">
                  <input
                    type="file"
                    class="form-control-file hideInputFile"
                    id="exampleFormControlFile1"
                    ref="reg_cert_img"
                    accept="image/*"
                    @change="regCert($event)"
                  />
                  <button
                    class="btn btn-danger"
                    type="button"
                    v-if="
                      vehicleData[0].reg_certificate != null &&
                      vehicle_status == 0
                    "
                    @click="deleteRc()"
                  >
                    {{ "Remove" }}
                  </button>
                  <div
                    class="btn-group"
                    role="group"
                    v-if="vehicleData[0].reg_certificate == null"
                  >
                    <button
                      class="btn btn-primary"
                      @click="chooseRcImage()"
                      type="button"
                    >
                      {{ "choose" }}
                    </button>
                    <button
                      type="button"
                      class="btn btn-secondary btn-sm btn-default ml-1"
                      @click="submitRegCert()"
                    >
                      <i class="fas fa-cloud-upload-alt"></i> Upload
                    </button>
                  </div>
                </div>
                <div class="text-center pb-1">
                  <small class="text-danger" v-if="reg_cert_image_errors != ''">
                    {{ reg_cert_image_errors }}</small
                  >
                </div>
              </div>
            </div>

            <!--Insurance-->
            <div class="col">
              <h6 class="text-center">Insurance</h6>
              <div class="card img_card mx-2">
                <img
                  :src="insurance_url"
                  class="card-img-top mt-3"
                  alt="default image not found"
                  v-if="vehicleData[0].insurance == null"
                />
                <img
                  :src="
                    '/uploads/vehicleDocuments/insurance/' +
                    vehicleData[0].insurance
                  "
                  class="card-img-top mt-3"
                  alt="default image not found"
                  v-if="vehicleData[0].insurance != null"
                />
                <div class="card-body text-center">
                  <input
                    type="file"
                    class="form-control-file hideInputFile"
                    id="exampleFormControlFile1"
                    ref="insurance_img"
                    accept="image/*"
                    @change="insurance($event)"
                  />
                  <button
                    class="btn btn-danger"
                    type="button"
                    v-if="
                      vehicleData[0].insurance != null && vehicle_status == 0
                    "
                    @click="deleteInsurance()"
                  >
                    {{ "Remove" }}
                  </button>
                  <div
                    class="btn-group"
                    role="group"
                    v-if="vehicleData[0].insurance == null"
                  >
                    <button
                      class="btn btn-primary"
                      @click="chooseInsuranceImg()"
                      type="button"
                    >
                      {{ "choose" }}
                    </button>
                    <button
                      type="button"
                      class="btn btn-secondary btn-sm btn-default ml-1"
                      @click="submitInsuranceImg()"
                    >
                      <i class="fas fa-cloud-upload-alt"></i> Upload
                    </button>
                  </div>
                </div>
                <div class="text-center pb-1">
                  <small class="text-danger" v-if="insurance_file_err != ''">
                    {{ insurance_file_err }}</small
                  >
                </div>
              </div>
            </div>
            <!--Insurance end-->
            <!-- </div>

<div class="row"> -->

            <!--Seller Address proof-->
            <div class="col">
              <h6 class="text-center">Seller Address Proof</h6>

              <div class="card img_card mx-2">
                <img
                  :src="address_url"
                  class="card-img-top mt-3"
                  alt="default image not found"
                  v-if="vehicleData[0].address_proof == null"
                />
                <img
                  :src="
                    '/uploads/vehicleDocuments/seller_address/' +
                    vehicleData[0].address_proof
                  "
                  class="card-img-top mt-3"
                  alt="default image not found"
                  v-if="vehicleData[0].address_proof != null"
                />
                <div class="card-body text-center">
                  <input
                    type="file"
                    class="form-control-file hideInputFile"
                    id="exampleFormControlFile1"
                    ref="address_proof_img"
                    accept="image/*"
                    @change="addressProof($event)"
                  />
                  <button
                    class="btn btn-danger"
                    type="button"
                    v-if="
                      vehicleData[0].address_proof != null &&
                      vehicle_status == 0
                    "
                    @click="deleteAddressProof()"
                  >
                    {{ "Remove" }}
                  </button>
                  <div
                    class="btn-group"
                    role="group"
                    v-if="vehicleData[0].address_proof == null"
                  >
                    <button
                      class="btn btn-primary"
                      @click="chooseAddressImg()"
                      type="button"
                    >
                      {{ "choose" }}
                    </button>
                    <button
                      type="button"
                      class="btn btn-secondary btn-sm btn-default ml-1"
                      @click="submitAddressImg()"
                    >
                      <i class="fas fa-cloud-upload-alt"></i> Upload
                    </button>
                  </div>
                </div>
                <div class="text-center pb-1">
                  <small class="text-danger" v-if="address_proof_err != ''">
                    {{ address_proof_err }}</small
                  >
                </div>
              </div>
            </div>
            <!--Seller-Address end-->
          </div>

          <div class="div" v-if="images_collection.length != 0">
            <hr />
            <h6 class="font-weight-bold ml-3">
              <em>Vehicle Images ( OLD )</em>
            </h6>

            <div class="row">
              <!--vehicle images-->
              <div class="col" v-for="img in images_collection" :key="img.id">
                <!-- <h6 class="text-center">Seller Address Proof</h6> -->
                <div class="card img_card mx-1">
                  <img
                    :src="'/uploads/vehicleImages/' + img.image"
                    class="card-img-top mt-3"
                    alt="default image not found"
                  />
                  <div class="card-body text-center">
                    <button
                      class="btn btn-danger"
                      type="button"
                      @click="removeImage(img)"
                      v-if="vehicle_status == 0"
                    >
                      {{ "Remove" }}
                    </button>
                  </div>
                </div>
              </div>
              <!--vehicle images-->
            </div>
          </div>

          <div class="div" v-if="vehicle_status == 1">
            <hr />
            <h6 class="font-weight-bold ml-3">
              <em>Vehicle Images ( NEW )</em>
            </h6>

            <div class="row">
              <!--vehicle images-->
              <div class="col" v-for="new_img in new_images_collection" :key="new_img.id">
                <!-- <h6 class="text-center">Seller Address Proof</h6> -->
                <div class="card img_card mx-1">
                  <img
                    :src="'/uploads/vehicleImages/' + new_img.image"
                    class="card-img-top mt-3"
                    alt="default image not found"
                  />
                  <div class="card-body text-center">
                    <button
                      class="btn btn-danger"
                      type="button"
                      @click="removeImage(new_img)"
                      v-if="vehicle_status == 1"
                    >
                      {{ "Remove" }}
                    </button>
                  </div>
                </div>
              </div>
              <!--vehicle images-->
            </div>
          </div>
        </div>

        <!--------------add-image-Modal---------------->
        <!-- Modal -->
        <div
          class="modal fade"
          id="addNewVehicleImage"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <add-new-image></add-new-image>
            </div>
          </div>
        </div>

        <!--------------add-image-Modal---------------->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [""],
  data() {
    return {
      rc_url: "../assets/img/nofilechoosen.png",
      insurance_url: "../assets/img/nofilechoosen.png",
      address_url: "../assets/img/nofilechoosen.png",
      image_btn_title: "Add Image",
      vehicleList: [],

      select_item: [],

      vehicleData: [],
new_images_collection:[],
      images_collection: [],

      cert_file: "",
      insurance_file: "",
      address_proof_file: "",

      vehicle_status: "",

      vehicle_reg_no: "",
      vehicle_id: "",
      reg_cert_image_errors: "",
      insurance_file_err: "",
      address_proof_err: "",

      test: true,
    };
  },
  created() {
    this.getVehicles();

    var _this = this;
    bus.$on("image-added", function () {
      _this.getImages();
_this.getNewImages();
    });
  },

  methods: {
    getVehicles() {
      axios
        .get("get-purchases")
        .then((response) => {
          this.vehicleList = response.data;
        })
        .catch((err) => {});
    },

    getImages() {
      axios
        .get("get-images", {
          params: {
            vehicle_id: this.vehicle_id,
          },
        })
        .then((response) => {
          this.images_collection = response.data;
        })
        .catch((err) => {});
    },
 getNewImages() {
      axios
        .get("get-new-images", {
          params: {
            vehicle_id: this.vehicle_id,
          },
        })
        .then((response) => {
          this.new_images_collection = response.data;
        })
        .catch((err) => {});
    },

    getVehicleForImage() {
      if (this.select_item.length == 0) {
        Toast.fire({
          icon: "error",
          title: "please select item",
        });
        return false;
      }
      axios
        .get("get-vehicle-for-image", {
          params: {
            reg_no: this.select_item.reg_no,
          },
        })
        .then((response) => {
          this.vehicleData = response.data;
          this.vehicle_reg_no = response.data[0].reg_no;
          this.vehicle_id = response.data[0].id;
          this.vehicle_status = response.data[0].vehicle_status;
          this.getImages();
this.getNewImages();
          if (response.data[0].vehicle_status == 1) {
            this.image_btn_title = "Add New Vehicle Image";
          } else {
            this.image_btn_title = "Add Image";
          }
          if (
            this.vehicleData[0].reg_certificate != null &&
            this.vehicleData[0].address_proof != null &&
            this.vehicleData[0].insurance != null
          ) {
            this.test = false;
          } else {
            this.test = true;
          }
        })
        .catch((err) => {
          if (err) {
            Toast.fire({
              icon: "error",
              title: "Some Error Occurred,Please Try Again Later",
            });
          }
        });
    },
    //INSURANCE-IMG
    insurance(e) {
      var _this = this;
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        _this.insurance_file_err = "Size must not exceed 200 kb.";
        return false;
      }

      reader.onload = function (ev) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = ev.target.result;

        //Validate the File Height and Width.
        image.onload = function () {
          _this.insurance_file = e.target.files[0];
          _this.insurance_url = URL.createObjectURL(e.target.files[0]);
        };
      };
    },

    chooseInsuranceImg() {
      this.$refs.insurance_img.click();
      this.insurance_file_err = "";
    },

    submitInsuranceImg() {
      if (this.insurance_file == "") {
        this.insurance_file_err = "This field required";
        return false;
      }
      let uploadInsurance = new FormData();
      uploadInsurance.append("insurance_file", this.insurance_file);
      uploadInsurance.append("reg_no", this.vehicle_reg_no);
      uploadInsurance.append("vehicle_id", this.vehicle_id);

      axios
        .post("add-insurance", uploadInsurance)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Insurance Added Successfully",
            });
            this.getVehicleForImage();
            // this.cert_file="";
            // this.rc_url="";
          }
        })
        .catch((error) => {
          console.log("errors");
        });
    },

    deleteInsurance() {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("delete-insurance", {
              id: this.vehicle_id,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getVehicleForImage();
                this.insurance_url = "../assets/img/nofilechoosen.png";
                Toast.fire({
                  icon: "error",
                  title: "Record Deleted successfully",
                });
              }
            });
        }
      });
    },

    //ADDRESS-PROOF
    addressProof(e) {
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
          _this.address_proof_file = e.target.files[0];
          _this.address_url = URL.createObjectURL(e.target.files[0]);
        };
      };
    },

    chooseAddressImg() {
      this.$refs.address_proof_img.click();
      this.address_proof_err = "";
    },

    submitAddressImg() {
      if (this.address_proof_file == "") {
        this.address_proof_err = "This field required";
        return false;
      }
      let uploadAddress = new FormData();
      uploadAddress.append("address_proof_file", this.address_proof_file);
      uploadAddress.append("reg_no", this.vehicle_reg_no);
      uploadAddress.append("vehicle_id", this.vehicle_id);

      axios
        .post("add-address-proof", uploadAddress)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Address Proof Added Successfully",
            });
            this.getVehicleForImage();
            // this.cert_file="";
            // this.rc_url="";
          }
        })
        .catch((error) => {
          console.log("errors");
        });
    },

    deleteAddressProof() {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("delete-address-proof", {
              id: this.vehicle_id,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getVehicleForImage();
                this.address_url = "../assets/img/nofilechoosen.png";
                Toast.fire({
                  icon: "error",
                  title: "Record Deleted successfully",
                });
              }
            });
        }
      });
    },
    //ADDRESS-PROOF-END

    //RC-IMAGE
    regCert(e) {
      var _this = this;
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        _this.reg_cert_image_errors = "Size must not exceed 200 kb.";
        return false;
      }

      reader.onload = function (ev) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = ev.target.result;

        //Validate the File Height and Width.
        image.onload = function () {
          _this.cert_file = e.target.files[0];
          _this.rc_url = URL.createObjectURL(e.target.files[0]);
        };
      };
    },

    chooseRcImage() {
      this.$refs.reg_cert_img.click();
      this.reg_cert_image_errors = "";
    },

    submitRegCert() {
      if (this.cert_file == "") {
        this.reg_cert_image_errors = "This field required";
        return false;
      }
      let uploadRc = new FormData();
      uploadRc.append("cert_file", this.cert_file);
      uploadRc.append("reg_no", this.vehicle_reg_no);
      uploadRc.append("vehicle_id", this.vehicle_id);

      axios
        .post("add-reg-cert", uploadRc)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Registration Certificate Added",
            });
            this.getVehicleForImage();
            // this.cert_file="";
            // this.rc_url="";
          }
        })
        .catch((error) => {
          console.log("errors");
        });
    },

    deleteRc() {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("delete-reg-cert", {
              id: this.vehicle_id,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getVehicleForImage();
                this.rc_url = "../assets/img/nofilechoosen.png";
                Toast.fire({
                  icon: "error",
                  title: "Record Deleted successfully",
                });
              }
            });
        }
      });
    },

    addNewImage() {
      const item = {
        vehicle_id: this.select_item.id,
        reg_no: this.select_item.reg_no,
      };

      bus.$emit("add-image", item);
    },

    removeImage(img) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("remove-image", {
              id: img.id,
              file: img.image,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getImages();
                this.getNewImages();
                Toast.fire({
                  icon: "error",
                  title: "Record Deleted successfully",
                });
              }
            });
        }
      });
    },

 removeNewVehicleImage(new_img) {
      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("remove-image", {
              id: new_img.id,
              file: new_img.image,
            })
            .then((response) => {
              if (response.data == "success") {
                this.getImages();
                this.getNewImages();
                Toast.fire({
                  icon: "error",
                  title: "Record Deleted successfully",
                });
              }
            });
        }
      });
    },
  },

  watch: {
    select_item: function () {
      if (this.select_item == null) {
        this.vehicleData = [];
      }
      if (this.select_item == []) {
        this.vehicleData = [];
      }
    },
  },
  mounted() {},
};
</script>
<style scoped>
.removeSpan:hover {
  color: rgb(252, 15, 7);
  font-weight: bold;
  cursor: pointer;
}

.card-img-top {
  height: 150px;
  width: 200px;
  max-height: 160px;
  max-width: 210px;

  margin-left: auto;
  margin-right: auto;
}

.hideInputFile {
  display: none;
}
</style>
