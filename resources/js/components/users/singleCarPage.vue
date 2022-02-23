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
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#enquireNow"
              >
                Enquire Now
              </button>
            </div>
          </div>
        </div>

<div class="col-md-6">

	<!-- PRICE ITEM -->
<div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">First</th>
                                        <th scope="col"></th>
                                        <th scope="col">Handle</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>Mark</td>
                                        <td></td>
                                        <td>@mdo</td>

                                    </tr>


                                </tbody>
                            </table>

                        </div>

					<!-- /PRICE ITEM -->

</div>
      </div>
    </div>

    <div class="section">
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

          <div class="col-md-6">
            <div class="section-heading">
              <h2>Vehicle Extras</h2>
            </div>

            <div class="left-content">
              <p>
                - ABS <br />-Leather seats <br />-Power Assisted Steering
                <br />-Air Conditioner <br />-Wheel Covers <br />-Power Windows
                Front <br />-Anti Lock Braking System
              </p>
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
