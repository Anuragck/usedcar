<template>
  <div class="div">

    <div class="container-fluid px-5">

      <div class="row">

        <div class="col-lg-2 col-md-2 ">
          <div class="contact-form mt-3 ">

            <form >
              <label>Brand:</label>

              <model-list-select
                :list="this.brands"
                name="brand"
                v-model="selectedBrand"
                option-value="id"
                :custom-text="brand"
                placeholder="select item"
                class="form-control"
              >
              </model-list-select>

              <label>Model:</label>

              <model-list-select
                :list="this.modelList"
                name="model"
                v-model="selectedModel"
                option-value="id"
                :custom-text="model"
                placeholder="select item"
                class="form-control"
              >
              </model-list-select>

              <label>Price:</label>

              <select class="form-control" v-model="price">
                <option value="">-- All --</option>
                <option value="1">Low to High</option>
                <option value="2">High to Low</option>
              </select>

              <label>Fuel:</label>

              <select class="form-control" v-model="fuel">
                <option value="">-- All --</option>
                <option value="PETROL">Petrol</option>
                <option value="DIESEL">Diesel</option>
              </select>

              <button
                type="button"
                class="filled-button btn-block"
                @click.prevent="getAllCars()"
              >
                Search <i class="fa fa-search fa-fw" aria-hidden="true"></i>
              </button>
            </form>

          </div>

        </div>


        <div class="col-lg-10 col-md-10">
          <section class="mt-3">
            <div class="container-fluid px-5">
              <div class="row">
                <!--Profile Card 5-->
                <div
                  class="col-md-4  mt-4"
                  v-for="car in all_cars"
                  :key="car.id"
                >
                  <div
                    class="card profile-card-5 shadow-lg rounded hover01 my-car"
                  >
                    <div class="card-img-block">
                      <figure>
                        <img
                          class="card-img-top img-box"
                          :src="
                            '/uploads/vehicleImages/' +
                            car.index_page_images[0].image
                          "
                          alt="Card image cap"
                        />
                      </figure>
                    </div>
                    <div class="card-body pt-0">
                      <a :href="'/singleCarView/' + car.id" class="no-decoration">
                        <h6 class="card-title font-weight-bold">
                          {{ car.brands.name }} {{ car.models.name }}
                        </h6>
                      </a>

 <h6 class="pt-1"><small><del> ₹ {{ parseFloat(car.selling_price) + parseFloat(for_discount)}}    </del></small> ₹ {{ car.selling_price }}</h6>

                                    <p>{{ car.fuel }} &nbsp;/&nbsp; {{ car.year_of_reg }} &nbsp;/&nbsp; Used vehicle</p>

                                    <small>
                                        <strong title="Author"><i class="fa fa-dashboard"></i> {{ car.kms_driven }} Kms</strong>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong title="Author"><i class="fa fa-cube"></i> {{ car.cc }}
                                            cc</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong title="Views"><i class="fa fa-cog"></i> {{ car.transmission_type }}</strong>
                                    </small>
                      <a
                        :href="'/singleCarView/' + car.id"
                        class="btn  filled-button rounded pull-right mt-4"
                        >View More <i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { ModelListSelect } from "vue-search-select";
export default {
  components: {
    ModelListSelect,
  },
  data() {
    return {
      selectedBrand: "",
      selectedModel: "",
      all_cars: {},
      brands: [],
      modelList: [],

      price: "",
      fuel: "",
for_discount:'25000',
    };
  },

  methods: {
    getAllCars() {
      axios
        .get("all-cars", {
          params: {
            brand: this.selectedBrand,
            model: this.selectedModel,
            price: this.price,
            fuel: this.fuel,
          },
        })
        .then((res) => {
          this.all_cars = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getBrands() {
      axios
        .get("user-get-brands")
        .then((response) => {
          this.brands = response.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getModelByBrand() {
      axios
        .get("user-get-model-by-brand", {
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

    brand(item) {
      return `${item.name}`;
    },
    model(item) {
      return `${item.name}`;
    },
  },

  created() {
    this.getBrands();
    this.getAllCars();
  },

  watch: {
    selectedBrand: function () {
      if (this.selectedBrand != "") {
        this.getModelByBrand();
      }
    },

    selectedModel: function () {
      if (this.selectedModel != "") {
      }
    },
  },
};
</script>

<style scoped>
*:hover {
  -webkit-transition: all 1s ease;
  transition: all 1s ease;
}
section {
  float: left;
  width: 100%;
box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;
background-color: rgba(255, 255, 255, 0.822);
  padding: 30px 0;
border-radius: 10px;
padding-bottom:100px ;
}


/*Profile Card 5*/
.profile-card-5 {
  margin-top: 20px;
}
.profile-card-5 .btn {
  border-radius: 2px;
  text-transform: uppercase;
  font-size: 12px;
  padding: 7px 20px;
}
.profile-card-5 .card-img-block {
  width: 91%;
  margin: 0 auto;
  position: relative;
  top: -20px;
}
.profile-card-5 .card-img-block img {
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.63);
}
.profile-card-5 h5 {
  color: #4e5e30;
  font-weight: 600;
}
.profile-card-5 p {
  font-size: 14px;
  font-weight: 300;
}
.profile-card-5 .btn-primary {
  background-color: #4e5e30;
  border-color: #4e5e30;
}

.hover01 figure img {
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-transition: 0.3s ease-in-out;
  transition: 0.3s ease-in-out;
}
.hover01 figure:hover img {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.my-car {
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  min-width: 85%;
  max-width: 85%;
}

.img-box {
  min-height: 150px;
  max-height: 150px;
}
.no-decoration{
    text-decoration: none;}



</style>
