<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">
        {{ title }} - {{ upload.reg_no }}
      </h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_add_image_modal"
@click="clearFormData()"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="form-group mx-2">
        <div class="row">
          <div class="col-2">
            <label for="type">Type : </label>
          </div>
          <div class="col-10">
            <select id="type" class="form-control" v-model="upload.img_type">
              <option selected value="">Choose...</option>
              <option value="1">Front View</option>
              <option value="2">Other</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="card img_card mx-5">
          <img
            :src="url"
            class="card-img-top mt-3"
            alt="default image not found"
          />
          <div class="card-body text-center">
            <input
              type="file"
              class="form-control-file hideInputFile"
              id="exampleFormControlFile1"
              ref="vehicle_image"
              accept="image/*"
              @change="selectImage($event)"
            />

            <button
              class="btn btn-primary"
              type="button"
              @click="chooseImage()"
            >
              {{ choose_image_title }}
            </button>
          </div>
          <div class="text-center pb-1">
            <span class="text-danger"> {{ image_errors }} </span>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearFormData()">
        Close
      </button>
      <button type="button" class="btn btn-primary" @click="addImage()">
        Upload
      </button>
    </div>
  </div>
</template>
<script>
export default {
  props: [""],
  data() {
    return {
      title: "Add Image",
      url: "../assets/img/nofilechoosen.png",
      choose_image_title: "Choose Image",

      upload: {
        vehicle_id: "",
        reg_no: "",
        image: "",
        img_type: "",
      },
      errors: {},
      image_errors: "",
    };
  },

  methods: {
    selectImage(e) {
      var _this = this;
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        _this.image_errors = "Size must not exceed 200 kb.";
        return false;
      }

      reader.onload = function (ev) {
        //Initiate the JavaScript Image object.
        var image = new Image();

        //Set the Base64 string return from FileReader as source.
        image.src = ev.target.result;

        //Validate the File Height and Width.
        image.onload = function () {
          _this.upload.image = e.target.files[0];
          _this.url = URL.createObjectURL(e.target.files[0]);
        };
      };
    },

    chooseImage() {
      this.$refs.vehicle_image.click();
      this.image_errors = "";
    },

    addImage() {
      if (this.upload.image == "") {
        this.image_errors = "this field required";
        return false;
      }

      let upload = new FormData();
      upload.append("image", this.upload.image);
      upload.append("vehicle_id", this.upload.vehicle_id);
      upload.append("reg_no", this.upload.reg_no);
      upload.append("img_type", this.upload.img_type);
      axios
        .post("add-image", upload)
        .then((response) => {
          if (response.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Image Added Successfully",
            });
            bus.$emit("image-added");
            this.$refs.close_add_image_modal.click();
this.clearFormData();
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log("errors");
        });
    },

    clearFormData() {
        this.upload.vehicle_id="";
        this.upload.reg_no= "";
        this.upload.image= "";
        this.upload.img_type= "";
 this.url= "../assets/img/nofilechoosen.png";
    }
  },

  created() {
    var _this = this;

    bus.$on("add-image", function (item) {
      _this.upload.vehicle_id = item.vehicle_id;
      _this.upload.reg_no = item.reg_no;
    });
  },
};
</script>
<style scoped>
.card-img-top {
  height: 120px;
  width: 180px;
  max-height: 120px;
  max-width: 180px;

  margin-left: auto;
  margin-right: auto;
}

.hideInputFile {
  display: none;
}
</style>
