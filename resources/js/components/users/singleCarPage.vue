<template>
  <div class="div">
    <div
      class="page-heading contact-heading header-text"
      style="background-image: url(/assets/img/heading-4-1920x500.jpg)"
    >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h2>{{ single_car.brands.name }} {{ single_car.models.name }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="section-heading mt-5">
          <h2 class="text-center">
            {{ single_car.year_of_reg }} {{ single_car.brands.name }}
            {{ single_car.models.name }}
          </h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div>
            <div
              id="carouselExampleControls"
              class="carousel slide"
              data-ride="carousel"
            >
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img
                    class="d-block w-100"
                    :src="
                      '/uploads/vehicleImages/' +
                      single_car.index_page_images[0].image
                    "
                    alt="Second slide"
                  />
                </div>

                <div
                  class="carousel-item"
                  v-for="a in single_car.images"
                  :key="a.id"
                >
                  <img
                    :src="'/uploads/vehicleImages/' + a.image"
                    class="img-responsive d-block w-100"
                  />
                </div>
              </div>
              <a
                class="carousel-control-prev"
                href="#carouselExampleControls"
                role="button"
                data-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="sr-only">Previous</span>
              </a>
              <a
                class="carousel-control-next"
                href="#carouselExampleControls"
                role="button"
                data-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

            <!-------images---->
            <div class="row mt-5">
              <div
                class="col-sm-4 col-6"
                v-for="a in single_car.images"
                :key="a.id"
              >
                <div>
                  <img
                    :src="'/uploads/vehicleImages/' + a.image"
                    alt=""
                    class="img-fluid"
                  />
                </div>
                <br />
              </div>
            </div>

            <div class="text-center">
              <button
                class="btn btn-danger rounded pull-right mt-4"
                data-toggle="modal"
                data-target="#enquireNow"
              >
                Enquire Now <i class="fas fa-headset fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <!-- PRICE ITEM -->
          <div class="table-responsive">
            <table class="table m-0">
              <tbody>
                <tr v-if="single_car.color">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Color</td>
                  <td></td>
                  <td>{{ single_car.color }}</td>
                </tr>

                <tr v-if="single_car.year_of_reg">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Year Of Reg</td>
                  <td></td>
                  <td>{{ single_car.year_of_reg }}</td>
                </tr>

                <tr v-if="single_car.fuel">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Fuel</td>
                  <td></td>
                  <td>{{ single_car.fuel }}</td>
                </tr>

                <tr v-if="single_car.kms_driven">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Kms Driven</td>
                  <td></td>
                  <td>{{ single_car.kms_driven }}{{ "Kms" }}</td>
                </tr>

                <tr v-if="single_car.no_of_owners">
                  <th scope="row"></th>
                  <td class="font-weight-bold">No Of Owners</td>
                  <td></td>
                  <td>{{ single_car.no_of_owners }}</td>
                </tr>

                <tr v-if="single_car.cc">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Displacement</td>
                  <td></td>
                  <td>{{ single_car.cc }}</td>
                </tr>

                <tr v-if="single_car.rto">
                  <th scope="row"></th>
                  <td class="font-weight-bold">RTO</td>
                  <td></td>
                  <td>{{ single_car.rto }}</td>
                </tr>

                <tr v-if="single_car.transmission_type">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Transmission Type</td>
                  <td></td>
                  <td>{{ single_car.transmission_type }}</td>
                </tr>

                <tr v-if="single_car.gear_box">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Gear Box</td>
                  <td></td>
                  <td>{{ single_car.gear_box }}</td>
                </tr>

                <tr v-if="single_car.milage_per_km">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Mileage Per Km</td>
                  <td></td>
                  <td>{{ single_car.milage_per_km }}</td>
                </tr>



                <tr v-if="single_car.drive_type">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Drive Type</td>
                  <td></td>
                  <td>{{ single_car.drive_type }}</td>
                </tr>

  <tr v-if="single_car.front_brake">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Front Brake</td>
                  <td></td>
                  <td>{{ single_car.front_brake }}</td>
                </tr>

 <tr v-if="single_car.back_brake">
                  <th scope="row"></th>
                  <td class="font-weight-bold">Back Brake</td>
                  <td></td>
                  <td>{{ single_car.back_brake }}</td>
                </tr>


              </tbody>
            </table>
          </div>

          <!-- /PRICE ITEM -->
        </div>
      </div>
    </div>

    <div class="section mt-5 pt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="section-heading">
              <h2>Vehicle Description</h2>
            </div>

            <div class="left-content">
              <p class="text-justify">
                {{ single_car.description }}
              </p>
            </div>
          </div>

          <div class="col-md-6 pl-5">
            <div class="section-heading">
              <h2>Vehicle Extras</h2>
            </div>

            <div class="row">
<div class="text-center col-md-4 col-lg-4 mt-3" v-if="single_car.power_steering == 1">
 <img src="https://img.icons8.com/dotty/80/000000/steering-wheel.png" width="50px" >
<h6>Power Steering</h6>
</div>

<div class="text-center col-md-4 col-lg-4 mt-3" v-if="single_car.abs == 1">
<img src="https://img.icons8.com/ios/50/000000/abs.png" width="50px">
<h6>ABS</h6>
</div>

<div class="text-center col-md-4 col-lg-4 mt-3" v-if="single_car.driver_air_bag == 1">
<img src="https://img.icons8.com/ios/50/000000/airbag-on.png" width="50px" >
<h6>Diver Air Bag</h6>
</div>

<div class="text-center col-md-4 col-lg-4 mt-3"  v-if="single_car.passenger_air_bag == 1">
<img src="https://img.icons8.com/ios-filled/50/000000/airbag-on.png" width="50px">
<h6>Passenger Air Bag</h6>
</div>

<div class="text-center col-md-4 col-lg-4 mt-3"  v-if="single_car.auto_climate_control == 1">
<img src="https://img.icons8.com/ios/50/000000/climate-change.png" width="50px" >
<h6>Auto Climate Control</h6>
</div>

<div class="text-center col-md-4 col-lg-4 mt-3"  v-if="single_car.alloy_wheel == 1">
<img src="https://img.icons8.com/ios/50/000000/wheel.png" width="50px" >
<h6>Alloy Wheel</h6>
</div>



<div class="text-center col-md-4 col-lg-4 mt-3" v-if="single_car.ac == 1">
<img src="https://img.icons8.com/ios/50/000000/air-conditioner.png" width="50px">
<h6>A C</h6>
</div>







            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div
        class="modal fade"
        id="enquireNow"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
        data-backdrop="static"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <enquire-now
              :reg_no="single_car.reg_no"
              :brand_id="single_car.brand_id"
              :model_id="single_car.model_id"
            ></enquire-now>
          </div>
        </div>
      </div>
      <!--Add new enquiry Modal End-->
    </div>
  </div>
</template>
<script>
export default {
  props: ["single_car"],
  data() {
    return {};
  },

  methods: {
    // enquireNow(car_reg_no,car_brand_id,car_model_id){
    //    bus.$emit("enquire-now-data",car_reg_no,car_brand_id,car_model_id)
    // }
  },

  created() {},
};
</script>

<style scoped>
</style>
