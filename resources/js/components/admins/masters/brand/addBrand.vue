<template>
  <div>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        ref="close_add_brand_modal"
        @click="closeBrandModal()"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="form-group form-floating-label ">
        <input
          id="inputFloatingLabel"
          type="text"
          class="form-control input-border-bottom"
          required=""
          v-model="brand.brand_name"
        />
        <label for="inputFloatingLabel" class="placeholder required"
          >Enter Brand Name</label
        >
<small
                                    class="text-danger"
                                    v-if="errors.brand_name"
                                >
                                    {{ errors.brand_name[0] }}</small
                                >
      </div>
      <div class="form-group">
        <label for="exampleFormControlFile1 required">Add Brand Logo</label>
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
              ref="brand_logo_img"
              accept="image/*"
              @change="brandLogo($event)"
            />

            <button
              class="btn btn-primary"
              @click="chooseImage()"
              type="button"
            >
              {{ choose_image_title }}
            </button>
          </div>
          <div class="text-center pb-1">
            <small class="text-danger" v-if="brand_logo_err != ''">
              {{ brand_logo_err }}</small
            >
          </div>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button
        type="button"
        class="btn btn-secondary"
        data-dismiss="modal"
        @click="closeBrandModal"
      >
        Close
      </button>
      <button type="button" class="btn btn-primary" @click="addBrand()">
        Save changes
      </button>
    </div>
  </div>
</template>
<script>
export default {
  props: ["edit"],
  data() {
    return {
      title: "Add Brand",
      url: "../assets/img/nofilechoosen.png",
choose_image_title:"Choose Logo Image",
      selected_logo: "",
      brand: {
        id: "",
        brand_name: "",

        brand_logo: "",
      },
      brand_logo_err: "",

      errors: {},
    };
  },

  methods: {
    chooseImage() {
      this.$refs.brand_logo_img.click();
      this.brand_logo_err = "";
    },
    closeBrandModal() {
      bus.$emit("closing-brand-modal");
      this.clearFormData();
    },

    brandLogo(e) {
      var _this = this;
      var reader = new FileReader();

      //Read the contents of Image File.
      reader.readAsDataURL(e.target.files[0]);

      // size validation

      if (e.target.files[0].size >= 200000) {
        _this.brand_logo_err = "Size must not exceed 200 kb.";
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
          _this.brand.brand_logo = e.target.files[0];
          _this.url = URL.createObjectURL(e.target.files[0]);
          // _this.selected_logo=URL.createObjectURL(e.target.files[0]);
          //   }
        };
      };
    },

    addBrand() {
      if (this.brand.brand_logo == "" && !this.edit) {
        this.brand_logo_err = "This field required";
        return false;
      }

      let upload = new FormData();
      if (this.edit) {
        upload.append("id", this.brand.id);
      }
      upload.append("brand_name", this.brand.brand_name);

      upload.append("brand_logo", this.brand.brand_logo);

      axios
        .post("add-brand", upload)
        .then((res) => {
          console.log("success");

          if (res.data == "success") {
            Toast.fire({
              icon: "success",
              title: "Brand Added successfully",
            });
            this.$refs.close_add_brand_modal.click();
            bus.$emit("closing-brand-modal");
            this.$refs.brand_logo_img.value = "";
            this.clearFormData();
          }
        })
        .catch((error) => {
          this.errors = error.response.data.errors;

          console.log("errors");
        });
    },

    clearFormData() {
      for (let data in this.brand) {
        this.brand[data] = "";
      }

      // this.selected_logo="";
      this.url = "../assets/img/nofilechoosen.png";
      this.brand_logo_err = "";

      for (let er in this.errors) {
        this.errors[er] = "";
      }
    },
  },

  created() {
    if (this.edit) {
      this.title = "Edit Brand";
this.choose_image_title="Change Logo Image";

      var _this = this;
      bus.$on("edit-brand", function (brand) {
        _this.clearFormData();

        _this.brand.id = brand.id;
        _this.brand.brand_name = brand.name;

        _this.url = "../uploads/brand/" + brand.logo;
      });
    }
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
